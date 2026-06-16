<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public function saved(Category $category): void
    {
        Cache::forget('categories:active');
        Cache::forget('categories:active_with_counts');
    }

    public function deleted(Category $category): void
    {
        Cache::forget('categories:active');
        Cache::forget('categories:active_with_counts');
    }
}
