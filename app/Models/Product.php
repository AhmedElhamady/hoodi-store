<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
    public function variant()
    {
        return $this->hasOne(Variant::class)
            ->where('is_main', true)
            ->orderByDesc('id')
            ->withDefault(function () {
                return $this->variants()->first(); // Get any available variant if no main variant exists
            });
    }
}