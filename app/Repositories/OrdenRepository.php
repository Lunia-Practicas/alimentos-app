<?php

namespace App\Repositories;

use App\Events\OrdenCreated;
use App\Listeners\SendOrdenEmail;
use App\Mail\OrdenNotifyEmailClient;
use App\Mail\OrdenNotifyEmailAdmin;
use App\Models\Orden;
use App\Models\Product;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class OrdenRepository
{

    public function makeOrdenAndSendEmail($data)
    {
        $email = $data['email'];
        $note = $data['note'];
        $quantity = $data['quantity'];
        $total = $data['price'];

        $product = Product::findOrFail($data['id']);

        $orden = Orden::create([
            'email' => $email,
            'quantity' => $quantity,
            'total' => $total,
            'note' => $note,
            'name' => $product->name,
        ]);
        event(new OrdenCreated($orden));

        return [
            'product' => $product,
            'quantity' => $quantity,
            'total' => $total,
            'note' => $note ?? null,
        ];
    }
}
