<?php

namespace MennenOnline\Shopware6ApiConnector\Enums;

enum Endpoint: string
{
    case TOKEN_AUTH = 'oauth/token';

    case CATEGORY = 'category';

    case CUSTOMER_GROUP = 'customer-group';

    case MEDIA = 'media';

    case PRODUCT = 'product';

    case PROPERTY_GROUP = 'property-group';

    case PROPERTY_GROUP_OPTION = 'property-group-option';

    case TAX = 'tax';

    case TAX_RULE = 'tax-rule';
}
