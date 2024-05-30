<?php

namespace App\Models;

use App\Events\OrderCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Order extends Model
{
    protected $table = 'orders';

    use HasFactory, Notifiable;

    protected $fillable = ['order_num', 'email', 'product_id', 'category_id', 'note', 'quantity'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
           $model->order_num = self::generateOrderNum();
        });
    }

    private static function generateOrderNum(): string
    {
        $yearMonth = now()->format('Ym');
        $lastOrder = self::where('order_num','like', $yearMonth . '%')->orderBy('order_num', 'desc')->first();

        if ($lastOrder) {
            $lastOrder = (int)substr($lastOrder->order_num, -5);
            $newOrder = $lastOrder + 1;
        } else {
            $newOrder = 1;
        }

        return $yearMonth . str_pad($newOrder, 5, '0', STR_PAD_LEFT);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
