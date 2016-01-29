<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\Search;

class SearchController extends Controller
{
    public function index(){
        $term = env('SEARCH', null);

        if(!is_null($term)) {
            $job = (new Search($term))->onQueue('search');
            $this->dispatch($job);

            return view('search.add');
        } else {
            abort(403, 'No Search term found');
        }

    }
}
