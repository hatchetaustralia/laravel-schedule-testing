<?php

namespace Tests;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function fakeScheduledCommand(string $signature = 'fake:command'): Event
    {
        return $this->app->make(Schedule::class)
            ->command($signature)
            ->everyMinute();
    }
}
