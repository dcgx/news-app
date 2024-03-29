<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\NewsApi;

class NewsController extends Controller
{
    public function index()
    {
        $newsApi = new NewsApi();
        $data = $newsApi->fetchAllNews();
        return response()->json($data);
    }
}
