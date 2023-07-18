<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\DTO\Product\ProductCreateDTO;
use App\Http\Requests\Product\ImageRequest;
use App\Http\Requests\Product\ProductFilterRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\Product\ProductServiceInterface;
use App\Traits\Api\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    use ApiResponser;

    /**
     * @var ProductServiceInterface
     */
    private $productService;

    /**
     * ProductController constructor.
     * @param ProductServiceInterface $productService
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse(ProductResource::collection(Product::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $productRequest)
    {
        return $this->successResponse(
            new ProductResource(
                $this->productService->store(
                    ProductCreateDTO::formRequest($productRequest)
                )
            )
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductRequest $productRequest, int $id)
    {
            return $this->successResponse(
                new ProductResource(
                    Product::query()->firstWhere('id', $id)
                )
            );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $productRequest, int $id)
    {
        return $this->successResponse(
            new ProductResource(
                $this->productService->update(
                    ProductCreateDTO::formRequest($productRequest), $id
                )
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductRequest $productRequest, int $id)
    {
        return $this->successResponse($this->productService->destroy($id));
    }

    /**
     * @param ProductFilterRequest $productFilterRequest
     * @return AnonymousResourceCollection
     */
    public function filter(ProductFilterRequest $productFilterRequest)
    {
        return ProductResource::collection(Product::query()
            ->category_id($productFilterRequest->category_id)
            ->name($productFilterRequest->name)
            ->price($productFilterRequest->price)
            ->description($productFilterRequest->description));
    }

    /**
     * @param ImageRequest $imageRequest
     * @return mixed
     */
    public function addImage(ImageRequest $imageRequest)
    {
        return $this->productService->addImage($imageRequest->files_id, $imageRequest->product_id);
    }
}
