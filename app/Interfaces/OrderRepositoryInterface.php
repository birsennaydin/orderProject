<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function getAllOrders();

    public function getOrderById($orderId);

    public function getTotalPriceByCustomerId($customerId);

    public function deleteOrder($orderId);

    public function createOrder(array $orderDetails);

    public function updateOrder($orderId, array $newDetails);

    public function getOrderGroupByCustomerIdAndProductId($customerId);
}
