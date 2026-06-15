<?php

namespace App\Listeners;

use App\Models\AuditLog;
use Illuminate\Auth\Events\Login;

class RecordAdminLogin
{
    public function handle(Login $event): void
    {
        if ($event->user->role !== 'admin') {
            return;
        }

        try {
            AuditLog::record('admin_login_success', null, [], [
                'email' => $event->user->email,
            ]);
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
