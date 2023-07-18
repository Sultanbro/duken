<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];

    protected $hidden = ['created_at', 'updated_at'];

    use HasFactory;

    public function childes()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
