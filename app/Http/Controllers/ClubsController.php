<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Club;
use App\Update;

class ClubsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //index and show is methods
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$categories_name = Category::pluck('category_name','id');   
        $club = Club::find($id); 
        $updates = Update::orderBy('updated_at', 'asc')->where('deleted_at', null)->where('club_id', $id)->paginate(3);

        $data = array(
            //'categories_name' => $categories_name,
            'club' => $club,
            'updates' => $updates,
        );
        return view('pages.clubs.show_club')->with($data);
    }

}
