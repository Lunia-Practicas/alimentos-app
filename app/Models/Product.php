<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{

    use HasFactory, Notifiable;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'weight',
        'origin',
        'price',
        'vegan',
        'gluten',
        'created_by', 'updated_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
