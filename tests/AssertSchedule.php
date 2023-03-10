<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Console\Scheduling\Event;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertSchedule extends TestCase
{
    use InteractsWithSchedule;

    public function testAllowsForOptionalCallbackAssertion(): void
    {
        $this->fakeScheduledCommand();

        $this->assertSchedule('fake:command', function () {
            return true;
        });
    }

    public function testOptionalCallbackAssertionFailure(): void
    {
        $this->fakeScheduledCommand();

        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            'The expected Command [fake:command] is not scheduled.'
        );

        $this->assertSchedule('fake:command', function () {
            return false;
        });
    }

    public function testCallbackHasScheduledEventParameterAvailable(): void
    {
        $this->fakeScheduledCommand();

        $this->assertSchedule('fake:command', function (Event $event) {
            $this->assertInstanceOf(Event::class, $event);

            return true;
        });
    }

    public function testCallbackPassesAssertionWhenAtLeastOneScheduledCommandMatchesCondition(): void
    {
        $this->fakeScheduledCommand('fake:command');

        $this->fakeScheduledCommand('fake:command')
            ->description('I have a description!');

        $this->assertSchedule('fake:command', function (Event $event) {
            return $event->description === 'I have a description!';
        });
    }
}
