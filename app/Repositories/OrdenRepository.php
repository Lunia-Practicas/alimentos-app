<?php

namespace App\Repositories;

use App\Mail\PruebaEmail;
use Illuminate\Support\Facades\Mail;

class OrdenRepository
{
    public function makeOrdenAndSendEmail($data): void
    {
        Mail::to($data['email'])->send(new PruebaEmail('Usuario'));
    }
}
