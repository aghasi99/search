<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\Write;
use Dawson\AmazonECS\AmazonECS;

class Search extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    protected $term;

    /**
     * Create a new job instance.
     *
     * @param string $term
     * @return void
     */
    public function __construct($term)
    {
        $this->term = $term;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $amazon = new AmazonECS();
        $result = $amazon->search($this->term)->json();

        if(isset($result['Items']['TotalResults'])){
            $this->delete();

            $count = $result['Items']['TotalResults'];
            $time = $result['OperationRequest']['RequestProcessingTime'];

            $job = (new Write($this->term, $count, $time))->onQueue('write');
            $this->dispatch($job);
        } else {
            $this->release();
        }
    }
}
