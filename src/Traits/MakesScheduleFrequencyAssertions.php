<?php

namespace Hatchet\LaravelScheduleTesting\Traits;

use PHPUnit\Framework\Assert;
use Illuminate\Console\Scheduling\ManagesFrequencies;

trait MakesScheduleFrequencyAssertions
{
    use ManagesFrequencies;

    public string $expression = '* * * * *';

    public function runsEveryMinute(): self
    {
        Assert::assertEquals(
            $cronExpression = '* * * * *',
            $this->everyMinute()->expression,
            $this->failureMessage("does not run every minute. Cron expression does not match {$cronExpression}.")
        );

        return $this;
    }
}
