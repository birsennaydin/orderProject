<?php

namespace App\Interfaces;

interface DiscountRepositoryInterface
{
    public function getAllDiscounts();

    public function getDiscountById($id);

    public function getDiscountByOrderId($orderId);

    public function deleteDiscount($id);
}
