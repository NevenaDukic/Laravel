<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( Auth::user()->email!="admin@gmail.com") {
            return response()->json(['response' => "You cannot see all users because you are not an admin!"]);
        } 

        $users = User::all();
       // return $users;
        return  response()->json(['response' => 'Users...', 'users'=>UserResource::collection($users)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //vraca 1
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->id != Auth::user()->id) {
            return response()->json(['response' => "You can't update account which does not belong to you!"]);
        } else
        

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:30',
                'email' => 'required|string|max:30',
               
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user->name = $request->name;
        $user->email = $request->email;
       
       
        $user->save();
        return response()->json(['response' => 'Account has been successfully updated!','updated_user' => new UserResource($user)]);

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $user = User::find($user_id);
        if($user==null){
            return response()->json(['response' => 'User does not exsist!']);
        }
        
   
        

        if (Auth::user()->email == 'admin@gmail.com' || Auth::id()==$user->id) {
            
            auth()->user()->tokens()->delete();
            $user->delete();
            return response()->json(['response' => 'User has been successfully deleted!', 'deleted_user' => new UserResource($user)]);
        } else {
            return response()->json(['response' => "You cannot delete other users! You can only delete yourself!"]);
        }
    }
}
