<?php

namespace App\Services;

use App\Mail\NuevoContactoMail;
use App\Models\Contacto;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function enviarContacto(Contacto $contacto): void
    {
        Mail::to($contacto->correo)
            ->send(new NuevoContactoMail($contacto));
    }
}
