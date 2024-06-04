<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromArray, WithHeadings
{

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function array(): array
    {
        return $this->data;

    }

    public function headings(): array
    {
        return [
            'order_num',
            'email',
            'product_name',
            'category_name',
            'note',
            'quantity',
            'date_issue'
        ];
    }
}
