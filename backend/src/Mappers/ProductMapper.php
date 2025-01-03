<?php

namespace App\Mappers;

use App\Config\PurifierSingleton;
use App\GraphQL\Dto\Product\AttributeDto;
use App\GraphQL\Dto\Product\AttributeItemDto;
use App\GraphQL\Dto\Product\CategoryDto;
use App\GraphQL\Dto\Product\CurrencyDto;
use App\GraphQL\Dto\Product\GalleryDto;
use App\GraphQL\Dto\Product\PriceDto;
use App\GraphQL\Dto\Product\ProductDto;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeItem;
use App\Models\ProductGallery;
use App\Models\ProductPrice;

/**
 * Class ProductMapper
 * A mapper class responsible for converting Product entities into ProductDto objects.
 */
final class ProductMapper
{
    /**
     * Maps a Product entity to a ProductDto.
     *
     * @param Product $product The Product entity to map.
     * @return ProductDto The resulting ProductDto.
     */
    public static function map(Product $product): ProductDto
    {
        return new ProductDto(
            $product->getId(),
            $product->getName(),
            $product->getInStock(),
            $product->getDescription(),
            $product->getBrand(),
            self::mapGallery($product->getGallery()->toArray()),
            self::mapPrices($product->getPrices()->toArray()),
            self::mapAttributes($product->getAttributes()->toArray()),
            self::mapCategory($product->getCategory()),
        );
    }

    /**
     * Maps an array of ProductGallery entities to an array of GalleryDto objects.
     *
     * @param ProductGallery[] $gallery The gallery entities to map.
     * @return GalleryDto[] The resulting array of GalleryDto objects.
     */
    private static function mapGallery(array $gallery): array
    {
        return array_map(function (ProductGallery $item) {
            $imageUrl = PurifierSingleton::purify($item->getImageUrl());

            return new GalleryDto($item->getId(), $imageUrl);
        }, $gallery);
    }

    /**
     * Maps an array of ProductPrice entities to an array of PriceDto objects.
     *
     * @param ProductPrice[] $prices The price entities to map.
     * @return PriceDto[] The resulting array of PriceDto objects.
     */
    private static function mapPrices(array $prices): array
    {
        return array_map(function (ProductPrice $item) {
            return new PriceDto(
                $item->getId(),
                $item->getAmount(),
                new CurrencyDto(
                    $item->getCurrency()->getId(),
                    $item->getCurrency()->getLabel(),
                    $item->getCurrency()->getSymbol()
                )
            );
        }, $prices);
    }

    /**
     * Maps an array of ProductAttribute entities to an array of AttributeDto objects.
     *
     * @param ProductAttribute[] $attributes The attribute entities to map.
     * @return AttributeDto[] The resulting array of AttributeDto objects.
     */
    private static function mapAttributes(array $attributes): array
    {
        return array_map(function (ProductAttribute $attribute) {
            $items = array_map(function (ProductAttributeItem $item) {
                return new AttributeItemDto(
                    $item->getId(),
                    $item->getDisplayValue(),
                    $item->getValue()
                );
            }, $attribute->getItems()->toArray());

            return new AttributeDto(
                $attribute->getId(),
                $attribute->getName(),
                $attribute->getType(),
                $items
            );
        }, $attributes);
    }

    /**
     * Maps a Category entity to a CategoryDto object.
     *
     * @param Category $category The category entity to map.
     * @return CategoryDto The resulting CategoryDto object.
     */
    private static function mapCategory(Category $category): CategoryDto
    {
        return new CategoryDto(
            $category->getId(),
            $category->getName()
        );
    }
}
