<?php

declare(strict_types=1);

namespace Hatchet\LaravelScheduleTesting;

trait InteractsWithSchedule
{
    protected function assertSchedule(string $signature): ScheduleAssertion
    {
        return new ScheduleAssertion($signature);
    }
}
