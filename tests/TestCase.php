<?php

namespace Tests;

use Mockery;
use Mockery\MockInterface;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Orchestra\Testbench\TestCase as Orchestra;
use Hatchet\LaravelScheduleTesting\ScheduleEvent;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->instance(
            Event::class,
            Mockery::mock(Event::class, function (MockInterface $mock) {
                $mock->shouldAllowMockingProtectedMethods()
                    ->shouldReceive('expressionPasses');
                    // ->;
                // $mock->shouldReceive('expressionPasses')
                //     ->andReturn(true);

                // $mock->shouldReceive('process')->once();
            })
        );
    }

    public function fakeScheduledCommand(string $signature = 'fake:command'): Event
    {
        return $this->app->make(Schedule::class)
            ->command($signature)
            ->everyMinute();
    }
}
