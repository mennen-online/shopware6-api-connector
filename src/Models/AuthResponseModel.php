<?php

namespace MennenOnline\Shopware6Connector\Models;

use MennenOnline\LaravelResponseModels\Models\BaseModel;

/**
 * @property string $type
 * @property string $token
 * @property int $expires_in
 */

class AuthResponseModel extends BaseModel
{
    protected array $fieldMap = [
        'token_type' => 'type',
        'access_token' => 'token',
        'expires_in' => 'expires_in'
    ];
}