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

    /**
     * @dataProvider mismatchedScheduleFrequencies
     */
    public function testScheduleFrequencyFailure(string $scheduleFrequency, string $assertion): void
    {
        $this->fakeScheduledCommand()->{$scheduleFrequency}();

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches('/Command \[fake:command\] does not run/');

        $this->assertSchedule('fake:command')->{$assertion}();
    }

    public function testHourlyAt(): void
    {
        // single time
        $this->fakeScheduledCommand()->hourlyAt(20);

        $this->assertSchedule('fake:command')
            ->runsHourlyAt(20);

        // multiple times
        $this->fakeScheduledCommand()->hourlyAt([20, 30]);

        $this->assertSchedule('fake:command')
            ->runsHourlyAt([20, 30]);
    }

    public function testHourlyAtFailure(): void
    {
        $this->fakeScheduledCommand()->hourlyAt(20);

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches('/Command \[fake:command\] does not run hourly at 10/');

        $this->assertSchedule('fake:command')
            ->runsHourlyAt(10);

        $this->fakeScheduledCommand()->hourlyAt([15, 20]);

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches('/Command \[fake:command\] does not run hourly at 1 and 2/');

        $this->assertSchedule('fake:command')
            ->runsHourlyAt([1, 2]);
    }

    public function testDailyAt(): void
    {
        $this->fakeScheduledCommand()->dailyAt('16:30');

        $this->assertSchedule('fake:command')
            ->runsDailyAt('16:30');
    }

    public function testDailyAtFailure(): void
    {
        $this->fakeScheduledCommand()->dailyAt('20');

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches('/Command \[fake:command\] does not run daily at 16:00/');

        $this->assertSchedule('fake:command')
            ->runsDailyAt('16:00');
    }

    public function testTwiceDailyWithArguments(): void
    {
        $this->fakeScheduledCommand()->twiceDaily(20, 30);

        $this->assertSchedule('fake:command')
            ->runsTwiceDaily('20', '30');
    }

    public function testTwiceDailyWithArgumentsFailure(): void
    {
        $this->fakeScheduledCommand()->twiceDaily();

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches('/Command \[fake:command\] does not run twice daily at 12:00 and 16:00/');

        $this->assertSchedule('fake:command')
            ->runsTwiceDaily(12, 16);
    }

    public function testTwiceDailyAt(): void
    {
        $this->fakeScheduledCommand()->twiceDailyAt(8, 10, 6);

        $this->assertSchedule('fake:command')
            ->runsTwiceDailyAt(8, 10, 6);
    }

    public function testTwiceDailyAtFailure(): void
    {
        $this->fakeScheduledCommand()->twiceDailyAt();

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches('/Command \[fake:command\] does not run twice daily at 12:15 and 16:15/');

        $this->assertSchedule('fake:command')
            ->runsTwiceDailyAt(12, 16, 15);
    }

    public function testWeeklyOn(): void
    {
        $this->fakeScheduledCommand()->weeklyOn(5);

        $this->assertSchedule('fake:command')
            ->runsWeeklyOn(5);

        $this->fakeScheduledCommand()->weeklyOn([1, 5]);

        $this->assertSchedule('fake:command')
            ->runsWeeklyOn([1, 5]);

        $this->fakeScheduledCommand()->weeklyOn([1, 5], '23:23');

        $this->assertSchedule('fake:command')
            ->runsWeeklyOn([1, 5], '23:23');
    }

    public function testWeeklyOnFailure(): void
    {
        $this->fakeScheduledCommand()->weeklyOn(0);

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches(
            '/Command \[fake:command\] does not run on the 5th day of the week at 15:00/'
        );

        $this->assertSchedule('fake:command')
            ->runsWeeklyOn(5, 15);

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches(
            '/Command \[fake:command\] does not run on the 3rd and 5th day of the week at 12:35/'
        );

        $this->assertSchedule('fake:command')
            ->runsWeeklyOn([3, 5], '12:35');
    }

    public function testLastDayOfMonth(): void
    {
        $this->fakeScheduledCommand()->lastDayOfMonth('05:30');

        $this->assertSchedule('fake:command')
            ->runsLastDayOfMonth('05:30');

        // Can allow for default time
        $this->fakeScheduledCommand()->lastDayOfMonth();

        $this->assertSchedule('fake:command')
            ->runsLastDayOfMonth();
    }

    public function testLastDayOfMonthFailure(): void
    {
        $this->fakeScheduledCommand()->lastDayOfMonth();

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches(
            '/Command \[fake:command\] does not run on the last day of the month at 15:35/'
        );

        $this->assertSchedule('fake:command')
            ->runsLastDayOfMonth('15:35');
    }

    public function testMonthlyOn(): void
    {
        $this->fakeScheduledCommand()->monthlyOn(5, '05:30');

        $this->assertSchedule('fake:command')
            ->runsMonthlyOn(5, '05:30');
    }

    public function testMonthlyOnFailure(): void
    {
        $this->fakeScheduledCommand()->monthlyOn();

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches(
            '/Command \[fake:command\] does not run monthly on the 5th day at 15:35/'
        );

        $this->assertSchedule('fake:command')
            ->runsMonthlyOn(5, '15:35');
    }

    public function testQuarterlyOn(): void
    {
        /** @phpstan-ignore-next-line */
        $this->fakeScheduledCommand()->quarterlyOn(5, '05:30');

        $this->assertSchedule('fake:command')
            ->runsQuarterlyOn(5, '05:30');
    }

    public function testQuarterlyOnFailure(): void
    {
        $this->fakeScheduledCommand()->quarterlyOn();

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches(
            '/Command \[fake:command\] does not run quarterly on the 5th day at 15:35/'
        );

        $this->assertSchedule('fake:command')
            ->runsQuarterlyOn(5, '15:35');
    }

    public function testYearlyOn(): void
    {
        $this->fakeScheduledCommand()->yearlyOn(1, 5, '05:30');

        $this->assertSchedule('fake:command')
            ->runsYearlyOn(1, 5, '05:30');
    }

    public function testYearlyOnFailure(): void
    {
        $this->fakeScheduledCommand()->yearlyOn();

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches(
            '/Command \[fake:command\] does not run yearly on the 5th day of the 1st month at 15:35/'
        );

        $this->assertSchedule('fake:command')
            ->runsYearlyOn(1, 5, '15:35');
    }

    public function testAt(): void
    {
        $this->fakeScheduledCommand()->at('05:30');

        $this->assertSchedule('fake:command')
            ->runsAt('05:30');
    }

    public function testAtFailure(): void
    {
        $this->fakeScheduledCommand()->at('12:00');

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches('/Command \[fake:command\] does not run daily at 15:35/');

        $this->assertSchedule('fake:command')
            ->runsAt('15:35');
    }

    public function testDays(): void
    {
        $this->fakeScheduledCommand()->days([1, 2, 3]);

        $this->assertSchedule('fake:command')
            ->runsOnDays([1, 2, 3]);

        $this->fakeScheduledCommand()->days(1);

        $this->assertSchedule('fake:command')
            ->runsOnDays(1);

        $this->fakeScheduledCommand()->days(1, 5);

        $this->assertSchedule('fake:command')
            ->runsOnDays(1, 5);
    }

    public function testDaysFailure(): void
    {
        $this->fakeScheduledCommand()->days(4);

        $this->expectException(AssertionFailedError::class);
        $this->expectExceptionMessageMatches(
            '/Command \[fake:command\] does not run on the 4th and 7th day of the week/'
        );

        $this->assertSchedule('fake:command')
            ->runsOnDays(4, 7);
    }

    /**
     * @return array<array<int,string>>
     */
    public function scheduleFrequencies(): array
    {
        return [
            ['everyMinute', 'runsEveryMinute'],
            ['everyTwoMinutes', 'runsEveryTwoMinutes'],
            ['everyThreeMinutes', 'runsEveryThreeMinutes'],
            ['everyFourMinutes', 'runsEveryFourMinutes'],
            ['everyFiveMinutes', 'runsEveryFiveMinutes'],
            ['everyTenMinutes', 'runsEveryTenMinutes'],
            ['everyFifteenMinutes', 'runsEveryFifteenMinutes'],
            ['everyThirtyMinutes', 'runsEveryThirtyMinutes'],
            ['hourly', 'runsHourly'],

            ['everyOddHour', 'runsEveryOddHour'],
            ['everyTwoHours', 'runsEveryTwoHours'],
            ['everyThreeHours', 'runsEveryThreeHours'],
            ['everyFourHours', 'runsEveryFourHours'],
            ['everySixHours', 'runsEverySixHours'],
            ['daily', 'runsDaily'],

            ['twiceDaily', 'runsTwiceDaily'],
            ['weekly', 'runsWeekly'],
            ['monthly', 'runsMonthly'],
            ['twiceMonthly', 'runsTwiceMonthly'],
            ['quarterly', 'runsQuarterly'],
            ['yearly', 'runsYearly'],

            ['weekdays', 'runsOnWeekdays'],
            ['weekends', 'runsOnWeekends'],
            ['mondays', 'runsOnMondays'],
            ['tuesdays', 'runsOnTuesdays'],
            ['wednesdays', 'runsOnWednesdays'],
            ['thursdays', 'runsOnThursdays'],
            ['fridays', 'runsOnFridays'],
            ['saturdays', 'runsOnSaturdays'],
            ['sundays', 'runsOnSundays'],
        ];
    }

    /**
     * @return array<array<int,string>>
     */
    public function mismatchedScheduleFrequencies(): array
    {
        return [
            ['everyMinute', 'runsHourly'],
            ['everyTwoMinutes', 'runsHourly'],
            ['everyThreeMinutes', 'runsHourly'],
            ['everyFourMinutes', 'runsHourly'],
            ['everyFiveMinutes', 'runsHourly'],
            ['everyTenMinutes', 'runsHourly'],
            ['everyFifteenMinutes', 'runsHourly'],
            ['everyThirtyMinutes', 'runsHourly'],
            ['hourly', 'runsEveryMinute'],
            ['everyOddHour', 'runsHourly'],
            ['everyTwoHours', 'runsHourly'],
            ['everyThreeHours', 'runsHourly'],
            ['everyFourHours', 'runsHourly'],
            ['everySixHours', 'runsHourly'],
            ['daily', 'runsHourly'],
            ['twiceDaily', 'runsHourly'],
            ['weekly', 'runsHourly'],
            ['monthly', 'runsHourly'],
            ['twiceMonthly', 'runsHourly'],
            ['lastDayOfMonth', 'runsHourly'],
            ['quarterly', 'runsHourly'],
            ['yearly', 'runsHourly'],
        ];
    }
}
