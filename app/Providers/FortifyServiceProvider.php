<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LoginResponse::class, function ($app) {
            return new class implements LoginResponse {
                public function toResponse($request)
                {
                    $user = $request->user();

                    if ($user->role === 'admin') {
                        return redirect()->route('admin.dashboard');
                    }

                    return redirect()->route('user.dashboard');
                }
            };
        });
    }

    public function boot(): void
    {
        //
    }
}
