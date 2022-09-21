<?php

namespace App\Repositories;

use App\Interfaces\DiscountRepositoryInterface;
use App\Models\Discounts;

class DiscountRepository implements DiscountRepositoryInterface
{

    public function getAllDiscounts()
    {
        return Discounts::all();
    }

    public function getDiscountById($id)
    {
        return Discounts::find($id);
    }

    public function getDiscountByOrderId($orderId)
    {
        return Discounts::where('orderId', $orderId);
    }

    public function deleteDiscount($id)
    {
        return Discounts::destroy($id);
    }
}
