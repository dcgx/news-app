<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = new \App\NewsApi();
        $data = $news->fetchAllNews();
        return response()->json($data);
    }
}
