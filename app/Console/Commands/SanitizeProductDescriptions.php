<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class SanitizeProductDescriptions extends Command
{
    protected $signature = 'products:sanitize-descriptions
                            {--dry-run : Report changes without writing to the database}';

    protected $description = 'Re-sanitize all product descriptions through the model mutator (idempotent)';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $scanned = 0;
        $changed = 0;

        Product::query()->chunkById(100, function ($products) use ($dryRun, &$scanned, &$changed): void {
            foreach ($products as $product) {
                $product->description = $product->description;
                $scanned++;

                if ($product->isDirty('description')) {
                    $changed++;
                    if (!$dryRun) {
                        $product->save();
                    }
                }
            }
        });

        $this->info("Products scanned:           {$scanned}");
        $this->info("Products requiring changes: {$changed}");

        if ($dryRun) {
            $this->warn('Dry run — no database writes performed.');
        }

        return Command::SUCCESS;
    }
}
