<?php

namespace App\Http\Responses;

class DiscountResponse
{
    /**
     * {
    "orderId": 3,
    "discounts": [
    {
    "discountReason": "BUY_5_GET_1",
    "discountAmount": "11.28",
    "subtotal": "1263.90"
    },
    {
    "discountReason": "10_PERCENT_OVER_1000",
    "discountAmount": "127.51",
    "subtotal": "1136.39"
    }
    ],
    "totalDiscount": "138.79",
    "discountedTotal": "1136.39"
    }
     */
protected $orderId = 0;
protected $discounts = [
    'discountReason' => 'BUY_5_GET_1',
    'discountAmount' => '0.0',
    'subtotal' =>'0.0'
];
protected $totalDiscount = 0.0;
protected $discountedTotal = 0.0;

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     */
    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string[]
     */
    public function getDiscounts(): array
    {
        return $this->discounts;
    }

    /**
     * @param string[] $discounts
     */
    public function setDiscounts(array $discounts): void
    {
        $this->discounts = $discounts;
    }

    /**
     * @return float
     */
    public function getTotalDiscount(): float
    {
        return $this->totalDiscount;
    }

    /**
     * @param float $totalDiscount
     */
    public function setTotalDiscount(float $totalDiscount): void
    {
        $this->totalDiscount = $totalDiscount;
    }

    /**
     * @return float
     */
    public function getDiscountedTotal(): float
    {
        return $this->discountedTotal;
    }

    /**
     * @param float $discountedTotal
     */
    public function setDiscountedTotal(float $discountedTotal): void
    {
        $this->discountedTotal = $discountedTotal;
    }

}
