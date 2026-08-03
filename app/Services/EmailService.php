<?php

namespace App\Services;

use App\Models\Contacto;

class EmailService
{

    public function __construct(
        private GmailService $gmailService
    ) {}


    public function enviarContacto(
        Contacto $contacto
    ): void {


        $html = view(
            'emails.contacto',
            [
                'contacto' => $contacto
            ]
        )->render();


        $this->gmailService->send(
            $contacto->correo,
            'Gracias por comunicarte conmigo',
            $html
        );
    }
}