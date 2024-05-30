<?php

namespace App\Repositories;

use App\DTO\OrderInformationDTO;
use App\Events\OrderCreated;
use App\Listeners\SendOrderEmail;
use App\Mail\OrderNotifyEmailClient;
use App\Mail\OrderNotifyEmailAdmin;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class OrderRepository
{

    public function makeOrdenAndSendEmail($data)
    {
        $email = $data['email'];
        $note = $data['note'];
        $quantity = $data['quantity'];
        $total = $data['price'];

        $product = Product::findOrFail($data['id']);

        Order::create([
            'email' => $email,
            'product_id' => $product->id,
            'category_id' => $product->category_id,
            'note' => $note,
            'quantity' => $quantity,
        ]);
        event(new OrderCreated(new OrderInformationDTO($email, $quantity,  $total,  $note, $product->name)));

        return [
            'product' => $product,
            'quantity' => $quantity,
            'total' => $total,
            'note' => $note ?? null,
        ];
    }
}
