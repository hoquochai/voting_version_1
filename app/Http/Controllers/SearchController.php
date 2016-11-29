<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function find(Request $request)
    {
        return Poll::search($request->get('q'))->get();
    }
}
