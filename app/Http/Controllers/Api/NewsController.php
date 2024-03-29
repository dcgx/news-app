<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\NewsApi;
use App\Helpers\RandomUserApi;

class NewsController extends Controller
{
    public function index()
    {
        $newsApi = new NewsApi();
        $randomUserApi = new RandomUserApi();
        $news = $newsApi->fetchAllNews();
        $randomUsers = $randomUserApi->generateManyRandomUsers(100);


        foreach ($news['articles'] as $key => $article) {
            $news['articles'][$key]['randomUser'] = $randomUsers[$key];
        }
        return response()->json($news);
    }
}
