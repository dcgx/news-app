<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\NewsApi;
use App\Helpers\RandomUserApi;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $newsApi = new NewsApi();
        $randomUserApi = new RandomUserApi();

        $page = $request->query('page', 1);
        $perPage = $request->query('perPage', 10);

        $startIndex = ($page - 1) * $perPage;

        $news = $newsApi->fetchAllNews(['page' => $page, 'perPage' => $perPage]);
        $totalResults = 50; // Max limited for free tier

        $randomUsers = $randomUserApi->generateManyRandomUsers(100);

        foreach ($news['articles'] as $key => $article) {
            $news['articles'][$key]['randomUser'] = $randomUsers[$key];
        }
        $paginatedNews = array_slice($news['articles'], $startIndex, $perPage);


        $response = [
            'articles' => $paginatedNews,
            'totalResults' => $totalResults
        ];
        return response()->json($response);
    }
}
