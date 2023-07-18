<?php


namespace App\Services\Category;



use App\Http\DTO\Category\CategoryCreateDTO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryService implements CategoryServiceInterface
{
    /**
     * @param CategoryCreateDTO $categoryCreateDTO
     * @return Model
     */
    public function store(CategoryCreateDTO $categoryCreateDTO): Model
    {
        return Category::query()->create($categoryCreateDTO->toArray());
    }


    /**
     * Update the specified resource in storage.
     * @param CategoryCreateDTO $categoryCreateDTO
     * @param int $id
     * @return Model
     */
    public function update(CategoryCreateDTO $categoryCreateDTO, int $id): Model
    {
        $category = Category::query()->firstWhere('id', $id);
        $category->update($categoryCreateDTO->toArray());

        return $category;
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $category = Category::query()->firstWhere('id', $id);
        return $category->delete();
    }

}
