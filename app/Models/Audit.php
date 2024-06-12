<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Audit extends Model
{

    protected $table = 'audits';

    use HasFactory, Notifiable;

    protected $fillable = ['addressee', 'subject', 'body', 'error', 'pdf'];

    const UPDATED_AT = null;
}
