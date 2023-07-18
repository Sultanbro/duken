<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'price', 'description', 'indicator'];

    protected $hidden = ['created_at', 'updated_at'];

    use HasFactory;

    public function file()
    {
        return $this->belongsToMany(File::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function scopeCategory_id($query, $search)
    {
        if (!is_null($search)) {
            return $query->where('category_id', $search);
        }

        return $query;
    }

    public function scopeName($query, $search)
    {
        if (!is_null($search)) {
            return $query->where('name', 'LIKE', '%'.$search.'%');
        }

        return $query;
    }

    public function scopePrice($query, $search)
    {
        if (!is_null($search)) {
            return $query->where('price', $search);
        }

        return $query;
    }

    public function scopeDescription($query, $search)
    {
        if (!is_null($search)) {
            return $query->where('description', 'LIKE', '%'.$search.'%');
        }

        return $query;
    }

}
