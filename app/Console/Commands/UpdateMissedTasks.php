<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;

class UpdateMissedTasks extends Command
{
    protected $signature = 'tasks:update-missed';
    protected $description = 'Mark overdue pending tasks as missed';

    public function handle()
    {
        $now = Carbon::now();

        $updated = Task::where('status', 'pending')
            ->whereNotNull('due_date')
            ->where('due_date', '<', $now)
            ->update([
                'status' => 'missed'
            ]);

        $this->info("{$updated} task(s) marked as missed");
    }
}