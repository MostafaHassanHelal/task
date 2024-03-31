<?php

namespace App\Jobs;

use App\Models\Statistics;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateStatisticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $assigned_to_id)
    {
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $statictics = Statistics::firstOrCreate(
            ['user_id' => $this->assigned_to_id],
        );
        $statictics->increment('tasks_count');
        
        Log::channel('statisticsJob')->info("Task count updated for user with id: $this->assigned_to_id");
    }
}
