<?php

namespace Tests;

use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertRunsInMaintenanceMode extends TestCase
{
    use InteractsWithSchedule;

    public function testRunsInMaintenanceMode(): void
    {
        $this->fakeScheduledCommand()
            ->evenInMaintenanceMode();

        $this->assertSchedule('fake:command')
            ->runsInMaintenanceMode();
    }

    public function testRunsInMaintenanceModeFailure(): void
    {
        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            "Command [fake:command] does not run in maintenance mode."
        );

        $this->assertSchedule('fake:command')
            ->runsInMaintenanceMode();
    }
}
