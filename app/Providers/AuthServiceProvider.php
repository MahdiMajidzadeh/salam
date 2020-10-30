<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
