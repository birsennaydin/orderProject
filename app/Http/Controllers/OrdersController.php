<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPostRequest;
use App\Http\Services\OrderService;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            return response()->json(['message' => 'success', 'data' => $this->orderService->getAllOrders()]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'data' => ''], 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderPostRequest $request)
    {

        $request->validated();
        $orderDetails = $request->only([
            'customerId',
            'productId',
            'quantity',
            'unitPrice',
            'total'
        ]);

        try {
            $productDetail = $this->orderService->checkProductStockByOrderDetails($orderDetails);
            $result = $this->orderService->createOrder($orderDetails);
            (new ProductService())->updateProductStockByOrderStock($productDetail, $orderDetails);
            return response()->json(['message' => 'success', 'data' => $result]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'data' => ''], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|int'
            ]);
            $orderId = $request->id;
            $this->orderService->deleteOrderByOrderId($orderId);
            return response()->json(['message' => true]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }
}
