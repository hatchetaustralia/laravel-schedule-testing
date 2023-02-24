<?php

namespace Tests;

use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertCannotOverlap extends TestCase
{
    use InteractsWithSchedule;

    public function testCannotOverlap(): void
    {
        $this->fakeScheduledCommand()
            ->withoutOverlapping();

        $this->assertSchedule('fake:command')
            ->cannotOverlap();
    }

    public function testCannotOverlapFailure(): void
    {
        $this->fakeScheduledCommand();

        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            "Command [fake:command] is configured to allow overlapping."
        );

        $this->assertSchedule('fake:command')
            ->cannotOverlap();
    }
}
