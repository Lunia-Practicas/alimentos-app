<?php

namespace App\Models;

use App\Events\OrdenCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Orden extends Model
{
    protected $table = 'ordens';

    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'quantity',
        'total',
        'note',
        'name'
    ];

}
