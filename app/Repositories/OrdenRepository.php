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
        $id_product = $data['id'];
        $note = $data['note'];
        $quantity = $data['quantity'];
        $total = $data['price'];

        $product = Product::findOrFail($id_product)->first();

        $orden = Orden::create([
            'email' => $email,
            'quantity' => $quantity,
            'total' => $total,
            'note' => $note ?? null,
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
