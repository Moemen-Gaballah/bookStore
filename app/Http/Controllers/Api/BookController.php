<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('category')->get();
        return response()->json(['data' => $books, 'message' => 200]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title' => 'required|string|min:3|max:191',
            'author' => 'required|string|min:3|max:191',
            'status' => 'required|integer',
            'stock' => 'required|integer|numeric|min:1|max:1000',
            'description' => 'required|string|min:3|max:1000',
            'category_id' => 'required|integer',
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
        ]);

        return Book::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $book = Book::FindOrFail($id);
        $this->validate($request, [
            'title' => 'required|string|min:3|max:191',
            'author' => 'required|string|min:3|max:191',
            'status' => 'required|integer',
            'stock' => 'required|integer|numeric|min:1|max:1000',
            'description' => 'required|string|min:3|max:1000',
            'category_id' => 'required|integer',
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
        ]);

        $book->update($request->all());
        return ['message' => 'Done Update Book'];
        // return response()->json(['data' => $books, 'message' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::FindOrFail($id);
        $book->delete();

        return ['message', 'Done Delete Book.'];
    }
}
