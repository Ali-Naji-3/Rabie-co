<?php

namespace App\Observers;

use App\Models\EgpRateHistory;
use Illuminate\Support\Facades\Cache;

class EgpRateHistoryObserver
{
    public function created(EgpRateHistory $record): void
    {
        Cache::forget('egp_rate');
    }
}
