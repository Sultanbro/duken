<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\DTO\Category\CategoryCreateDTO;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\Category\CategoryServiceInterface;
use App\Traits\Api\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
    use ApiResponser;

    /**
     * @var CategoryServiceInterface
     */
    private $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse(CategoryResource::collection(Category::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $categoryRequest)
    {
        return $this->successResponse(
            new CategoryResource(
                $this->categoryService->store(
            CategoryCreateDTO::formRequest($categoryRequest))));
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryRequest $categoryRequest, int $id)
    {
        return $this->successResponse(
            new CategoryResource(
                Category::query()->firstWhere('id', $id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $categoryRequest, int $id)
    {
            return $this->successResponse(
                new CategoryResource(
                    $this->categoryService->update(
                        CategoryCreateDTO::formRequest($categoryRequest), $id)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryRequest $categoryRequest, int $id)
    {
            return $this->successResponse($this->categoryService->destroy($id));
    }
}
