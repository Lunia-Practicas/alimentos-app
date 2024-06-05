<?php

namespace App\Repositories;

use App\Models\Email;
use Carbon\Carbon;

class EmailRepository
{

    public function searchEmails($data)
    {
        $emails = Email::query();

        if (!is_null($data['id'])) {
            $emails->where('id', $data['id']);
        }

        if (!is_null($data['email'])) {
            $emails->where('email', $data['email']);
        }

        if (!is_null($data['name_client'])) {
            $emails->where('name_client', $data['name_client']);
        }

        if (!is_null($data['city'])) {
            $emails->where('city', $data['city']);
        }

        if (!is_null($data['address'])) {
            $emails->where('address', $data['address']);
        }

        if (!is_null($data['min_date'])) {
            $minDate = Carbon::parse($data['min_date'])->startOfDay();
            $emails->where('created_at', '>=', $minDate);
        }

        if (!is_null($data['max_date'])) {
            $maxDate = Carbon::parse($data['max_date'])->endOfDay();
            $emails->where('created_at', '<=', $maxDate);
        }

        return $emails->get();
    }

    public function deleteEmail($id)
    {
        Email::findOrFail($id)->delete();
    }
}
