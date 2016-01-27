<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\SearchResult;

class Write extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $term;
    protected $count;
    protected $time;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($term, $count, $time)
    {
        $this->term = $term;
        $this->count = $count;
        $this->time = $time;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $result = SearchResult::create([
            'term' => $this->term,
            'count' => $this->count,
            'time' => $this->time
        ]);

        if($result){
            $this->delete();
        } else {
            $this->release();
        }
    }
}
