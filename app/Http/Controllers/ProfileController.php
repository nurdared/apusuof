<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Image;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;
use App\Thread;
use App\Comment;
use App\Event;
use App\Invitation;
use App\Volunteer;

class ProfileController extends Controller
{
	public function __construct()
    {
		$this->middleware('auth'); 
		
	}
	
    public function profile(){
		$user = auth()->user();
		$threads=Thread::where('user_id', $user->id)->latest()->get() ?? [];
		$comments=Comment::where('user_id', $user->id)->where('commentable_type','App\Thread')->latest()->get() ?? [];
		$events= Invitation::where('email', $user->email)->whereNotNull('accepted_at')->get()?? [];
		$volunteers=$user->volunteers->where('approved_at') ?? [];
        return view('pages.profiles.profile', compact('threads', 'comments', 'user', 'events', 'volunteers'));
	}
	
	public function usersprofile($id)
    {
		$user = User::find($id); 
		$threads=Thread::where('user_id',$user->id)->latest()->get();
		$comments=Comment::where('user_id',$user->id)->where('commentable_type','App\Thread')->get();
        return view('pages.profiles.profile', compact('threads', 'comments', 'user', 'events'));
    }

    public function update_avatar(Request $request){

    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->save( public_path('/storage/images/avatars/' . $filename ) );

    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return view('pages.profiles.profile', array('user' => Auth::user()) );

	}

	protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'contact' => 'numeric|digits_between:7,15',
        ]);
	}

	public function edit(){
		return view('pages.profiles.edit_profile', array('user' => Auth::user()) );
	}

	public function update(Request $request)
	{
		$data = $this->validate($request, [
			'email'   => 'required|email',
			'contact' => 'required',
		]);
	
		auth()->user()->update($data);
	
		return redirect('/profile')->with('success', 'Profile Details Has Been Updated Successfully');
	}
}
