<?php


namespace App\Services\Basket;


use App\Http\DTO\Product\ProductCreateDTO;
use Illuminate\Database\Eloquent\Model;

interface BasketServiceInterface
{
    /**
     * @param array $products_id
     * @param int $user_id
     * @return mixed
     */
    public function inBasket(array $products_id, int $user_id);

    /**
     * @param array $products_id
     * @param int $user_id
     * @return mixed
     */
    public function deleteProductInBasket(array $products_id, int $user_id);

}
