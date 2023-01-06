<?php

namespace Tests;

use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertRunsInEnvironment extends TestCase
{
    use InteractsWithSchedule;

    public function test_runs_in_environment_with_string_parameter(): void
    {
        $this->fakeScheduledCommand()
            ->environments('production');

        $this->assertSchedule('fake:command')
            ->runsInEnvironment('production');
    }

    public function test_runs_in_environment_with_array_parameter(): void
    {
        $this->fakeScheduledCommand()
            ->environments('production');

        $this->assertSchedule('fake:command')
            ->runsInEnvironment(['production']);
    }

    public function test_runs_in_environment_with_multiple_environments(): void
    {
        $this->fakeScheduledCommand()
            ->environments(['production', 'development']);

        $this->assertSchedule('fake:command')
            ->runsInEnvironment(['production', 'development']);
    }

    public function test_runs_in_environment_fails_when_does_not_match_single_environment(): void
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

    public function test_runs_in_environment_fails_when_a_single_given_environment_does_not_match(): void
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
