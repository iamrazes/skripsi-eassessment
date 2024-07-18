<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Exam;
use Carbon\Carbon;

class UpdateExamStatus extends Command
{
    protected $signature = 'exams:update-status';
    protected $description = 'Update the status of exams to "complete" if the exam duration is over plus one hour';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        $exams = Exam::where('status', 'published')
                    ->whereRaw('TIMESTAMPADD(MINUTE, duration + 60, CONCAT(date, " ", start_time)) <= ?', [$now])
                    ->get();

        foreach ($exams as $exam) {
            $exam->status = 'completed';
            $exam->save();
        }

        $this->info('Exam statuses updated successfully.');
    }


}
