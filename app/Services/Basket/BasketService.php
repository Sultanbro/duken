<?php


namespace App\Services\Basket;

use App\Http\DTO\Product\ProductCreateDTO;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BasketService implements BasketServiceInterface
{
    /**
     * @param array $products_id
     * @param int $user_id
     * @return HigherOrderBuilderProxy|mixed
     */
    public function inBasket(array $products_id, int $user_id)
    {
        $user = User::query()->firstWhere('id', $user_id);
        $user->basket()->attach($products_id);
        return $user->basket;
    }


    /**
     * @param array $products_id
     * @param int $user_id
     * @return HigherOrderBuilderProxy|mixed
     */
    public function deleteProductInBasket(array $products_id, int $user_id)
    {
        $user = User::query()->firstWhere('id', $user_id);
        $user->basket()->detach($products_id);
        return $user->basket;
    }
}
