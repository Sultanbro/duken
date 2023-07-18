<?php


namespace App\Services\Category;


use App\Http\DTO\Category\CategoryCreateDTO;
use Illuminate\Database\Eloquent\Model;

interface CategoryServiceInterface
{
    /**
     * @return mixed
     */
    public function store(CategoryCreateDTO $categoryCreateDTO): Model;

    /**
     * @param CategoryCreateDTO $categoryCreateDTO
     * @param int $id
     * @return mixed
     */
    public function update(CategoryCreateDTO $categoryCreateDTO, int $id): Model;

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool;

}
