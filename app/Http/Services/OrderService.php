<?php

namespace App\Http\Services;

use App\Http\ApiTrait\CacheTrait;
use App\Interfaces\OrderRepositoryInterface;

class OrderService
{
    use CacheTrait;

    const ORDER_LIST = 'orderList';
    const CACHE_ORDER_EXPIRE_LIMIT = 60;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getAllOrders()
    {
        try {
            $orderListFromCache = $this->getCache(self::ORDER_LIST);
            if ($orderListFromCache) {
                return $orderListFromCache;
            }
            $orderList = $this->orderRepository->getAllOrders();
            $this->setCache(self::ORDER_LIST, $orderList, self::CACHE_ORDER_EXPIRE_LIMIT);
            return $orderList;
        } catch (\Exception $exception) {
            throw new \Exception('Could not take order list.');
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function getOrderById($id)
    {
        try {
            return $this->orderRepository->getOrderById($id);
        } catch (\Exception $exception) {
            throw new \Exception('Could not take order.');
        }
    }

    /**
     * @param array $orderDetails
     * @return mixed
     * @throws \Exception
     */
    public function createOrder(array $orderDetails)
    {
        try {
            return $this->orderRepository->createOrder($orderDetails);
        } catch (\Exception $exception) {
            throw new \Exception('Could not create order.');
        }
    }

    /**
     * @param array $orderDetails
     * @return mixed
     * @throws \Exception
     */
    public function checkProductStockByOrderDetails(array $orderDetails)
    {
        try {
            $productDetail = (new ProductService())->getProductById($orderDetails['productId']);
            if (!$productDetail || $productDetail->stock < $orderDetails["quantity"]) {
                throw new \Exception('The Product Stock is not enough.');
            }
            return $productDetail;
        } catch (\Exception $exception) {
            throw new \Exception('The Product Stock is not enough.');
        }
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function deleteOrderByOrderId(int $id)
    {
        try {
            if($this->orderRepository->deleteOrder($id)){
             return true;
            }
            throw new \Exception('The Order was could not deleted.');
        } catch (\Exception $exception) {
            throw new \Exception('The Order was could not deleted.');
        }
    }

}
