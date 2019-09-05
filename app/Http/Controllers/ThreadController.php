<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\ThreadFilters;

class ThreadController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ThreadFilters $filters)
    {
        $threads=Thread::filter($filters)->orderBy('updated_at', 'desc')->where('deleted_at', null)->paginate(4);
        return view('pages.forums.thread.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.forums.thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'subject' => 'required|min:5',
            'tags'    => 'required',
            'thread'  => 'required|min:10',
        ]);

        //store
        $thread=auth()->user()->threads()->create($request->all());
        $thread->tags()->attach($request->tags);
        
        
        //redirect
        return redirect('forum/thread')->with('success', 'Thread Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return view('pages.forums.thread.single', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //Check for correct user
        if ((auth()->user()->id !== $thread->user_id) && (auth()->user()->type !='admin')) {
            return redirect('/forum/thread')->with('error', 'Unauthorized Page');
        }
        return view('pages.forums.thread.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        // $this->authorize('update', $thread);
        //validate
        $this->validate($request, [
            'subject' => 'required|min:10',
            'thread'  => 'required|min:20'
        ]);
        $thread->update($request->all());
        $thread->tags()->attach($request->tags);
        return redirect()->route('thread.show', $thread->id)->with('success' ,'Thread Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        // $this->authorize('update', $thread);
        $thread->delete();
        return redirect()->route('thread.index')->with('success','Thread Deleted!');
    }

    public function markAsSolution()
    {
        $solutionId = Input::get('solutionId');
        $threadId = Input::get('threadId');
        $thread = Thread::find($threadId);
        $thread->solution = $solutionId;
        if ($thread->save()) {
            return back()->withMessage('Marked as solution');
        }

    }
}
