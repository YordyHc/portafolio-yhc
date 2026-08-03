<?php

namespace App\Services;

use App\Models\GoogleToken;
use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;

class GmailService
{
    private function getClient(): Client
    {
        $token = GoogleToken::findOrFail(1);

        $client = new Client();

        $client->setClientId(
            config('services.google.client_id')
        );

        $client->setClientSecret(
            config('services.google.client_secret')
        );

        $client->setRedirectUri(
            config('services.google.redirect')
        );


        $client->setAccessToken([
            'access_token' => $token->access_token,
            'refresh_token' => $token->refresh_token,
            'expires_in' => 3600,
            'created' => $token->created_at->timestamp
        ]);


        if ($client->isAccessTokenExpired()) {

            $newToken = $client->fetchAccessTokenWithRefreshToken(
                $token->refresh_token
            );


            $token->update([
                'access_token' => $newToken['access_token'],
                'expires_at' => now()->addSeconds(
                    $newToken['expires_in']
                )
            ]);
        }


        return $client;
    }


    public function send(
        string $to,
        string $subject,
        string $html
    ): void {

        $gmail = new Gmail(
            $this->getClient()
        );


        $rawMessage =
            "To: {$to}\r\n" .
            "Subject: {$subject}\r\n" .
            "Content-Type: text/html; charset=UTF-8\r\n\r\n" .
            $html;


        $encodedMessage = rtrim(
            strtr(
                base64_encode($rawMessage),
                '+/',
                '-_'
            ),
            '='
        );


        $message = new Message();

        $message->setRaw($encodedMessage);


        $gmail
            ->users_messages
            ->send(
                'me',
                $message
            );
    }
}