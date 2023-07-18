<?php


namespace App\Http\DTO\Category;


use Illuminate\Http\Request;

class CategoryCreateDTO
{
    public function __construct(
        public string $name,
        public int|null $parent_id,
    )
    {}

    public static function formRequest(Request $request)
    {
        return new static(
            $request->get('name'),
            $request->get('parent_id')
            );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ];
    }
}
