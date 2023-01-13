<?php

namespace Tests;

use DateTimeZone;
use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertHasTimezone extends TestCase
{
    use InteractsWithSchedule;

    public function testHasTimezoneWithConfiguredString(): void
    {
        $this->fakeScheduledCommand()
            ->timezone('Australia/Perth');

        $this->assertSchedule('fake:command')
            ->hasTimezone('Australia/Perth');

        $this->assertSchedule('fake:command')
            ->hasTimezone(new DateTimeZone('Australia/Perth'));
    }

    public function testHasTimezoneWithConfiguredDateTimeZone(): void
    {
        $timezone = new DateTimeZone('Australia/Perth');

        $this->fakeScheduledCommand()
            ->timezone($timezone);

        $this->assertSchedule('fake:command')
            ->hasTimezone($timezone);

        $this->assertSchedule('fake:command')
            ->hasTimezone('Australia/Perth');
    }

    public function testHasTimezoneFailure(): void
    {
        $this->fakeScheduledCommand();

        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            "Command [fake:command] does not have the timezone Australia/Perth."
        );

        $this->assertSchedule('fake:command')
            ->hasTimezone('Australia/Perth');

        $this->assertSchedule('fake:command')
            ->hasTimezone(new DateTimeZone('Australia/Perth'));
    }
}
