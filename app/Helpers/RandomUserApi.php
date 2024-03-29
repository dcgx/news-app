<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Arr;

/**
 * Class RandomUser
 * @package App
 */
class RandomUserApi
{
    public function makeCall($options=[])
    {
        $client = new \GuzzleHttp\Client();
        $full_url = config('app.random_user.api_url') . '?' . http_build_query($options);
        $response = $client->request('GET', $full_url);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function generateRandomUser()
    {
        $randomUser = $this->makeCall();
        return [
            'name' => $randomUser['results'][0]['name']['first'] . ' ' . $randomUser['results'][0]['name']['last'],
            'email' => $randomUser['results'][0]['email'],
            'phone' => $randomUser['results'][0]['phone'],
            'cell' => $randomUser['results'][0]['cell'],
            'dob' => $randomUser['results'][0]['dob']['date'],
            'picture' => $randomUser['results'][0]['picture']['large'],
        ];
    }

    public function generateManyRandomUsers($count = 10)
    {
        $response = $this->makeCall(['results' => $count]);
        $randomUsers = [];
        foreach ($response['results'] as $randomUser) {
            $randomUsers[] = [
                'name' => $randomUser['name']['first'] . ' ' . $randomUser['name']['last'],
                'email' => $randomUser['email'],
                'phone' => $randomUser['phone'],
                'cell' => $randomUser['cell'],
                'dob' => $randomUser['dob']['date'],
                'picture' => $randomUser['picture']['large'],
            ];
        }
        return $randomUsers;
    }
}
