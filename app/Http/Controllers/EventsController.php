<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Invitation;
use App\Event;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $events= Event::orderBy('event_date', 'asc')->where('deleted_at', null)->get()?? [];
        //$events = Invitation::where('email', auth()->user()->email)->get() ?? [];?? [];
        return view('pages.upcoming.events', compact('events'));
    }

    
    public function show($id)
    {
        //
    }

    public function search(Request $request)
    {
        
        $search = $request->get('search');
        $events = Event::query()->where('name', 'LIKE', '%' .$search. '%')->get();
        return view('pages.upcoming.events', compact('events'));
        
    }



}
