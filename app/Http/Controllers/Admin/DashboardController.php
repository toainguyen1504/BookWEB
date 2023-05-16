<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index () {

        $data['books'] = DB::table('books')->orderBy('created_at', 'desc')->get();
        $data['category'] = DB::table('categories')->orderBy('created_at', 'desc')->get();
        // dd( $data );
        return view('admin.dashboard.index', ['data' => $data]);
    }
}
