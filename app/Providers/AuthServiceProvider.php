<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('delete-reservation', function ($user, $reservation) {
            return ($user->id === $reservation->user_id)
                && ($reservation->booking->booking_date > now()->addDays(config('nahar.gap_day'))->startOfDay());
        });
    }
}
