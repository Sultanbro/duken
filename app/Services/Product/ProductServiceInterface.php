<?php


namespace App\Services\Product;


use App\Http\DTO\Product\ProductCreateDTO;
use Illuminate\Database\Eloquent\Model;

interface ProductServiceInterface
{
    /**
     * @param ProductCreateDTO $productCreateDTO
     * @return Model
     */
    public function store(ProductCreateDTO $productCreateDTO): Model;

    /**
     * @param ProductCreateDTO $productCreateDTO
     * @param int $id
     * @return Model
     */
    public function update(ProductCreateDTO $productCreateDTO, int $id): Model;

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool;

    /**
     * @param array $images_id
     * @param int $product_id
     * @return mixed
     */
    public function addImage(array $images_id, int $product_id);

}
