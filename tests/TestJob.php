<?php

namespace tests;

use TpQueue\base\BaseJob;
use TpQueue\Queue;

class TestJob extends BaseJob
{

    public function index()
    {
        print_r(1);die;

    }

    public function doJob($data)
    {
        print_r($data);
    }
}