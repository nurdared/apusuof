<?php

namespace App\Http\Controllers\Admin;

use App\Volunteer;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVolunteersRequest;
use App\Http\Requests\Admin\UpdateVolunteersRequest;
use App\Notifications\VolunteerNotification;


class VolunteersController extends Controller
{
    /**
     * Display a listing of Volunteer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('volunteer_access')) {
            return abort(401);
        }


                $volunteers = Volunteer::all();

        return view('admin.volunteers.index', compact('volunteers'));
    }

    /**
     * Show the form for creating new Volunteer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('volunteer_create')) {
            return abort(401);
        }
        
        $events = \App\Event::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.volunteers.create', compact('events', 'users'));
    }

    /**
     * Store a newly created Volunteer in storage.
     *
     * @param  \App\Http\Requests\StoreVolunteersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVolunteersRequest $request)
    {
        if (! Gate::allows('volunteer_create')) {
            return abort(401);
        }
        $volunteer = Volunteer::create($request->all());



        return redirect()->route('admin.volunteers.index');
    }


    /**
     * Display Volunteer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('volunteer_view')) {
            return abort(401);
        }
        $volunteer = Volunteer::findOrFail($id);

        return view('admin.volunteers.show', compact('volunteer'));
    }


    /**
     * Remove Volunteer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('volunteer_delete')) {
            return abort(401);
        }
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->delete();

        return redirect()->route('admin.volunteers.index');
    }

    /**
     * Delete all selected Volunteer at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('volunteer_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Volunteer::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function approve($id)
    {
        if (! Gate::allows('volunteer_view')) {
            return abort(401);
        }
        $volunteer = Volunteer::findOrFail($id);
        $user=User::findOrFail($volunteer->user->id);
        $volunteer->update(['approved_at' => Carbon::now()->toDateTimeString()]);
        $user->notify(new VolunteerNotification($volunteer));
        return redirect()->route('admin.volunteers.index');
    }

    public function reApprove($id)
    {
        if (! Gate::allows('volunteer_view')) {
            return abort(401);
        }
        $volunteer = Volunteer::findOrFail($id);
        $user=User::findOrFail($volunteer->user->id);
        $volunteer->update(['approved_at' => null]);
        return redirect()->route('admin.volunteers.index');
    }

}
