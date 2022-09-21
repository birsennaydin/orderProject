<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Products;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAllProduct()
    {
        return Products::all();
    }

    public function getProductById($productId)
    {
        return Products::findOrFail($productId);
    }

    public function createProduct(array $productDetails)
    {
       return Products::create($productDetails);
    }

    public function updateProduct($productId, $newDetails)
    {
        return Products::whereId($productId)->update($newDetails);
    }
}
