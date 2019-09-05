<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public function index() 
    {
        $events = []; 

        foreach (\App\Event::all() as $event) { 
           $crudFieldValue = $event->getOriginal('event_date'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $event->name; 
           $prefix         = ''; 
           $suffix         = ''; 
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.events.edit', $event->id)
           ]; 
        } 


       return view('admin.calendar' , compact('events')); 
    }

}
