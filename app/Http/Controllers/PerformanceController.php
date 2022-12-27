<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Performance;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PerformanceResource;
use App\Http\Resources\PerformanceCollection;

class PerformanceController extends Controller
{
    public function index()
    {
       

       $performances = Performance::all();
    
      
       return new PerformanceCollection($performances);
    }


    public function store(Request $request)
    {
       
        
        if ( Auth::user()->email!="admin@gmail.com") {
            return response()->json(['response' => "You cannot enter a new performance because you are not an admin!"]);
        } 
        
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'genre' => 'required',
                'number_of_roles' => 'required|int|max:40',
                'theatre_id'=>'required'
            ]
        );
       

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        
        $performance = Performance::create([
            'name' => $request->name,
            'genre' => $request->genre,
            'theatre_id'=> $request->theatre_id,
            'number_of_roles' => $request->number_of_roles
            
        ]);
        
        
        return response()->json(['response' => 'You have successfully created new Performance!', 'created_performance'=>new PerformanceResource($performance)]);
    
    }

    public function update(Request $request,Performance $performance)
    {
        if ( Auth::user()->email!="admin@gmail.com") {
            return response()->json(['response' => "You cannot update a performance because you are not an admin!"]);
        } 
        
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'genre' => 'required|string',
                'number_of_roles' => 'required|int',
                'theatre_id'=>'required'
            ]
        );
       

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        
        $performance->name = $request->name;
        $performance->genre = $request->genre;
        $performance->number_of_roles = $request->number_of_roles;
       
        $performance->save();
        
        
        return response()->json(['response' => 'You have successfully changed performance!', 'changed_performance'=>new PerformanceResource($performance)]);
    
    }
    public function destroy($performanceid)
    {
        if ( Auth::user()->email!="admin@gmail.com") {
            return response()->json(['response' => "You cannot delete the performance because you are not an admin!"]);
        } 
      

        $p = Performance::find($performanceid);
        if($p==null){
            return response()->json(['response' => 'Performance does not exsist!']);
        }
        if ($p->delete()) {
            return response()->json(['response' => 'Performance has been successfully deleted!', 'deleted_performance' => new PerformanceResource($p)]);
        } else {
            return response()->json(['response' => 'Deleting performance has failed!', 'performance' => new PerformanceResource($p)]);
        }
    }
}
