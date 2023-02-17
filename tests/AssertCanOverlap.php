<?php

namespace Tests;

use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertCanOverlap extends TestCase
{
    use InteractsWithSchedule;

    public function testCanOverlap(): void
    {
        $this->fakeScheduledCommand();

        $this->assertSchedule('fake:command')
            ->canOverlap();
    }

    public function testCanOverlapFailure(): void
    {
        $this->fakeScheduledCommand()
            ->withoutOverlapping();

        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            "Command [fake:command] does not run in maintenance mode."
        );

        $this->assertSchedule('fake:command')
            ->canOverlap();
    }
}
