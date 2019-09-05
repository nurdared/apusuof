<?php

use App\Http\Controllers\PagesController;
use App\Jobs\SendEmailJob;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('sendEmail', function () {
    $job = (new SendEmailJob())->delay(5);

    dispatch($job);
    return 'Email Sent';
});

Route::get('/', 'PagesController@index');

//Clubs & Societies
Route::resource('/clubs-soc', 'CategoriesController');
Route::resource('/clubs-soc/club', 'ClubsController');

//Events
Route::get('/events', 'EventsController@index');
// Route::get('/events/{event}', 'EventsController@event');
Route::get('invitations/{invitation_id}/{action}', 'AcceptController@accept')->name('invitations.send');
Route::get('volunteer/{event}', 'VolunteersController@send')->name('volunteer.send');
Route::get('/events/search/', 'EventsController@search');

//Volunteering
Route::get('/volunteering', 'VolunteersController@index');
Route::get('/volunteering/{volunteering}', 'VolunteersController@show')->name('volunteer.show');
Route::get('/volunteering/search/', 'VolunteersController@search');


Auth::routes();


//User Profile
    Route::get('/profile', 'ProfileController@profile');
    Route::post('profile', 'ProfileController@update_avatar');
    Route::get('/profile/edit', 'ProfileController@edit')->name('editprofile');
    Route::post('/profile/edit', 'ProfileController@update');
    Route::get('/student_profile/{user}', 'ProfileController@usersprofile');


//Forum 
    Route::get('/forum', function () {
        $threads = App\Thread::where('deleted_at', null)->orderBy('updated_at', 'desc')->paginate(4);
        return view('pages.forums.welcome', compact('threads'));
    });
    Route::resource('/forum/thread', 'ThreadController');

    //Comment
    Route::resource('comment','CommentController',['only'=>['update','destroy']]);
    Route::post('comment/create/thread/{thread}','CommentController@addThreadComment')->name('threadcomment.store');
    Route::post('comment/create/club/{club}','CommentController@addClubComment')->name('clubcomment.store');
    Route::post('comment/create/event/{event}','CommentController@addEventComment')->name('eventcomment.store');
    //reply
    Route::post('reply/create/{comment}','CommentController@addReplyComment')->name('replycomment.store');
    //Mark as a Solution
    Route::post('/thread/mark-as-solution','ThreadController@markAsSolution')->name('markAsSolution');
    //Like
    Route::post('comment/like','LikeController@toggleLike')->name('toggleLike');
    //Notification
    Route::get('/test',function(){
        $notifications = auth()->user()->unreadNotifications;
        foreach ($notifications as $notification) {
            dd($notification->data['user']['name']);
        }
    });
    Route::get('/markAsRead',function(){
        auth()->user()->unreadNotifications->markAsRead();
    });