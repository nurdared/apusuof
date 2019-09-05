<?php

namespace App\Http\Controllers\Admin;

use App\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUpdatesRequest;
use App\Http\Requests\Admin\UpdateUpdatesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class UpdatesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Update.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('update_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('update_delete')) {
                return abort(401);
            }
            $updates = Update::onlyTrashed()->get();
        } else {
            $updates = Update::all();
        }

        return view('admin.updates.index', compact('updates'));
    }

    /**
     * Show the form for creating new Update.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('update_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $clubs = \App\Club::get()->pluck('club_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.updates.create', compact('users', 'clubs'));
    }

    /**
     * Store a newly created Update in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatesRequest $request)
    {
        if (! Gate::allows('update_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $update = Update::create($request->all());



        return redirect()->route('admin.updates.index');
    }


    /**
     * Show the form for editing Update.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('update_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $clubs = \App\Club::get()->pluck('club_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $update = Update::findOrFail($id);

        return view('admin.updates.edit', compact('update', 'users', 'clubs'));
    }

    /**
     * Update Update in storage.
     *
     * @param  \App\Http\Requests\UpdateUpdatesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUpdatesRequest $request, $id)
    {
        if (! Gate::allows('update_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $update = Update::findOrFail($id);
        $update->update($request->all());



        return redirect()->route('admin.updates.index');
    }


    /**
     * Display Update.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('update_view')) {
            return abort(401);
        }
        $update = Update::findOrFail($id);

        return view('admin.updates.show', compact('update'));
    }


    /**
     * Remove Update from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('update_delete')) {
            return abort(401);
        }
        $update = Update::findOrFail($id);
        $update->delete();

        return redirect()->route('admin.updates.index');
    }

    /**
     * Delete all selected Update at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('update_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Update::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Update from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('update_delete')) {
            return abort(401);
        }
        $update = Update::onlyTrashed()->findOrFail($id);
        $update->restore();

        return redirect()->route('admin.updates.index');
    }

    /**
     * Permanently delete Update from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('update_delete')) {
            return abort(401);
        }
        $update = Update::onlyTrashed()->findOrFail($id);
        $update->forceDelete();

        return redirect()->route('admin.updates.index');
    }
}
