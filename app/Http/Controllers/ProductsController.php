<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPostRequest;
use App\Http\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{


    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function index()
    {
        try {
            return response()->json(['message' => 'success', 'data' => $this->productService->getAllProduct()]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'data' => ''], 400);
        }
    }

    /**
     * @param ProductPostRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(ProductPostRequest $request)
    {
        $request->validated();
        $productDetails = $request->only([
            'name',
            'category',
            'price',
            'stock'
        ]);
        try {
            return response()->json(['message' => 'success', 'data' => $this->productService->createProduct($productDetails)]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'data' => ''], 400);
        }
    }
}
