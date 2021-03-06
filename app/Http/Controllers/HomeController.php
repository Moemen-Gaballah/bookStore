<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('status', 1)->has('books')->with(['books' => function ($query) {
            $query->where('status', 1)->take(12);
        }])->get();

        return response()->json(['data' =>$categories, 'message' => 200]);
    }

    public function getCategories()
    {
        $categories = Category::where('status', 1)->whereHas('books', function ($query) {
            $query->where('status', '1');
        })->get();
        return response()->json(['data' =>$categories, 'message' => 200]);
    }

    public function getBookForCart(Request $request)
    {
        $books = Book::whereIn('id',array_keys($request->all()))->where('status', 1)->get();
        foreach($books as $book){
            $book->count = $request->all()[$book->id];
        }
        return response()->json(['data' =>$books, 'message' => 200]);
    }

    public function getAllBooks()
    {
        // $books = Book::where('status', 1)->paginate('16');
        // return response()->json(['data' =>$books, 'message' => 200]);

    
        if($search = \Request::get('q')){
            if($search == 'lessPrice'){
                $books = Book::where('status', 1)->orderBy('price', 'asc')->paginate('12');
            }elseif($search == 'highPrice'){
                $books = Book::where('status', 1)->orderBy('price', 'desc')->paginate('12');
            }else{
                $books = Book::where('status', 1)->latest()->paginate('12');
            }
        }else {
            $books = Book::where('status', 1)->latest()->paginate('12');
        }

        return response()->json(['data' => $books, 'message' => 200]);
    }

}
