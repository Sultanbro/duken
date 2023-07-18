<?php

namespace App\Http\Controllers\Api\Basket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basket\BasketRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\User;
use App\Services\Basket\BasketServiceInterface;
use App\Traits\Api\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    use ApiResponser;

    /**
     * @var BasketServiceInterface
     */
    private $basketService;

    /**
     * BasketController constructor.
     * @param BasketServiceInterface $basketService
     */
    public function __construct(BasketServiceInterface $basketService)
    {
        $this->basketService = $basketService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $user = User::query()->firstWhere('id', Auth::id());
        return ProductResource::collection($user->basket);
    }

    /**
     * @param BasketRequest $basketRequest
     * @return JsonResponse
     */
    public function inBasket(BasketRequest $basketRequest)
    {
        return $this->successResponse(
            ProductResource::collection(
                $this->basketService->inBasket($basketRequest->products, Auth::id()
                )
            )
        );
    }

    /**
     * @param BasketRequest $basketRequest
     * @return mixed
     */
    public function deleteProductInBasket(BasketRequest $basketRequest)
    {
        return $this->successResponse(
            ProductResource::collection(
                $this->basketService->deleteProductInBasket($basketRequest->products, Auth::id())
            )
        );
    }
}
