<?php


namespace App\JsonPlaceholderApi;


use Illuminate\Support\Facades\Http;

class JsonPlaceholderApi
{
    private const BASE_URL = 'https://jsonplaceholder.typicode.com/';

    private static $headers = [
        'Content-Type' => 'application/json; charset=UTF-8',
    ];

    public static function getResources(string $type)
    {
        $response = Http::withHeaders(self::$headers)
            ->get(self::BASE_URL . $type)
            ->throw();

        return $response->json();
    }
}
