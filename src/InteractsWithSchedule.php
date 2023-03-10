<?php

declare(strict_types=1);

namespace Hatchet\LaravelScheduleTesting;

use PHPUnit\Framework\Assert;

trait InteractsWithSchedule
{
    protected function assertSchedule(string $signature, callable $callback = null): ScheduleAssertion
    {
        $assertionWrapper = new ScheduleAssertion($signature);

        if (is_callable($callback)) {
            Assert::assertGreaterThan(
                0,
                $assertionWrapper->filterEvents($callback)->count(),
                "The expected Command [{$assertionWrapper->signature}] is not scheduled."
            );
        }

        return $assertionWrapper;
    }
}
