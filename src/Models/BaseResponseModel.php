<?php

namespace MennenOnline\Shopware6ApiConnector\Models;

use MennenOnline\Shopware6ApiConnector\Enums\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use MennenOnline\LaravelResponseModels\Models\BaseModel;
use stdClass;

/**
 * @property int|null $total
 * @property Collection|null $data
 * @property boolean|null $success
 */

class BaseResponseModel extends BaseModel
{
    protected array $fieldMap = [
        'total',
        'data',
        'success',
        'errors'
    ];

    public function __construct(Model $model, array|object $attributes = [], string|null $mapClassForData = null) {
        parent::__construct($attributes);

        $attributes = (array)$attributes;

        if($model === Model::INDEX) {
            if($mapClassForData && !class_exists($mapClassForData)) {
                Log::warning("Not existing Map Class used", [
                    'fqcn' => $mapClassForData
                ]);
                return;
            }

            if($mapClassForData !== null) {
                $this->data = collect($attributes['data'])->mapInto($mapClassForData);
            } else {
                $this->data = collect($attributes['data'])->map(function($element) {
                    if(!is_array($element)) {
                        return $element;
                    }

                    $object = new stdClass();

                    foreach($element as $key => $value) {
                        $object->$key = $value;
                    }

                    return $object;
                });
            }
        }

        if($model === Model::SINGLE) {
            $object = new stdClass();
            collect($attributes['data'])->each(function($value, $key) use($object) {
                $object->$key = $value;
            });

            $this->data = $object;
        }
    }
}