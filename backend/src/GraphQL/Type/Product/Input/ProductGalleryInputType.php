<?php

namespace App\GraphQL\Type\Product\Input;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

/**
 * This class represents the input type for product gallery in GraphQL.
 * It extends the InputObjectType to define the structure of the input
 * for product gallery operations.
 */
class ProductGalleryInputType extends InputObjectType
{
    private static ?self $instance = null;

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProducGalleryInput',
            'fields' => [
                'imageUrl' => Type::string()
            ]
        ]);
    }

    /**
     * Get an instance of the ProducGalleryInputType.
     *
     * @return self An instance of the ProducGalleryInputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
