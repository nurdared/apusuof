<?php

namespace App\Http\Controllers\Admin;

use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreThreadsRequest;
use App\Http\Requests\Admin\UpdateThreadsRequest;

class ThreadsController extends Controller
{
    /**
     * Display a listing of Thread.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('thread_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('thread_delete')) {
                return abort(401);
            }
            $threads = Thread::onlyTrashed()->get();
        } else {
            $threads = Thread::all();
        }

        return view('admin.threads.index', compact('threads'));
    }

    /**
     * Display Thread.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('thread_view')) {
            return abort(401);
        }
        $thread = Thread::findOrFail($id);

        return view('admin.threads.show', compact('thread'));
    }


    /**
     * Remove Thread from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('thread_delete')) {
            return abort(401);
        }
        $thread = Thread::findOrFail($id);
        $thread->delete();

        return redirect()->route('admin.threads.index');
    }

    /**
     * Delete all selected Thread at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('thread_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Thread::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Thread from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('thread_delete')) {
            return abort(401);
        }
        $thread = Thread::onlyTrashed()->findOrFail($id);
        $thread->restore();

        return redirect()->route('admin.threads.index');
    }

    /**
     * Permanently delete Thread from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('thread_delete')) {
            return abort(401);
        }
        $thread = Thread::onlyTrashed()->findOrFail($id);
        $thread->forceDelete();

        return redirect()->route('admin.threads.index');
    }
}
