<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Clubs & societies
        Gate::define('clubs_&_society_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Categories
        Gate::define('category_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('category_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('category_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Clubs
        Gate::define('club_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('club_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('club_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('club_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('club_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Thread
        Gate::define('thread_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('thread_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('thread_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Updates
        Gate::define('update_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('update_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('update_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('update_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('update_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Events1
        Gate::define('events1_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Invitations
        Gate::define('invitation_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('invitation_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('invitation_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('invitation_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('invitation_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Events
        Gate::define('event_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('event_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('event_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('event_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('event_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Volunteers
        Gate::define('volunteer_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('volunteer_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('volunteer_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('volunteer_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

                // Auth gates for: Comments
        Gate::define('comment_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('comment_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('comment_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
