<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invitation;
use Carbon\Carbon;

class AcceptController extends Controller
{
    public function accept($invitation_id, $action)
    {
        $invitation = Invitation::findOrFail($invitation_id);
        if (!in_array($action, ['join', 'declin'])) {
            abort(404);
        }
        if ($action == 'join') {
            $invitation->update(['accepted_at' => Carbon::now()->toDateTimeString()]);
        }
        if ($action == 'declin') {
            $invitation->update(['rejected_at' => Carbon::now()->toDateTimeString()]);
        }
        return back()->with('success', 'You are successfully ' . $action . 'ed | ' . $invitation->event->name. ' Event');
    }

}
