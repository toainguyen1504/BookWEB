<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Book\StoreRequest; 

use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Show all application users.
     *
     * @return \Illuminate\Http\Response 
     */

    public function index()
    {

        $data['books'] = DB::table('books')->orderBy('created_at', 'desc')->paginate(6);
        if ($key = request()->key) {
            $data['books'] = DB::table('books')->where('name', 'like', "%$key%")->orderBy('created_at', 'desc')->paginate(6);
        }
        // dd($data);   
        $data['category'] = DB::table('categories')->orderBy('created_at', 'desc')->get();
            // dd($data);  
        return view('admin.book.index', ['data' => $data]);
    }
    /**
     * Show all application users. 
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data = DB::table('categories')->orderBy('created_at', 'desc')->get();
        // dd($data);
        return view('admin.book.create', ['category' => $data]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->old('name');
        $data = $request->old('description');
        $data = $request->old('author');
        $data = $request->old('category_id');

        $file = $request->image;
        if (isset($file)) {
            $ext = $request->image->extension();
            $file_name = time() . '-cover.' . $ext;
            $file->move(public_path('uploads/covers'), $file_name);

            $data = $request->except('_token');
            $data['created_at'] = new \DateTime();
            $data['image'] = $file_name;

            DB::table('books')->insert($data);
        }

        return redirect()->route('admin.book.index')->with('success', 'book insert successfully');
    }

    public function edit($id)
    {
        $data = DB::table('books')->where('id', $id)->first();
        // dd($data);
        //Lay name cua category
        $category_data = DB::table('categories')->get();
        // $category_first = DB::table('categories')->where('id', $data->category_id)->first();
        // dd($category_first);
        return view('admin.book.edit', ['book' => $data], ['category' => $category_data]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        // dd($data);
        $book_data = DB::table('books')->where('id', $id)->first();
        //  dd($book_data);
        $file = $request->image;
        // dd($file);
        if (isset($file)) {
            // dd('co');
            $ext = $request->image->extension();
            $file_name = time() . '-cover.' . $ext;
            $file->move(public_path('uploads/covers'), $file_name);
            $data['image'] = $file_name;
            $data['updated_at'] = new \DateTime();
            $path_image_old = public_path() . "\uploads/covers/" . $book_data->image;
            // dd($path_image_old);
            if (file_exists($path_image_old)) {
                unlink($path_image_old);
            }
        }
        DB::table('books')->where('id', $id)->update($data);
        return redirect()->route('admin.book.index')->with('success', 'book update successfully');
    }


    public function delete($id)
    {
        // dd($id);
        $chapter_data = DB::table('chapters')->where('book_id', $id)->get();
        // delete images and chapters
        foreach ($chapter_data as $chap) {
            $files = DB::table('images')->where('chapter_id', $chap->id)->get();
            // dd($files);
            foreach ($files as $file) {
                $path = public_path() . "\uploads/chapters/" . $file->image;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            DB::table('images')->where('chapter_id', $chap->id)->delete();
            DB::table('chapters')->where('id', $chap->id)->delete();
        }
        //delete book
        $book_data = DB::table('books')->where('id', $id)->first();
        // dd($book_data);
        $path_cover = public_path() . "\uploads/covers/" . $book_data->image;
        if (file_exists($path_cover)) {
            unlink($path_cover);
        }
        // dd($id);
        DB::table('books')->where('id', $id)->delete();
        return redirect()->route('admin.book.index');
    }
}
