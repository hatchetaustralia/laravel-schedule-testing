<?php

namespace Tests;

use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertIsScheduledToRunAt extends TestCase
{
    use InteractsWithSchedule;

    public function test_is_scheduled_to_run_at(): void
    {
        $this->fakeScheduledCommand()
            ->hourly();

        $this->assertSchedule('fake:command')
            ->isScheduledToRunAt(now()->startOfHour());
    }

    public function test_is_scheduled_alias_for_is_scheduled_to_run_at(): void
    {
        $this->fakeScheduledCommand()
            ->hourly();

        $this->assertSchedule('fake:command')
            ->isScheduled(now()->startOfHour());
    }

    public function test_is_scheduled_failure(): void
    {
        $this->fakeScheduledCommand()
            ->hourly();

        $this->expectException(AssertionFailedError::class);

        $time = now()->startOfHour()->addMinutes(30);

        $this->expectExceptionMessage(
            "Command [fake:command] is not scheduled to run at {$time->toDateTimeString()}."
        );

        $this->assertSchedule('fake:command')
            ->isScheduledToRunAt($time);
    }
}
