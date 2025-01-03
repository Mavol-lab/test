<?php

namespace App\GraphQL\Type\Product\Input;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

/**
 * This class represents the input type for product price in GraphQL.
 * It extends the InputObjectType to define the structure of the input
 * for product price-related operations.
 */
class ProductPriceInputType extends InputObjectType
{
    private static ?self $instance = null;

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProducPriceInput',
            'fields' => [
                'amount' => Type::float(),
                'currencyId' => Type::string()
            ]
        ]);
    }

    /**
     * Get an instance of the ProducPriceInputType.
     *
     * @return self An instance of the ProducPriceInputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
