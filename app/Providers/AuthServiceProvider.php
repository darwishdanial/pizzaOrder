<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\order;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define a gate to allow only admins (user_type == 1)
        Gate::define('view-admin-detail', function (User $user) {
            return $user->user_type == 0;
        });

        Gate::define('add-to-cart', function (User $user) {

            $pizzaOrder = Order::where('user_id', $user->id)
                                ->where('is_active', true)
                                ->whereIn('status', [1, 2, 3])
                                ->first();
            if (is_null($pizzaOrder)) {
                return true;
            }else{
                return false;
            }
            
        });
    }
}
