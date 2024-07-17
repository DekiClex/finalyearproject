<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Models\Cases;
use Carbon\Carbon;

class updateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cases:update-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch pending cases
        $pendingCases = Cases::where('Status', '=', 1) // Exclude already overdue cases (assuming "Overdue" status has ID 3)
                            ->get();

        foreach ($pendingCases as $case) {

            if ($case->Day < Carbon::now()->format('d') || $case->Month < Carbon::now()->format('Y-m')) {
            $case->Status = 3; // Update status to "Overdue" (assuming ID 3)
            $case->save();
            }
        }
    }
}
