<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate('10');

        return response()->json(['data' =>$categories, 'message' => 200]);
    }


        public function getAll()
        {
            $categories = Category::all();
            return response()->json(['data' => $categories, 'message' => 200]);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|min:3|max:191|unique:categories,title'
        ]);

        return Category::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::FindOrFail($id);
        if($search = \Request::get('q')){
            if($search == 'lessPrice'){
                $books = Book::where('category_id', $id)->where('status', 1)->orderBy('price', 'asc')->paginate('20');
            }elseif($search == 'highPrice'){
                $books = Book::where('category_id', $id)->where('status', 1)->orderBy('price', 'desc')->paginate('20');
            }else{
                $books = Book::where('category_id', $id)->where('status', 1)->latest()->paginate('20');
            }
        }else {
            $books = Book::where('category_id', $id)->where('status', 1)->latest()->paginate('20');
        }

        // $category = Category::FindOrFail($id)->with('books')->whereHas('books', function ($query){
        //     $query->where('status', 1);
        // })->latest()->paginate('20');

        return response()->json(['data' => $books, 'categoryName' => $category->title, 'message' => 200]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::FindOrFail($id);
        // validation
        $this->validate($request, [
            'title' => 'required|string|max:191|unique:categories,title,'.$category->id
        ]);

        $category->update($request->all());
        return ['message' => 'successful update category'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::FindOrFail($id);
        $category->delete();
        return response()->json(['data' =>'done delete category', 'message' => 200]);
    }
}
