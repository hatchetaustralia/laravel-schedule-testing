<?php

namespace Tests;

use Tests\TestCase;
use PHPUnit\Framework\AssertionFailedError;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

final class AssertScheduleFrequency extends TestCase
{
    use InteractsWithSchedule;

    /**
     * @dataProvider scheduleFrequencies
     */
    public function testScheduleFrequencyPasses(string $scheduleFrequency, string $assertion): void
    {
        $this->fakeScheduledCommand()->{$scheduleFrequency}();

        $this->assertSchedule('fake:command')->{$assertion}();
    }

    public function testScheduleFrequencyFailure(): void
    {
        // $this->fakeScheduledCommand();

        // $this->expectException(AssertionFailedError::class);

        // $this->expectExceptionMessage(
        //     "Command [fake:command] does not have the timezone Australia/Perth."
        // );

        // $this->assertSchedule('fake:command')
        //     ->hasTimezone('Australia/Perth');

        // $this->assertSchedule('fake:command')
        //     ->hasTimezone(new DateTimeZone('Australia/Perth'));
    }

    public function scheduleFrequencies(): array
    {
        return [
            ['everyMinute', 'runsEveryMinute'],
            // ['everyTwoMinutes', 'runsEveryTwoMinutes'],
            // ['everyThreeMinutes', 'runsEveryThreeMinutes'],
            // ['everyFourMinutes', 'runsEveryFourMinutes'],
            // ['everyFiveMinutes', 'runsEveryFiveMinutes'],
            // ['everyTenMinutes', 'runsEveryTenMinutes'],
            // ['everyFifteenMinutes', 'runsEveryFifteenMinutes'],
            // ['everyThirtyMinutes', 'runsEveryThirtyMinutes'],
            // ['hourly', 'runsHourly'],
            // ['hourlyAt', 'runsHourlyAt'],
            // ['everyOddHour', 'runsEveryOddHour'],
            // ['everyTwoHours', 'runsEveryTwoHours'],
            // ['everyThreeHours', 'runsEveryThreeHours'],
            // ['everyFourHours', 'runsEveryFourHours'],
            // ['everySixHours', 'runsEverySixHours'],
            // ['daily', 'runsDaily'],
            // ['dailyAt', 'runsDailyAt'],
            // ['twiceDaily', 'runsTwiceDaily'],
            // ['twiceDailyAt', 'runsTwiceDailyAt'],
            // ['weekly', 'runsWeekly'],
            // ['weeklyOn', 'runsWeeklyOn'],
            // ['monthly', 'runsMonthly'],
            // ['monthlyOn', 'runsMonthlyOn'],
            // ['twiceMonthly', 'runsTwiceMonthly'],
            // ['lastDayOfMonth', 'runsLastDayOfMonth'],
            // ['quarterly', 'runsQuarterly'],
            // ['quarterlyOn', 'runsQuarterlyOn'],
            // ['yearly', 'runsYearly'],
            // ['yearlyOn', 'runsYearlyOn'],
        ];
    }
}
