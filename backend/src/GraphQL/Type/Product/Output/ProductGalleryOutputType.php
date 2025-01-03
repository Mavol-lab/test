<?php

namespace App\GraphQL\Type\Product\Output;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

/**
 * This class represents the GraphQL ObjectType for the product gallery output.
 * It extends the base ObjectType provided by the GraphQL library.
 */
class ProductGalleryOutputType extends ObjectType
{
    private static ?self $instance = null;
    protected array $fields = [];
    protected array $interfaces = [];

    public function __construct()
    {
        parent::__construct([
            'name' => 'ProductGalleryOutput',
            'fields' => function () {
                return [
                    'id' => Type::nonNull(Type::int()),
                    'imageUrl' => Type::string()
                ];
            },
        ]);
    }

    /**
     * Get an instance of the ProductGalleryOutputType.
     *
     * @return self An instance of the ProductGalleryOutputType.
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
