<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Email extends Model
{
    protected $table = 'emails';

    use HasFactory, Notifiable;

    protected $fillable = ['email'];

    const UPDATED_AT = null;

}
