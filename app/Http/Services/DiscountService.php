<?php

namespace App\Http\Services;

use App\Repositories\DiscountRepository;
use App\Repositories\OrderRepository;

class DiscountService
{
    const SHOPPING_MIN_LIMIT_FOR_DISCOUNT = 999;
    const DISCOUNT_PERCENT = 10;
    const CATEGORY_2_MIN_PRODUCT_FOR_DISCOUNT = 6;
    const CATEGORY_1_MIN_PRODUCT_FOR_DISCOUNT = 2;
    const CATEGORY_1 = 1;
    const CATEGORY_2 = 2;
    const CATEGORY_1_DISCOUNT_PERCENT = 20;


    private $discountRepository;

    public function __construct()
    {
        $this->discountRepository = new DiscountRepository();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getAllDiscounts()
    {
        try {
            return $this->discountRepository->getAllDiscounts();
        } catch (\Exception $exception) {
            throw new \Exception('Could not take discount list.');
        }
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function getDiscountById(int $id)
    {
        try {
            return $this->discountRepository->getDiscountById($id);
        } catch (\Exception $exception) {
            throw new \Exception('Could not take discount.');
        }
    }

    /**
     * @param int $orderId
     * @return mixed
     * @throws \Exception
     */
    public function getDiscountByOrderId(int $orderId)
    {
        try {
            return $this->discountRepository->getDiscountByOrderId($orderId);
        } catch (\Exception $exception) {
            throw new \Exception('Could not take discount.');
        }
    }


    /**
     * @param $customerId
     * @return float|int
     */
    public function calculateShoppingPriceByCustomerIdOnOrder($customerId)
    {
        $totalPrice = (new OrderRepository())->getTotalPriceByCustomerId($customerId);
        if ($totalPrice < self::SHOPPING_MIN_LIMIT_FOR_DISCOUNT) {
            return $this->calculateDiscountPercent($totalPrice, $totalPrice);
        }
        $productIdsGroupCustomerId = (new OrderRepository())->getOrderGroupByCustomerIdAndProductId($customerId)->toArray();
        if (!empty($productIdsGroupCustomerId)) {
            foreach ($productIdsGroupCustomerId as $item) {
                try {
                    $productDetail = (new ProductService())->getProductById($item['productId'])->toArray();
                    if ($productDetail['category'] === self::CATEGORY_1 && $item['quantity'] >= self::CATEGORY_1_MIN_PRODUCT_FOR_DISCOUNT) {
                        $totalPrice = $this->calculateDiscountPercent($totalPrice, $productDetail['price'], self::CATEGORY_1_DISCOUNT_PERCENT);
                    }
                    if ($productDetail['category'] === self::CATEGORY_2 && $item['quantity'] >= self::CATEGORY_2_MIN_PRODUCT_FOR_DISCOUNT) {
                        $totalPrice = $totalPrice - $this->calculateDiscountAmountForProductCount($item['quantity'], self::CATEGORY_2_MIN_PRODUCT_FOR_DISCOUNT, $productDetail['price']);
                    }
                } catch (\Exception $exception) {
                    continue;
                }
            }
        }
        return $totalPrice;
    }

    /**
     * @param $totalPrice
     * @param $productPrice
     * @param int $discountAmount
     * @return float|int
     */
    public function calculateDiscountPercent($totalPrice, $productPrice, int $discountAmount = self::DISCOUNT_PERCENT)
    {
        return $totalPrice - ($productPrice * $discountAmount / 100);
    }

    /**
     * @param $boughtProductCount
     * @param $discountProductCount
     * @param $price
     * @return float|int
     */
    public function calculateDiscountAmountForProductCount($boughtProductCount, $discountProductCount, $price)
    {
        return intval($boughtProductCount / $discountProductCount) * $price;
    }


}
