<?php

namespace MennenOnline\Shopware6ApiConnector;

use MennenOnline\Shopware6ApiConnector\Enums\Model;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use MennenOnline\LaravelResponseModels\Models\BaseModel;
use MennenOnline\Shopware6ApiConnector\Endpoints\AuthenticationEndpoint;
use MennenOnline\Shopware6ApiConnector\Enums\Endpoint;
use MennenOnline\Shopware6ApiConnector\Exceptions\Shopware6EndpointNotFoundException;
use MennenOnline\Shopware6ApiConnector\Models\AuthResponseModel;
use MennenOnline\Shopware6ApiConnector\Models\BaseResponseModel;

/**
 * @property PendingRequest $client
 * @property int|null $expires_in
 * @property string|null $token
 * @property BaseModel|null $responseModel
 * @property string|null $id
 * @property bool $auth = false
 * @property string|null $url
 * @property string|null $client_id
 * @property string|null $client_secret
 *
 * @method Shopware6ApiConnector authentication(string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware6ApiConnector category(string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware6ApiConnector customerGroup(string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware6ApiConnector media(string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware6ApiConnector product(string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware6ApiConnector propertyGroup(string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware6ApiConnector propertyGroupOption(string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware6ApiConnector tax(string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 * @method Shopware6ApiConnector taxRule(string|null $url = null, string|null $client_id = null, string|null $client_secret = null)
 */

abstract class Shopware6ApiConnector
{
    protected const SHOPWARE6_CLIENT_ID = 'shopware6.client_id';

    protected const SHOPWARE6_CLIENT_SECRET = 'shopware6.client_secret';

    protected const SHOPWARE6_ENDPOINT_FQDN = 'MennenOnline\\Shopware6ApiConnector\\Endpoints\\';

    public function __construct(
        protected PendingRequest|null $client = null,
        protected int|null $expires_in = null,
        protected string|null $token = null,
        protected BaseModel|null $responseModel = null,
        protected string|null $id = null,
        protected bool $auth = false,
        protected string|null $url = null,
        protected string|null $client_id = null,
        protected string|null $client_secret = null
    ) {
        if($this->client === null) {
            $baseUrl = $this->url ?? config('shopware6.url');

            $this->client = Http::baseUrl($baseUrl.'/api')
                ->acceptJson();

            if($this->expires_in === null || !$this->validAuthExists()) {
                $loginResponse = (new AuthenticationEndpoint($this->client))->oAuthToken();

                $this->expires_in = $loginResponse->expires_in;

                $this->token = $loginResponse->token;

                $this->client->withToken($this->token);
            }
        }
    }

    public function getExpiresIn(): int|null {
        return $this->expires_in;
    }

    public function getToken(): string|null {
        return $this->token;
    }

    public function getClient(): PendingRequest {
        return $this->client;
    }

    public function validAuthExists(): bool {
        if($this->expires_in === null) {
            return false;
        }

        return Carbon::now()->isAfter(Carbon::now()->subSeconds($this->expires_in));
    }

    public function __call(string $name, array $arguments): Shopware6ApiConnector {
        $instance = self::__callStatic($name, $arguments);
        if(!$instance) {
            throw new Shopware6EndpointNotFoundException("Shopware 6 Endpoint " . $name . " not available yet");
        }
        return new (get_class($instance)($this->client, $this->expires_in, $this->token));
    }

    public static function __callStatic(string $name, array $arguments): Shopware6ApiConnector|null {
        $className = self::SHOPWARE6_ENDPOINT_FQDN . str($name)->camel()->ucfirst()->append('Endpoint')->toString();
        if(class_exists($className)) {
            return new $className(...$arguments);
        }
        return null;
    }

    private function logger(PromiseInterface|Response $response): BaseResponseModel|AuthResponseModel|null {
        $logData = [
            'status' => $response->status(),
            'response' => $response->object(),
        ];

        if($response->successful()) {
            Log::info("Shopware 6 API Call OK", $logData);
        } else {
            Log::emergency("Shopware 6 API Call not OK", $logData);

            return $this->auth ? new AuthResponseModel() : new BaseResponseModel(Model::EMPTY);
        }

        if($this->auth) {
            $this->auth = false;
            return new AuthResponseModel($response->object());
        }

        return new BaseResponseModel(
            model: $this->id !== null ? Model::SINGLE : Model::INDEX,
            attributes: $response->object(),
            mapClassForData: $this->responseModel
        );
    }

    private function buildUrl(Endpoint $endpoint, int|string|null $id = null): string {
        $string = str($endpoint->value);

        $this->id = $id;

        if(!$id) {
            return $string->toString();
        }

        return $string->append('/'.$id)->toString();
    }

    protected function index(Endpoint $endpoint): BaseResponseModel {
        return $this->logger(
            $this->client->get($this->buildUrl($endpoint))
        );
    }

    protected function get(Endpoint $endpoint, string $id): BaseResponseModel {
        $this->id = $id;

        return $this->logger(
            $this->client->get($this->buildUrl($endpoint, $id))
        );
    }

    protected function post(Endpoint $endpoint, array $data): BaseResponseModel|AuthResponseModel {
        return $this->logger(
            $this->client->post($this->buildUrl($endpoint), $data)
        );
    }
}
