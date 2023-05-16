<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    { 
     
        $data['categories'] = DB::table('categories')->orderBy('created_at', 'desc')->get();
        $data['books'] = DB::table('books')->orderBy('created_at', 'desc')->paginate(12);

        if ($key = request()->key) {
            $data = DB::table('books')->where('name', 'like', "%$key%")->orderBy('created_at', 'desc')->paginate(12);
           
        }

        $bookList = DB::table('books')->orderBy('created_at', 'desc')-> get();
        $collection = collect($bookList);

        if(count($bookList) < 10) {
            $data['newBook'] = $bookList;
        } else {
            $data['newBook'] = $collection->take(10)->all();
        }
    
    return view('client.pages.index', ['data' => $data]);
}

    public function userIndex($id)
    {
        $data['user_id'] = $id;

        $data['categories'] = DB::table('categories')->orderBy('created_at', 'desc')->get();
        $data['books'] = DB::table('books')->orderBy('created_at', 'desc')->paginate(12);

        if ($key = request()->key) {
            $data = DB::table('books')->where('name', 'like', "%$key%")->orderBy('created_at', 'desc')->paginate(12);
           
        }

        $bookList = DB::table('books')->orderBy('created_at', 'desc')-> get();
        $collection = collect($bookList);

        if(count($bookList) < 10) {
            $data['newBook'] = $bookList;
        } else {
            $data['newBook'] = $collection->take(10)->all();
        }
        // dd($data['newBook']);
        //kiem tra dang nhap
        $data['user'] = DB::table('users')->where('id', $id)->first();

        return view('client.pages.index', ['data' => $data]);
    }

    public function category()
    {
        $data = DB::table('books')->orderBy('created_at', 'desc')->get();
        $category = DB::table('categories')->orderBy('created_at', 'desc')->get();
        // dd($data);
        return view('client.pages.category', ['category' => $category], ['book' => $data]);
        // return  redirect()->route('category', ['book' => $data]);
    }
    public function profile($id)
    { 
        $data['categories'] = DB::table('categories')->orderBy('created_at', 'desc')->get();
        $data['user'] = DB::table('users')->where('id', $id)->first();
        return view('client.pages.profile', ['data' => $data]);
    }
 
}
