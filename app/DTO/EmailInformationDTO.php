<?php

namespace App\DTO;

readonly class EmailInformationDTO
{
    public string $email;
    public string $name_client;
    public string $city;
    public string $address;

    public function __construct(string $email, string $name_client, string $city, string $address)
    {
        $this->email = $email;
        $this->name_client = $name_client;
        $this->city = $city;
        $this->address = $address;
    }

}
