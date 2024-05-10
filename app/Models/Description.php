<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Description extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'descriptions';

    protected $fillable = [
        'description',
        'product_id'
    ];

    public function description()
    {
        return $this->belongsTo(Product::class);
    }
}
