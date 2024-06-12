<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderNotifyEmailAdmin;
use App\Mail\OrderNotifyEmailClient;
use App\Models\Audit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     * @throws \ReflectionException
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;

        $name = $order->name;
        $quantity = $order->quantity;
        $total = $order->total;
        $note = $order->note;
        $email = $order->email;

        $emailContent = (new OrderNotifyEmailClient($name, $total, $note, $quantity, $email))->render();

        try {
            Mail::to($email)->send(new OrderNotifyEmailClient($name, $total, $note, $quantity, $email));

            $bodyStart = strpos($emailContent, '<body>') + 6; // Obtener el índice de inicio del cuerpo
            $bodyEnd = strpos($emailContent, '</body>'); // Obtener el índice de fin del cuerpo
            $bodyLength = $bodyEnd - $bodyStart; // Calcular la longitud del cuerpo
            $bodyContent = substr($emailContent, $bodyStart, $bodyLength); // Extraer el contenido del cuerpo

            Audit::create([
                'addressee' => $email,
                'subject' => 'Order Client Notification',
                'body' => $bodyContent
            ]);

        }catch (\Exception $e){
            $bodyStart = strpos($emailContent, '<body>') + 6; // Obtener el índice de inicio del cuerpo
            $bodyEnd = strpos($emailContent, '</body>'); // Obtener el índice de fin del cuerpo
            $bodyLength = $bodyEnd - $bodyStart; // Calcular la longitud del cuerpo
            $bodyContent = substr($emailContent, $bodyStart, $bodyLength); // Extraer el contenido del cuerpo

            Audit::create([
                'addressee' => $email,
                'subject' => 'Order Client Notification',
                'body' => $bodyContent,
                'error' => $e->getMessage()
            ]);
        }

        try {
            Mail::to("jacain99laravel@gmail.com")->send(new OrderNotifyEmailAdmin($name, $total, $note, $quantity, $email));

            $bodyStart = strpos($emailContent, '<body>') + 6; // Obtener el índice de inicio del cuerpo
            $bodyEnd = strpos($emailContent, '</body>'); // Obtener el índice de fin del cuerpo
            $bodyLength = $bodyEnd - $bodyStart; // Calcular la longitud del cuerpo
            $bodyContent = substr($emailContent, $bodyStart, $bodyLength); // Extraer el contenido del cuerpo

            Audit::create([
                'addressee' => "jacain99laravel@gmail.com",
                'subject' => 'Order Client Notification',
                'body' => $bodyContent
            ]);
        } catch (\Exception $e){
            $bodyStart = strpos($emailContent, '<body>') + 6; // Obtener el índice de inicio del cuerpo
            $bodyEnd = strpos($emailContent, '</body>'); // Obtener el índice de fin del cuerpo
            $bodyLength = $bodyEnd - $bodyStart; // Calcular la longitud del cuerpo
            $bodyContent = substr($emailContent, $bodyStart, $bodyLength); // Extraer el contenido del cuerpo

            Audit::create([
                'addressee' => "jacain99laravel@gmail.com",
                'subject' => 'Order Client Notification',
                'body' => $bodyContent,
                'error' => $e->getMessage()
            ]);
        }

    }
}
