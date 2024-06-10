<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmailTemplate extends Model
{

    protected $table = 'email_templates';

    use HasFactory, Notifiable;

    protected $fillable = ['title', 'subject', 'body'];

    const UPDATED_AT = null;
}
