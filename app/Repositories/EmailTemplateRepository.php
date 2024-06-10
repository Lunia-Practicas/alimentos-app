<?php

namespace App\Repositories;

use App\Models\EmailTemplate;

class EmailTemplateRepository
{

    public function create($data)
    {
        return EmailTemplate::create($data);
    }

    public function get($data)
    {
        $id = $data['id'];

        return EmailTemplate::findOrFail($id);
    }

    public function update($data, $id)
    {
        $emailTemplate = EmailTemplate::findOrFail($id);
        $emailTemplate->update($data);
        return $emailTemplate;
    }

    public function delete($id): void
    {
        $emailTemplate = EmailTemplate::findOrFail($id);
        $emailTemplate->delete();
    }

    public function getAll()
    {
        return EmailTemplate::all();
    }
}
