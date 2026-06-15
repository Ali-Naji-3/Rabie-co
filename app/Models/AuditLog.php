<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'actor_id',
        'actor_type',
        'event_source',
        'event',
        'subject_type',
        'subject_id',
        'old_values',
        'new_values',
        'ip_address',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
    ];

    public static function record(
        string $event,
        ?Model $subject = null,
        array $old = [],
        array $new = []
    ): void {
        static::create([
            'actor_id'     => auth()->id(),
            'actor_type'   => static::resolveActorType(),
            'event_source' => static::resolveEventSource(),
            'event'        => $event,
            'subject_type' => $subject ? get_class($subject) : null,
            'subject_id'   => $subject?->getKey(),
            'old_values'   => $old ?: null,
            'new_values'   => $new ?: null,
            'ip_address'   => request()?->ip(),
        ]);
    }

    private static function resolveActorType(): string
    {
        if (auth()->check()) {
            return 'user';
        }
        if (app()->runningInConsole()) {
            return 'system';
        }
        return 'guest';
    }

    private static function resolveEventSource(): ?string
    {
        if (app()->runningInConsole()) {
            return 'system';
        }
        $request = request();
        if (! $request) {
            return null;
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            return 'admin_panel';
        }
        if ($request->expectsJson() || $request->is('api/*')) {
            return 'api';
        }
        return 'web';
    }
}
