<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends Controller
{

    public function index() {
        $all = News::all();
    }
}
