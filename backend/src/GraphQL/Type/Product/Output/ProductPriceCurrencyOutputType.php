<?php

namespace App\GraphQL\Type\Product\Output;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

/**
 * This class represents the GraphQL ObjectType for the product price currency output.
 * It extends the base ObjectType provided by the GraphQL library.
 */
class ProductPriceCurrencyOutputType extends ObjectType
{
    private static ?self $instance = null;
    protected array $fields = [];
    protected array $interfaces = [];

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProductPriceCurrencyOutput',
            'fields' => [
                'id' => Type::int(),
                'label' => Type::string(),
                'symbol' => Type::string()
            ]
        ]);
    }

    /**
     * Get an instance of the ProductPriceCurrencyOutputType.
     *
     * @return self An instance of the ProductPriceCurrencyOutputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
