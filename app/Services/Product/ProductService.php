<?php


namespace App\Services\Product;

use App\Http\DTO\Product\ProductCreateDTO;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductService implements ProductServiceInterface
{
    /**
     * @param ProductCreateDTO $productCreateDTO
     * @return Model
     */
    public function store(ProductCreateDTO $productCreateDTO): Model
    {
        return Product::query()->create($productCreateDTO->toArray());
    }


    /**
     * @param ProductCreateDTO $productCreateDTO
     * @param int $id
     * @return Model
     */
    public function update(ProductCreateDTO $productCreateDTO, int $id): Model
    {
        $category = Product::query()->firstWhere('id', $id);
        $category->update($productCreateDTO->toArray());

        return $category;
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $product = Product::query()->firstWhere('id', $id);
        $product->file()->delete();
        return $product->delete();
    }

    /**
     * @inheritDoc
     */
    public function addImage(array $images_id, int $product_id)
    {
        $product =  Product::query()->firstWhere('id', $product_id);
        $product->file()->attach($images_id);
        return $product->file;
    }
}
