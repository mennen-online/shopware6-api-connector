<?php

namespace MennenOnline\Shopware6Connector;

use MennenOnline\Shopware6Connector\Enums\Model;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use MennenOnline\LaravelResponseModels\Models\BaseModel;
use MennenOnline\Shopware6Connector\Endpoints\AuthenticationEndpoint;
use MennenOnline\Shopware6Connector\Enums\Endpoint;
use MennenOnline\Shopware6Connector\Exceptions\Shopware6EndpointNotFoundException;
use MennenOnline\Shopware6Connector\Models\AuthResponseModel;
use MennenOnline\Shopware6Connector\Models\BaseResponseModel;

/**
 * @property PendingRequest $client
 * @property int|null $expires_in
 * @property string|null $token
 *
 * @method Shopware6ApiConnector authentication()
 * @method Shopware6ApiConnector category()
 * @method Shopware6ApiConnector customerGroup()
 * @method Shopware6ApiConnector media()
 * @method Shopware6ApiConnector product()
 * @method Shopware6ApiConnector propertyGroup()
 * @method Shopware6ApiConnector propertyGroupOption()
 * @method Shopware6ApiConnector tax()
 * @method Shopware6ApiConnector taxRule()
 */

class Shopware6ApiConnector
{
    protected const SHOPWARE6_CLIENT_ID = 'shopware6.client_id';

    protected const SHOPWARE6_CLIENT_SECRET = 'shopware6.client_secret';

    public function __construct(
        protected PendingRequest|null $client = null,
        protected int|null $expires_in = null,
        protected string|null $token = null,
        protected BaseModel|null $responseModel = null,
        protected string|null $id = null,
        protected bool $auth = false
    ) {
        if($this->client === null) {
            $this->client = Http::baseUrl(config('shopware6.url').'/api')
                ->acceptJson();

            if($this->expires_in === null || !$this->validAuthExists()) {
                $loginResponse = (new AuthenticationEndpoint($this->client))->oAuthToken();

                $this->expires_in = $loginResponse->expires_in;

                $this->token = $loginResponse->token;

                $this->client->withToken($this->token);
            }
        }
    }

    public function validAuthExists(): bool {
        if($this->expires_in === null) {
            return false;
        }

        return Carbon::now()->isAfter(Carbon::now()->subSeconds($this->expires_in));
    }

    public function __call(string $name, array $arguments): Shopware6ApiConnector {
        $className = 'MennenOnline\\Shopware6Connector\\Endpoints\\' . str($name)->camel()->ucfirst()->append('Endpoint')->toString();
        if(class_exists($className)) {
            return new $className($this->client, $this->expires_in, $this->token);
        }

        throw new Shopware6EndpointNotFoundException("Shopware 6 Endpoint " . $name . " not available yet");
    }

    public static function __callStatic(string $name, array $arguments) {
        $instance = new self;

        return $instance->$name($arguments);
    }

    private function logger(PromiseInterface|Response $response): BaseResponseModel|AuthResponseModel {
        $logData = [
            'status' => $response->status(),
            'response' => $response->object(),
        ];

        if($response->successful()) {
            Log::info("Shopware 6 API Call OK", $logData);
        } else {
            Log::emergency("Shopware 6 API Call not OK", $logData);
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
