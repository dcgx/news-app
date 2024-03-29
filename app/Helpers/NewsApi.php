<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Arr;

/**
 * Class NewsApi
 * @package App
 */
class NewsApi
{
    public function makeCall($path, $method = 'GET', $data = [])
    {
        $client = new \GuzzleHttp\Client();
        $full_url = config('app.news.api_url') . $path;
        $api_key = config('app.news.api_key');
        $response = $client->request($method, $full_url .'&apiKey=' . $api_key);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function fetchAllNews($params = [])
    {
        $path = 'everything?q=news';
        return $this->makeCall($path);
    }

    public function fetchTopHeadlines($params = [])
    {
        $path = 'top-headlines';
        return $this->makeCall($path);
    }
}
