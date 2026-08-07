<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class InstagramService
{
    protected string $token;
    protected string $accountId;

    public function __construct()
    {
        $this->token = config('services.instagram.access_token');
        $this->accountId = config('services.instagram.account_id');
    }

    public function getProfile()
    {
        $response = Http::get(
            "https://graph.instagram.com/{$this->accountId}",
            [
                'fields' => 'id,username,name,profile_picture_url,media_count,followers_count,follows_count',
                'access_token' => $this->token,
            ]
        );

        return $response->json();
    }

    public function getPosts()
    {
        $response = Http::get(
            "https://graph.instagram.com/{$this->accountId}/media",
            [
                'fields' => 'id,caption,media_type,media_url,thumbnail_url,permalink,like_count,comments_count',
                'access_token' => $this->token,
            ]
        );

        return $response->json('data', []);
    }

    public function getInstagramData()
    {
        return [
            'perfil' => $this->getProfile(),
            'posts' => $this->getPosts(),
        ];
    }
}