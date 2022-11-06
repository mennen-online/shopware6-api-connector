<?php

namespace MennenOnline\Shopware6ApiConnector\Enums;

enum Endpoint
{
    case ACL_ROLE;

    case ACL_USER_ROLE;

    case APP;

    case APP_ACTION_BUTTON;

    case APP_PAYMENT_METHOD;

    case APP_TEMPLATE;

    case OAUTH_TOKEN;

    case CATEGORY;

    case CATEGORY_TAG;

    case CMS_BLOCK;

    case CMS_PAGE;

    case CMS_SECTION;

    case CMS_SLOT;

    case COUNTRY;

    case COUNTRY_STATE;

    case CURRENCY;

    case CURRENCY_COUNTRY_ROUNDING;

    case CUSTOM_FIELD;

    case CUSTOM_FIELD_SET;

    case CUSTOM_FIELD_SET_RELATION;

    case CUSTOMER;

    case CUSTOMER_ADDRESS;

    case CUSTOMER_GROUP;

    case CUSTOMER_GROUP_REGISTRATION_SALES_CHANNELS;

    case CUSTOMER_RECOVERY;

    case CUSTOMER_TAG;

    case CUSTOMER_WISHLIST;

    case CUSTOMER_WISHLIST_PRODUCT;

    case DEAD_MESSAGE;

    case DELIVERY_TIME;

    case DOCUMENT;

    case DOCUMENT_BASE_CONFIG;

    case DOCUMENT_BASE_CONFIG_SALES_CHANNEL;

    case DOCUMENT_TYPE;

    case EVENT_ACTION;

    case EVENT_ACTION_RULE;

    case EVENT_ACTION_SALES_CHANNEL;

    case IMPORT_EXPORT_FILE;

    case IMPORT_EXPORT_LOG;

    case IMPORT_EXPORT_PROFILE;

    case INTEGRATION;

    case INTEGRATION_ROLE;

    case LANDING_PAGE;

    case LANDING_PAGE_SALES_CHANNEL;

    case LANDING_PAGE_TAG;

    case LANGUAGE;

    case LOCALE;

    case LOG_ENTRY;

    case MAIL_HEADER_FOOTER;

    case MAIL_TEMPLATE;

    case MAIL_TEMPLATE_MEDIA;

    case MAIL_TEMPLATE_TYPE;

    case MAIN_CATEGORY;

    case MEDIA;

    case MEDIA_DEFAULT_FOLDER;

    case MEDIA_FOLDER;

    case MEDIA_FOLDER_CONFIGURATION;

    case MEDIA_FOLDER_CONFIGURATION_MEDIA_THUMBNAIL_SIZE;

    case MEDIA_TAG;

    case MEDIA_THUMBNAIL;

    case MEDIA_THUMBNAIL_SIZE;

    case MESSAGE_QUEUE_STATS;

    case NEWSLETTER_RECIPIENT;

    case NEWSLETTER_RECIPIENT_TAG;

    case NUMBER_RANGE;

    case NUMBER_RANGE_SALES_CHANNEL;

    case NUMBER_RANGE_STATE;

    case ORDER;

    case ORDER_ADDRESS;

    case ORDER_CUSTOMER;

    case ORDER_DELIVERY;

    case ORDER_DELIVERY_POSITION;

    case ORDER_LINE_ITEM;

    case ORDER_TAG;

    case ORDER_TRANSACTION;

    case PAYMENT_METHOD;

    case PLUGIN;

    case PRODUCT;

    case PRODUCT_CATEGORY;

    case PRODUCT_CATEGORY_TREE;

    case PRODUCT_CONFIGURATOR_SETTING;

    case PRODUCT_CROSS_SELLING;

    case PRODUCT_CROSS_SELLING_ASSIGNED_PRODUCTS;

    case PRODUCT_CUSTOM_FIELD_SET;

    case PRODUCT_EXPORT;

    case PRODUCT_FEATURE_SET;

    case PRODUCT_KEYWORD_DICTIONARY;

    case PRODUCT_MANUFACTURER;

    case PRODUCT_MEDIA;

    case PRODUCT_OPTION;

    case PRODUCT_PRICE;

    case PRODUCT_PROPERTY;

    case PRODUCT_REVIEW;

    case PRODUCT_SEARCH_CONFIG;

    case PRODUCT_SEARCH_CONFIG_FIELD;

    case PRODUCT_SEARCH_KEYWORD;

    case PRODUCT_SORTING;

    case PRODUCT_STREAM;

    case PRODUCT_STREAM_FILTER;

    case PRODUCT_STREAM_MAPPING;

    case PRODUCT_TAG;

    case PRODUCT_VISIBILITY;

    case PROMOTION;

    case PROMOTION_CART_RULE;

    case PROMOTION_DISCOUNT;

    case PROMOTION_DISCOUNT_PRICES;

    case PROMOTION_DISCOUNT_RULE;

    case PROMOTION_INDIVIDUAL_CODE;

    case PROMOTION_ORDER_RULE;

    case PROMOTION_PERSONA_CUSTOMER;

    case PROMOTION_PERSONA_RULE;

    case PROMOTION_SALES_CHANNEL;

    case PROMOTION_SETGROUP;

    case PROMOTION_SETGROUP_RULE;

    case PROPERTY_GROUP;

    case PROPERTY_GROUP_OPTION;

    case RULE;

    case RULE_CONDITION;

    case SALES_CHANNEL;

    case SALES_CHANNEL_ANALYTICS;

    case SALES_CHANNEL_COUNTRY;

    case SALES_CHANNEL_CURRENCY;

    case SALES_CHANNEL_DOMAIN;

    case SALES_CHANNEL_LANGUAGE;

    case SALES_CHANNEL_PAYMENT_METHOD;

    case SALES_CHANNEL_SHIPPING_METHOD;

    case SALES_CHANNEL_TYPE;

    case SALUTATION;

    case SCHEDULED_TASK;

    case SEO_URL;

    case SEO_URL_TEMPLATE;

    case SHIPPING_METHOD;

    case SHIPPING_METHOD_PRICE;

    case SHIPPING_METHOD_TAG;

    case SNIPPET;

    case SNIPPET_SET;

    case STATE_MACHINE;

    case STATE_MACHINE_HISTORY;

    case STATE_MACHINE_STATE;

    case STATE_MACHINE_TRANSITION;

    case SYSTEM_CONFIG;

    case TAG;

    case TAX;

    case TAX_RULE;

    case TAX_RULE_TYPE;

    case THEME;

    case THEME_MEDIA;

    case THEME_SALES_CHANNEL;

    case UNIT;

    case USER;

    case USER_ACCESS_KEY;

    case USER_CONFIG;

    case USER_RECOVERY;

    case WEBHOOK;

    case WEBHOOK_EVENT_LOG;

    public static function convertEndpointToUrl(Endpoint $endpoint): string {
        $url = str($endpoint->name);

        if($url->contains('TOKEN')) {
            $url = $url->replace('_', '/');
        } else {
            $url = $url->replace('_', '-');
        }

        return $url->lower()->snake()->toString();
    }
}
