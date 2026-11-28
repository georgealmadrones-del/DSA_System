<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $name = session('admin_name', 'Alex Davis');
            $email = session('admin_email', 'admin@educore.local');
            $avatar = session('admin_avatar');
            $initials = strtoupper(substr(trim((string) $name), 0, 2)) ?: 'AD';

            $view->with([
                'adminName' => $name,
                'adminEmail' => $email,
                'adminAvatar' => $avatar,
                'adminInitials' => $initials,
            ]);
        });
    }
}