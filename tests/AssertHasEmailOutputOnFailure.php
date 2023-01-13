<?php

namespace Tests;

use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertHasEmailOutputOnFailure extends TestCase
{
    use InteractsWithSchedule;

    public function testHasEmailOutputOnFailure(): void
    {
        $this->fakeScheduledCommand()
            ->emailOutputOnFailure('email@gmail.com');

        $this->assertSchedule('fake:command')
            ->hasEmailOutputOnFailure('email@gmail.com')
            ->hasEmailOutputOnFailure(['email@gmail.com']);
    }

    public function testHasEmailOutputOnFailureWithMultipleEmails(): void
    {
        $this->fakeScheduledCommand()
            ->emailOutputOnFailure(['email@gmail.com', 'email@outlook.com']);

        $this->assertSchedule('fake:command')
            ->hasEmailOutputOnFailure(['email@gmail.com', 'email@outlook.com']);
    }

    public function testHasEmailOutputOnFailureWillFailIfEmailMissing(): void
    {
        $this->fakeScheduledCommand();

        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            "Command [fake:command] does not have email@gmail.com configured for a failure output email."
        );

        $this->assertSchedule('fake:command')
            ->hasEmailOutputOnFailure('email@gmail.com');
    }

    public function testHasEmailOutputOnFailureWillFailIfSingleEmailMissing(): void
    {
        $this->fakeScheduledCommand()
            ->emailOutputOnFailure(['email@gmail.com', 'email@outlook.com']);

        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            "Command [fake:command] does not have email@gmail.com configured for a failure output email."
        );

        $this->assertSchedule('fake:command')
            ->hasEmailOutputOnFailure('email@gmail.com');
    }
}
