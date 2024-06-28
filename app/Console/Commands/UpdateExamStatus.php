<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateExamStatus extends Command
{
    protected $signature = 'exam:update-status';
    protected $description = 'Update the status of exams from published to completed after a day';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        // Fetch exams to be updated
        $examsToUpdate = Exam::where('status', 'published')
            ->where('date', '<', $now->subMinute()) // Change to subDay() for production
            ->get();

        // Log the exams that will be updated
        Log::info('Exams to be updated:', $examsToUpdate->pluck('id')->toArray());

        // Update exams
        Exam::whereIn('id', $examsToUpdate->pluck('id'))
            ->update(['status' => 'completed']);

        $this->info('Exam statuses updated successfully.');

        return Command::SUCCESS;
    }
}
