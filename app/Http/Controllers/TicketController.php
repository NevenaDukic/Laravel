<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Http\Resources\TicketResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function index()
    {
      //  return Auth::user()->id;

      if (Auth::user()->email=="admin@gmail.com") {
        $tickets = Ticket::all();
    
        return  response()->json(['response' => 'Tickets...', 'tickets'=>TicketResource::collection($tickets)]);
        } 



        $tickets = Ticket::get()->where('user_id', Auth::user()->id);


        if (sizeof($tickets) == 0) {
            return response()->json(['response' => "You don't have any ticket yet!"]);
        }


       

        return response()->json(['response' => 'Your tickets...', 'your_tickets'=>TicketResource::collection($tickets)]);
    

      
      
   

    }

    public function store(Request $request)
    {
       
        $validator = Validator::make(
            $request->all(),
            [
                'seats' => 'required|int|max:70',
                'performance_id' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

      
        $ticket = Ticket::create([
            'seats' => $request->seats,
            'user_id' => Auth::id(),
            'performance_id' => $request->performance_id
        ]);

        
        return response()->json(['response' => 'You have successfully booked a ticket for performance!', 'booked_ticket'=>new TicketResource($ticket)]);
    }

    public function destroy($ticketId)
    {
        $ticket = Ticket::find($ticketId);
        if($ticket==null){
            return response()->json(['response' => 'Ticket does not exsist!']);
        }
        if($ticket->user_id != Auth::user()->id) {
            return response()->json(['response' => "This ticket isn't yours! You cannot delete it!", 'ticket' => new TicketResource($ticket)]);
        } else{  
            $ticket->delete();
            return response()->json(['response' => 'Ticket has been successfully deleted!', 'deleted_ticket' => new TicketResource($ticket)]);
        }
    }
}
