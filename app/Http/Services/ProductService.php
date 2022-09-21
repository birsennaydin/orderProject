<?php

namespace App\Http\Services;

use App\Http\ApiTrait\CacheTrait;
use App\Repositories\ProductRepository;

class ProductService
{
    use CacheTrait;

    const PRODUCT_LIST = 'productList';
    const CACHE_PRODUCT_EXPIRE_LIMIT = 60;

    /**
     * @throws \Exception
     */
    public function getAllProduct()
    {
        try {
            $productListFromCache = $this->getCache(self::PRODUCT_LIST);
            if ($productListFromCache) {
                return $productListFromCache;
            }
            $productList = (new ProductRepository())->getAllProduct();
            $this->setCache(self::PRODUCT_LIST, $productList, self::CACHE_PRODUCT_EXPIRE_LIMIT);
            return $productList;
        } catch (\Exception $exception) {
            throw new \Exception('Could not take product list.');
        }
    }

    /**
     * @param int $productId
     * @return mixed
     * @throws \Exception
     */
    public function getProductById(int $productId)
    {
        try {
            return (new ProductRepository())->getProductById($productId);
        } catch (\Exception $exception) {
            throw new \Exception('Could not take product.');
        }
    }

    public function updateProductStockByOrderStock(object $productDetail, $orderDetail)
    {
        try {
            $productDetail->stock = (int)$productDetail->stock - (int)$orderDetail['quantity'];
            $productArray = [
                'name' => $productDetail->name,
                'stock' => $productDetail->stock,
                'category' => $productDetail->category,
                'price' => $productDetail->price
            ];
            return (new ProductRepository())->updateProduct($productDetail->id, $productArray);
        } catch (\Exception $exception) {
            throw new \Exception('Could not take product.');
        }
    }

    /**
     * @param array $productDetails
     * @return mixed
     * @throws \Exception
     */
    public function createProduct(array $productDetails)
    {
        try {
            return (new ProductRepository())->createProduct($productDetails);
        } catch (\Exception $exception) {
            throw new \Exception('Could not create product.');
        }
    }
}
