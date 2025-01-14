<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'quantity', 'category_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}