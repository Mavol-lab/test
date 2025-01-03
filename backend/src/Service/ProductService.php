<?php

namespace App\Service;

use App\GraphQL\Dto\Product\CategoryDto;
use App\GraphQL\Dto\Product\ProductDto;
use App\GraphQL\Input\Cart\CartInput;
use App\GraphQL\Input\Product\ProductInput;
use App\Repository\ProductRepository;
use App\Models\Product;
use App\Mappers\ProductMapper;
use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Utils\ExceptionCode;

/**
 * Class ProductService
 * A service layer class for handling product-related operations.
 */
class ProductService
{
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;
    private CartRepository $cartRepository;

    /**
     * ProductService constructor.
     * Initializes the repositories required for product and category operations.
     *
     * @param ProductRepository $productRepository The repository for product-related operations.
     * @param CategoryRepository $categoryRepository The repository for category-related operations.
     * @param CartRepository $cartRepository The repository for cart-related operations.
     */
    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        CartRepository $cartRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->cartRepository = $cartRepository;
    }

    /**
     * Retrieves all products for a given category.
     *
     * @param string $category The category to filter products by.
     * @return ProductDto[] An array of ProductDto objects.
     */
    public function getAllProducts(string $category): array
    {
        $products = $this->productRepository->getAll($category);

        return array_map(function (Product $product) {
            return ProductMapper::map($product);
        }, $products);
    }

    /**
     * Retrieves all categories.
     *
     * @return CategoryDto[] An array of CategoryDto objects.
     */
    public function getAllCategories(): array
    {
        return $this->categoryRepository->getAllCategories();
    }

    /**
     * Retrieves a single product by its ID.
     *
     * @param string $id The ID of the product to retrieve.
     * @return ProductDto The ProductDto object representing the product.
     */
    public function getProductById(string $id): ProductDto
    {
        $product = $this->productRepository->getProductById($id);

        return ProductMapper::map($product);
    }

    /**
     * Adds a product to the cart.
     *
     * @param CartInput $input The input data for adding the product to the cart.
     * @return bool True if the product was added successfully, false otherwise.
     */
    public function addToCart(CartInput $input): bool
    {
        return $this->cartRepository->addToCart($input);
    }

    /**
     * Adds a new product to the repository.
     *
     * @param ProductInput $input An associative array containing product data.
     * @return Product The newly created Product entity.
     */
    public function addProduct(ProductInput $input): Product
    {
        $category = $this->categoryRepository->getCategory($input->categoryId);

        if (!$category) {
            throw new ExceptionCode(400, "Invalid category");
        }

        $product = new Product(
            $input->name,
            $input->inStock,
            $input->description,
            $input->brand,
            $category
        );

        return $this->productRepository->add($product);
    }
}
