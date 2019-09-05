<?php

namespace App\Http\Controllers\Admin;

use App\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClubsRequest;
use App\Http\Requests\Admin\UpdateClubsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class ClubsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Club.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('club_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('club_delete')) {
                return abort(401);
            }
            $clubs = Club::onlyTrashed()->get();
        } else {
            $clubs = Club::all();
        }

        return view('admin.clubs.index', compact('clubs'));
    }

    /**
     * Show the form for creating new Club.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('club_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $categories = \App\Category::get()->pluck('category_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.clubs.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created Club in storage.
     *
     * @param  \App\Http\Requests\StoreClubsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClubsRequest $request)
    {
        if (! Gate::allows('club_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $club = Club::create($request->all());



        return redirect()->route('admin.clubs.index');
    }


    /**
     * Show the form for editing Club.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('club_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $categories = \App\Category::get()->pluck('category_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $club = Club::findOrFail($id);

        return view('admin.clubs.edit', compact('club', 'users', 'categories'));
    }

    /**
     * Update Club in storage.
     *
     * @param  \App\Http\Requests\UpdateClubsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClubsRequest $request, $id)
    {
        if (! Gate::allows('club_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $club = Club::findOrFail($id);
        $club->update($request->all());



        return redirect()->route('admin.clubs.index');
    }


    /**
     * Display Club.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('club_view')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $categories = \App\Category::get()->pluck('category_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$updates = \App\Update::where('club_id', $id)->get();

        $club = Club::findOrFail($id);

        return view('admin.clubs.show', compact('club', 'updates'));
    }


    /**
     * Remove Club from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('club_delete')) {
            return abort(401);
        }
        $club = Club::findOrFail($id);
        $club->delete();

        return redirect()->route('admin.clubs.index');
    }

    /**
     * Delete all selected Club at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('club_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Club::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Club from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('club_delete')) {
            return abort(401);
        }
        $club = Club::onlyTrashed()->findOrFail($id);
        $club->restore();

        return redirect()->route('admin.clubs.index');
    }

    /**
     * Permanently delete Club from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('club_delete')) {
            return abort(401);
        }
        $club = Club::onlyTrashed()->findOrFail($id);
        $club->forceDelete();

        return redirect()->route('admin.clubs.index');
    }
}
