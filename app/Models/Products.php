<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function cloth()
    {
        return $this->hasOne(Clothes::class, 'id', 'cloth_id');
    }

    public function color()
    {
        return $this->hasOne(Colors::class, 'id', 'color_id');
    }

    public function brand()
    {
        return $this->hasOne(Brands::class, 'id', 'brand_id');
    }

    public function size()
    {
        return $this->hasOne(Sizes::class, 'id', 'size_id');
    }

    public function material()
    {
        return $this->hasOne(Materials::class, 'id', 'material_id');
    }

    public function images()
    {
        return $this->hasMany(Images::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');;
    }

    public function status()
    {
        return $this->hasOne(Active::class, 'id', 'status_id');
    }

}
