<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Orders;

class OrderRepository implements OrderRepositoryInterface
{

    public function getAllOrders()
    {
       return Orders::all();
    }

    public function getOrderById($orderId)
    {
        return Orders::find($orderId);
    }

    public function deleteOrder($orderId)
    {
        return Orders::destroy($orderId);
    }

    public function createOrder(array $orderDetails)
    {
        return Orders::create($orderDetails);
    }

    public function updateOrder($orderId, array $newDetails)
    {
        return Orders::whereId($orderId)->update($newDetails);
    }

    public function getTotalPriceByCustomerId($customerId)
    {
        return Orders::where('customerId', $customerId)->sum('total');
    }

    public function getOrderGroupByCustomerIdAndProductId($customerId)
    {
        return Orders::select("customerId", "productId")
            ->where("customerId", $customerId)
            ->groupBy('customerId', 'productId')
            ->selectRaw("SUM(quantity) as quantity")
            ->get();
    }
}
