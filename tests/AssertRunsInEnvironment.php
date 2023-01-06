<?php

namespace Tests;

use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertRunsInEnvironment extends TestCase
{
    use InteractsWithSchedule;

    public function testRunsInEnvironmentWithStringParameter(): void
    {
        $this->fakeScheduledCommand()
            ->environments('production');

        $this->assertSchedule('fake:command')
            ->runsInEnvironment('production');
    }

    public function testRunsInEnvironmentWithArrayParameter(): void
    {
        $this->fakeScheduledCommand()
            ->environments('production');

        $this->assertSchedule('fake:command')
            ->runsInEnvironment(['production']);
    }

    public function testRunsInEnvironmentWithMultipleEnvironments(): void
    {
        $this->fakeScheduledCommand()
            ->environments(['production', 'development']);

        $this->assertSchedule('fake:command')
            ->runsInEnvironment(['production', 'development']);
    }

    public function testRunsInEnvironmentFailsWhenDoesNotMatchSingleEnvironment(): void
    {
        $this->fakeScheduledCommand()
            ->environments('local');

        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            "Command [fake:command] is not scheduled to run in production"
        );

        $this->assertSchedule('fake:command')
            ->runsInEnvironment('production');
    }

    public function testRunsInEnvironmentFailsWhenASingleGivenEnvironmentDoesNotMatch(): void
    {
        $this->fakeScheduledCommand()
            ->environments(['local', 'development']);

        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            "Command [fake:command] is not scheduled to run in local and production"
        );

        $this->assertSchedule('fake:command')
            ->runsInEnvironment(['local', 'production']);
    }
}
