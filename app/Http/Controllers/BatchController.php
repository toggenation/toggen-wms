<?php

namespace App\Http\Controllers;

use App\Services\Batch;
use App\Services\BatchYDDDXX;
use Illuminate\Http\Request;

class BatchController extends Controller
{

    public function __construct(Batch $batch)
    {
        $this->batch = $batch;
    }
    public function __invoke(Batch $batch)
    {
        return $this->batch::generate();
    }
}
