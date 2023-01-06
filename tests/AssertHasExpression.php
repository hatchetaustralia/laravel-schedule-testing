<?php

namespace Tests;

use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertHasExpression extends TestCase
{
    use InteractsWithSchedule;

    public function setUp(): void
    {
        parent::setUp();

        $this->fakeScheduledCommand()->hourly();
    }

    public function test_has_expression(): void
    {
        $this->assertSchedule('fake:command')
            ->hasExpression('0 * * * *');
    }

    public function test_has_expression_failure(): void
    {
        $this->expectException(AssertionFailedError::class);

        $this->expectExceptionMessage(
            "Command [fake:command] cron expression does not match 1 * * * *"
        );

        $this->assertSchedule('fake:command')
            ->hasExpression('1 * * * *');
    }
}
