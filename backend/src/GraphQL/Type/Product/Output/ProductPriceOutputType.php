<?php

namespace App\GraphQL\Type\Product\Output;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

/**
 * This class represents the GraphQL Object Type for Product Price Output.
 * It extends the base ObjectType class provided by the GraphQL library.
 */
class ProductPriceOutputType extends ObjectType
{
    private static ?self $instance = null;
    protected array $fields = [];
    protected array $interfaces = [];

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProductPriceOutput',
            'fields' => [
                'id' => Type::int(),
                'amount' => Type::float(),
                'currency' => ProductPriceCurrencyOutputType::getInstance()
            ]
        ]);
    }

    /**
     * Get an instance of the ProductPriceOutputType.
     *
     * @return self An instance of the ProductPriceOutputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
