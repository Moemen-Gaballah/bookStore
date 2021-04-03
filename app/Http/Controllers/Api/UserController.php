<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        $users = User::latest()->paginate('15');
        return response()->json(['data' =>$users, 'message' => 200]);
    }


    public function search(){
        if($search = \Request::get('q')){
            $users = User::where(function($query) use ($search){
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE',"%$search%")
                ->orWhere('role', 'LIKE',"%$search%");
            })->paginate(20);
        }else{
            // $users = User::latest()->paginate(5);
            return  $this->index();
            // dd($users);
        }
        // return $users;
        return response()->json(['data' =>$users, 'message' => 200]);
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
            'name' => 'required|string|min:3|max:191',
            'email' => 'required|string|email|max:191|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $request['password'] = Hash::make($request->password);

        return User::create($request->all());
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
        $user = User::FindOrFail($id);
        // validation
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6',

        ]);
        if($request['password']){
            $request['password'] = Hash::make($request['password']);
        }

        // ToDo Validation Img
        // ToDo Validation && Choose anther way to upload file without convert to char
        $currentPhoto = $user->profileImg;
        if($request->profileImg != $currentPhoto) {
            $name = time().'.' . explode('/', explode(':', substr($request->profileImg, 0 , strpos($request->profileImg, ';')))[1])[1];
            \Image::make($request->profileImg)->save(public_path('img/profile/').$name);
            $request['profileImg'] = $name;

            if($currentPhoto != 'profile.png' && $currentPhoto){
                $oldUserPhoto = public_path('img/profile/').$currentPhoto;
                if(file_exists($oldUserPhoto)){
                    unlink($oldUserPhoto);
                }
            }
        }

        $user->update($request->all());
        return ['message' => 'Update the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::FindOrFail($id);
        $user->delete();
        return response()->json(['data' =>'done deleteUser', 'message' => 200]);
    }
}
