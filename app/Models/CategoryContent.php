<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CategoryContent extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'category_content';

    protected $fillable = [
        'category_id',
        'description',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
