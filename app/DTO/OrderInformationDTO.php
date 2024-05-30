<?php

namespace App\DTO;

readonly class OrderInformationDTO
{
    public string $email;
    public int $quantity;
    public float $total;
    public string|null $note;
    public string $name;

    /**
     * @param string $email
     * @param int $quantity
     * @param float $total
     * @param string|null $note
     * @param string $name
     */
    public function __construct(string $email, int $quantity, float $total, ?string $note, string $name)
    {
        $this->email = $email;
        $this->quantity = $quantity;
        $this->total = $total;
        $this->note = $note;
        $this->name = $name;
    }
}
