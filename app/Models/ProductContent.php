<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductContent extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'product_content';

    protected $fillable = [
        'description',
        'product_id',
        'title'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
