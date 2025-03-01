<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Size extends Model
{
    use HasTranslations;
    protected $guarded = [];
    public $translatable = ['name'];
}