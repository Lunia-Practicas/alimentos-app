<?php

namespace App\Repositories;

use App\DTO\EmailInformationDTO;
use App\DTO\OrderInformationDTO;
use App\Events\EmailCreated;
use App\Events\OrderCreated;
use App\Exports\OrdersExport;
use App\Models\Audit;
use App\Models\Category;
use App\Models\Email;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class OrderRepository
{

    public function makeOrdenAndSendEmail($data)
    {
        $email = $data['email'];
        $note = $data['note'];
        $quantity = $data['quantity'];
        $total = $data['price'];
        $name_client = $data['name_client'];
        $city = $data['city'];
        $address = $data['address'];

        $product = Product::findOrFail($data['id']);

        Order::create([
            'email' => $email,
            'product_id' => $product->id,
            'category_id' => $product->category_id,
            'note' => $note,
            'quantity' => $quantity,
        ]);


        event(new OrderCreated(new OrderInformationDTO($email, $quantity,  $total,  $note, $product->name)));
        event(new EmailCreated(new EmailInformationDTO($email, $name_client, $city, $address)));

        return [
            'product' => $product,
            'quantity' => $quantity,
            'total' => $total,
            'note' => $note ?? null,
        ];
    }

    public function searchOrders($data)
    {

        $orders = Order::query();

        if (!is_null($data['order_num'])){
            $orders->where('order_num', 'like',"%{$data['order_num']}%");
        }

        if(!is_null($data['email'])){
            $orders->where('email', 'like', "%{$data['email']}%");
        }

        if(!is_null($data['product_name'])){
            $product = Product::where('name', 'like', "%{$data['product_name']}%")->first();
            if ($product !== null){
                $orders->where('product_id', 'like', $product->id);
            }else{
                $orders->where('product_id', '===', 'null');
            }

        }

        if(!is_null($data['category_id'])){
            $category = Category::where('id', 'like', "%{$data['category_id']}%")->first();
            if ($category !== null){
                $orders->where('category_id', 'like', $category->id);
            }else{
                $orders->where('category_id', '===', 'null');
            }

//            $orders->where('category_id', 'like', "%{$data['category_id']}%");
        }

        if(!is_null($data['note'])){
            $orders->where('note', 'like', "%{$data['note']}%");
        }

        if(!is_null($data['quantity'])){
            $orders->where('quantity', 'like', "%{$data['quantity']}%");
        }

        if(!is_null($data['min_date'])){
            $minDate = Carbon::parse($data['min_date'])->startOfDay();
            $orders->where('created_at', '>=', $minDate);
        }

        if(!is_null($data['max_date'])){
            $maxDate = Carbon::parse($data['max_date'])->endOfDay();
            $orders->where('created_at', '<=', $maxDate);
        }

        return $orders->get();

    }

    public function exportExcel($data)
    {
        $export = new OrdersExport($data);

        return Excel::download($export, 'orders.xlsx');
    }

    public function generateOrderPdf($data)
    {
        $order = Order::where('order_num', $data['order_num'])->first();
        $product = Product::where('id', $order->product_id)->first();
        $category = Category::where('id', $order->category_id)->first();
        $client = Email::where('email', $order->email)->first();

        $order_pdf = [
            'order' => $order,
            'product' => $product,
            'category' => $category,
            'company' => [
                'name' => config('aliments.company_name'),
                'direction' => config('aliments.company_direction'),
                'contact' => config('aliments.company_contact'),
                'email' => config('aliments.company_email'),
            ],
            'client' => $client,
        ];

        $pdf = Pdf::loadView('pdf.order', $order_pdf);
        return $pdf->download('order.pdf');
    }

    public function sendOrderPdfEmail($data)
    {
        $order = Order::where('order_num', $data['order_num'])->first();
        $product = Product::where('id', $order->product_id)->first();
        $category = Category::where('id', $order->category_id)->first();
        $client = Email::where('email', $order->email)->first();

        $order_pdf = [
            'order' => $order,
            'product' => $product,
            'category' => $category,
            'company' => [
                'name' => config('aliments.company_name'),
                'direction' => config('aliments.company_direction'),
                'contact' => config('aliments.company_contact'),
                'email' => config('aliments.company_email'),
            ],
            'client' => $client,
        ];

        $pdf = Pdf::loadView('pdf.order', $order_pdf);

        $pdfName = 'order_'.$order->order_num.'_'.time().'.pdf';

        Storage::put('public/pdfs/'.$pdfName,$pdf->output());

        try {
            Mail::send('pdf.order-send', $order_pdf, function ($message) use ($order_pdf, $pdf) {
                $message->to($order_pdf['order']->email, $order_pdf['order']->email)
                    ->subject('Número pedido: '.$order_pdf['order']->order_num)
                    ->attachData($pdf->output(), "order.pdf");
            });
            Audit::create([
                'addressee' => $order_pdf['order']->email,
                'subject' => 'Número pedido: '.$order_pdf['order']->order_num,
                'body' => "Enlace pdf",
                'pdf' => $pdfName,
            ]);
        } catch (\Exception $e) {
            Audit::create([
                'addressee' => $order_pdf['order']->email,
                'subject' => 'Número pedido: '.$order_pdf['order']->order_num,
                'body' => "Enlace pdf",
                'error' => $e->getMessage(),
                'pdf' => $pdfName,
            ]);
        }

        return $pdf->download('order.pdf');
    }
}

