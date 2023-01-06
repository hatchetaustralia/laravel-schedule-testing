<?php

namespace Tests;

use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertIsScheduled extends TestCase
{
    use InteractsWithSchedule;

    public function test_is_scheduled(): void
    {
        $this->fakeScheduledCommand();

        $this->assertSchedule('fake:command')
            ->isScheduled();
    }

    public function test_is_scheduled_failure(): void
    {
        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            "Command [undefined:command] is not scheduled."
        );

        $this->assertSchedule('undefined:command')
            ->isScheduled();
    }
}
