<?php

namespace App\Http\Controllers;

use App\Volunteer;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Event;



class VolunteersController extends Controller
{
    public function index()
    {
        
        $events= Event::orderBy('event_date', 'asc')->whereNotNull('information')->where('deleted_at', null)->get()?? [];
        //$events = Invitation::where('email', auth()->user()->email)->get() ?? [];?? [];
        return view('pages.upcoming.volunteerings', compact('events'));
    }

    public function show($id)
    {
        $event=Event::find($id);
        
        if ($event->volunteers->where('user_id', auth()->user()->id)->where('approved_at')->first() ?? [] != null) {
            return view('pages.upcoming.showvolunteering', compact('event'));
            # code...
        } else {
            return back()->with('error', 'Anauthorized Access!');
        }
        

    }

    public function search(Request $request)
    {
        
        $search = $request->get('search');
        $events = Event::query()->where('name', 'LIKE', '%' .$search. '%')->get();
        return view('pages.upcoming.volunteerings', compact('events'));
        
    }


    public function send($id)
    {

       $volunteer=new Volunteer();
       $volunteer->event_id=$id;
       $volunteer->user_id=auth()->user()->id;
       $volunteer->save();
       
       $volunteer->update(['sent_at' => Carbon::now()->toDateTimeString()]);
  
        return back()->with('success', 'Volunteer Request Has been Sent!');
    }


}
