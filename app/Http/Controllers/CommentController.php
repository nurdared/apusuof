<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Thread;
use App\Club;
use App\Event;
use App\Notifications\RepliedToThread;

class CommentController extends Controller
{
    public function addThreadComment(Request $request, Thread $thread)
    {
        $this->validate($request,[
            'body'=>'required'
        ]);
       $comment=new Comment();
       $comment->body=$request->body;
       $comment->user_id=auth()->user()->id;

       $thread->comments()->save($comment);
       $thread->user->notify(new RepliedToThread($thread, $comment));
        return back()->with('success', 'comment created');
    }

    public function addClubComment(Request $request, Club $club)
    {
        $this->validate($request,[
            'body'=>'required'
        ]);
       $comment=new Comment();
       $comment->body=$request->body;
       $comment->user_id=auth()->user()->id;

       $club->comments()->save($comment);
        return back()->with('success', 'comment created');
    }

    public function addEventComment(Request $request, Event $event)
    {
        $this->validate($request,[
            'body'=>'required'
        ]);
       $comment=new Comment();
       $comment->body=$request->body;
       $comment->user_id=auth()->user()->id;

       $event->comments()->save($comment);
        return back()->with('success', 'Comment created');
    }

    public function addReplyComment(Request $request, Comment $comment)
    {
        $this->validate($request,[
            'body'=>'required'
        ]);
        $reply=new Comment();
        $reply->body=$request->body;
        $reply->user_id=auth()->user()->id;
 
        $comment->comments()->save($reply);
        return back()->withMessage('Comment Replied');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->validate($request,[
            'body'=>'required'
        ]);
        $comment->update($request->all());
        return back()->with('success', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment Deleted');
    }
}
