<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Club;
use DB;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]); //index and show is methods
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Category::where('category_name', 'Country Societies')->get();
        //$categories = DB::select('SELECT * from tb_category');
        $categories = Category::orderBy('category_name')->where('deleted_at', null)->paginate(6);
        return view('pages.categories.index')->with('categories', $categories);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $clubs = Club::orderBy('club_name')->where('category_id', $id)->where('deleted_at', null)->paginate(6);

        $data = array(
            'category' => $category,
            'clubs' => $clubs
        ); 

        return view('pages.categories.show_category')->with($data);
    }
}
