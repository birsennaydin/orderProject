<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountPostRequest;
use App\Http\Services\DiscountService;
use Illuminate\Http\JsonResponse;

class DiscountsController extends Controller
{
    /**
     * @param DiscountPostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function discountCalculate(DiscountPostRequest $request): JsonResponse
    {
        try {
            $request->validated();
            $customerId = $request->customerId;
            return response()->json(['message' => 'success', 'data' => (new DiscountService())->calculateShoppingPriceByCustomerIdOnOrder($customerId)]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'data' => ''], 400);
        }
    }
}
