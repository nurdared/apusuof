<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentsRequest;
use App\Http\Requests\Admin\UpdateCommentsRequest;

class EventCommentsController extends Controller
{
    /**
     * Display a listing of Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('comment_access')) {
            return abort(401);
        }


                $comments = Comment::where('commentable_type', 'App\Event')->get() ?? [];

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for editing Comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('comment_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $comment = Comment::findOrFail($id);

        return view('admin.comments.edit', compact('comment', 'users'));
    }

    /**
     * Update Comment in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentsRequest $request, $id)
    {
        if (! Gate::allows('comment_edit')) {
            return abort(401);
        }
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());



        return redirect()->route('admin.eventcomments.index');
    }


    /**
     * Display Comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('comment_view')) {
            return abort(401);
        }
        $comment = Comment::findOrFail($id);

        return view('admin.comments.show', compact('comment'));
    }


    /**
     * Remove Comment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('comment_delete')) {
            return abort(401);
        }
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.eventcomments.index');
    }

    /**
     * Delete all selected Comment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('comment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Comment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}

