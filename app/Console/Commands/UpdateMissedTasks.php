<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class UpdateMissedTasks extends Command
{
    protected $signature   = 'app:update-missed-tasks';
    protected $description = 'Command description';

    // Handles pending status in the past
    public function handle() {
        $updated = Task::where('status', 'pending')
            ->whereNotNull('due_date')
            ->where('due_date', '<', now())
            ->update(['status' => 'missed']);

        // Test output
        $this->info("You missed {$updated} task(s)!");
    }
}
