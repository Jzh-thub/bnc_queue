<?php

namespace tests;

use TpQueue\base\BaseJob;
use TpQueue\Queue;

class TestJob extends BaseJob
{

    public function index()
    {
        print_r(1);

    }

    public function doJob($data)
    {
        print_r($data);
        return true;
    }

    public function doJob1($data,$data1)
    {
        print_r($data);
        print_r($data1);
    }
}