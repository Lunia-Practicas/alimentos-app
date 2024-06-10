<?php

namespace App\Repositories;

use App\Mail\GenerateEmail;
use App\Models\Email;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

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

    public function generateEmail($data)
    {
        $subjectContent = $data['subjectContent'];
        $htmlContent = $data['htmlContent'];
    }

    public function sendGenerateEmail($data)
    {
        $subjectContent = $data['subjectContent'];
        $htmlContent = $data['htmlContent'];

//        $dom = new DomDocument();
//
//        $dom->loadHTML($htmlContent);
//
//        $images = $dom->getElementsByTagName('img');
//
//        foreach ($images as $image) {
//            $src = $image->getAttribute('src');
//
//            list($type, $data) = explode(';', $src);
//            list(, $data)      = explode(',', $data);
//
//            // Decodificar los datos en base64
//            $data = base64_decode($data);
//
//            // Generar un nombre de archivo único
//            $imageName = 'imagen_' . time() . '_' . uniqid() . '.jpg';
//
//            Storage::disk('public')->put('imagenes/'.$imageName, $data);
//
//            $newSrc = asset(Storage::disk('public')->url('imagenes/'.$imageName));
//
//            $image->setAttribute('src', $newSrc);
//        }
//        $newHtml = $dom->saveHTML();

        $resp = [];

        $emails = Email::all();
        foreach ($emails as $email) {
            if(Mail::to($email->email)->send(new GenerateEmail($subjectContent, $htmlContent))){
                $resp[] = [
                    'email' => $email->email,
                    'response' => 'Send',
                ];
            }else{
                $resp[] = [
                    'email' => $email->email,
                    'response' => 'Error',
                ];
            }
        }

        return $resp;

    }
}
