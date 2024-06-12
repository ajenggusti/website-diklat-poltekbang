<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class CleanActivityLog extends Command
{
    protected $signature = 'activitylog:clean';
    protected $description = 'Clean old activity logs';

    public function handle()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        Activity::where('created_at', '<', $thirtyDaysAgo)->delete();
        $this->info('Old activity logs cleaned up successfully!');
    }
}
