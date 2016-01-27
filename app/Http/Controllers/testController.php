<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\Test;

class testController extends Controller
{
    public function getIndex()
    {
        $job = (new Test())->onQueue('emails');
        $this->dispatch($job);
    }
}
