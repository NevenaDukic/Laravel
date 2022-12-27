<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theatre;
use App\Http\Resources\TheatreResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TheatreCollection;

class TheatreController extends Controller
{
    public function index()
    {
        $theatres = Theatre::all();
    
        return new TheatreCollection($theatres);
    }


    public function store(Request $request)
    {
       
        
        if ( Auth::user()->email!="admin@gmail.com") {
            return response()->json(['response' => "You cannot enter a new theatre because you are not an admin!"]);
        } 
        
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255'
            ]
        );
       

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        
        $theatre = Theatre::create([
            'name' => $request->name
        ]);
        
        
        return response()->json(['response' => 'You have successfully created new Theatre!','created_theatre'=> new TheatreResource($theatre)]);
    
    }

    public function update(Request $request,Theatre $theatre)
    {
        
        if ( Auth::user()->email!="admin@gmail.com") {
            return response()->json(['response' => "You cannot update a theatre because you are not an admin!"]);
        } 

       
        
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255'
                
                
            ]
        );
       

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        
        $theatre->name = $request->name;
      
        $theatre->save();
        
        
        return response()->json(['response' => 'You have successfully changed theatre!', 'changed_theatre'=>new TheatreResource($theatre)]);
    
    }
    public function destroy($theatreid)
    {
        if ( Auth::user()->email!="admin@gmail.com") {
            return response()->json(['response' => "You cannot delete the theatre because you are not an admin!"]);
        } 
      
        $t = Theatre::find($theatreid);
        if($t==null){
            return response()->json(['response' => 'Theatre does not exsist!']);
        }
        //$t = Theatre::find($theatreid);
        if ($t->delete()) {
            return response()->json(['response' => 'Theatre has been successfully deleted!', 'deleted_theatre' => new TheatreResource($t)]);
        } else {
            return response()->json(['response' => 'Deleting theatre has failed!', 'theatre' => new TheatreResource($t)]);
        }
    }

    
}
