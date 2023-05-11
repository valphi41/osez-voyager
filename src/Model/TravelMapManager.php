<?php

namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;

class TravelMapManager extends AbstractManager
{
    public function getAll()
    {
        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://restcountries.com/v3.1/all'
        );
        return $response->toArray();
    }
}
