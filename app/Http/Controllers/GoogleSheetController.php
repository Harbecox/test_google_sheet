<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class GoogleSheetController extends Controller
{
    function index($count = -1)
    {
        $records = Helper::getGoogleSheet()->get();
        $page = request()->get('page', 1);
        $perPage = $count > 0 ? $count : 20;
        $items = $records->slice(($page - 1) * $perPage, $perPage)->values();

        $records = new LengthAwarePaginator(
            $items,
            $records->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        return view('fetch', compact('records'));
    }
}
