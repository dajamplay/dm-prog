<?php

namespace App\Infrastructure;

class App
{
    private Test $test;

    public function __construct(Test $test)
    {
        $this->test = $test;
    }

    public function test()
    {
        $this->test->test();
    }
}