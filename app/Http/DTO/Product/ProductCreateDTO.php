<?php


namespace App\Http\DTO\Product;


use Illuminate\Http\Request;

class ProductCreateDTO
{
    public function __construct(
        public int $category_id,
        public string $name,
        public int $price,
        public string $description,
        public boolean|false $indicator,
    )
    {}

    public static function formRequest(Request $request)
    {
        return new static(
            $request->get('category_id'),
            $request->get('name'),
            $request->get('price'),
            $request->get('description'),
            is_null($request->get('indicator')) ? false : $request->get('indicator')
            );
    }

    public function toArray(): array
    {
        return [
            'category_id' => $this->category_id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'indicator' => $this->indicator,
        ];
    }
}
