<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasOne(categories::class, 'id', 'category_id');
    }

    public function cloth()
    {
        return $this->hasOne(clothes::class, 'id', 'cloth_id');
    }

    public function color()
    {
        return $this->hasOne(colors::class, 'id', 'color_id');
    }

    public function brand()
    {
        return $this->hasOne(brands::class, 'id', 'brand_id');
    }

    public function size()
    {
        return $this->hasOne(sizes::class, 'id', 'size_id');
    }

    public function material()
    {
        return $this->hasOne(materials::class, 'id', 'material_id');
    }

    public function images()
    {
        return $this->hasMany(images::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');;
    }

    public function status()
    {
        return $this->hasOne(active::class, 'id', 'status_id');
    }

}
