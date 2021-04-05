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
        // $books = Book::with('category')->get();
        $books = Book::with('category')->latest()->paginate('10');
        return response()->json(['data' => $books, 'message' => 200]);
    }

    public function search(){
        if($search = \Request::get('q')){
            $books = Book::with('category')->where(function($query) use ($search){
                $query->where('title', 'LIKE', "%$search%")
                ->orWhere('author', 'LIKE',"%$search%")
                ->orWhereHas('category', function ($query) use ($search){
                    $query->where('title','LIKE',"%$search%");
                });

            })->paginate(20);
        }else{
            // $users = User::latest()->paginate(5);
            return  $this->index();
            // dd($users);
        }
        // return $users;
        return response()->json(['data' =>$books, 'message' => 200]);
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
             'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->image){
            $filename = time() .'.'. $request->image->getClientOriginalExtension();
            \Image::make($request->image)
            ->resize(300, null, function ($constraint){
                $constraint->aspectRatio();
            })

            ->save(public_path('img/book/' . $filename));

            $request['image'] = $filename;

        }// end of if request->image

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
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
        ]);

        $currentPhoto = $book->image;
        if($request->image && !empty($request->image)){
            $filename = time() .'.'. $request->image->getClientOriginalExtension();
            \Image::make($request->image)
            ->resize(300, null, function ($constraint){
                $constraint->aspectRatio();
            })

            ->save(public_path('img/book/' . $filename));

            $request = new Request($request->all());
            $request->merge([ 'image' => $filename ]);

            if($currentPhoto){
                $oldUserPhoto = public_path('img/book/'.$currentPhoto);
                if(file_exists($oldUserPhoto)){
                    unlink($oldUserPhoto);
                }
            }

        }// end of if request->image


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
