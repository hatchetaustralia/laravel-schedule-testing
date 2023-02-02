<?php

namespace Hatchet\LaravelScheduleTesting\Traits;

use NumberFormatter;
use Illuminate\Support\Arr;
use PHPUnit\Framework\Assert;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\ManagesFrequencies;

trait MakesScheduleFrequencyAssertions
{
    use ManagesFrequencies;

    public string $expression = '* * * * *';

    private function assertScheduleFrequency(string $message): self
    {
        Assert::assertTrue(
            $this->scheduledEvents->some(
                fn (Event $event): bool => $event->expression == $this->expression,
            ),
            $this->failureMessage("does not run {$message}. Cron expression does not match {$this->expression}.")
        );

        return $this;
    }

    public function runsEveryMinute(): self
    {
        return $this->everyMinute()
            ->assertScheduleFrequency('every minute');
    }

    public function runsEveryTwoMinutes(): self
    {
        return $this->everyTwoMinutes()
            ->assertScheduleFrequency('every 2 minutes');
    }

    public function runsEveryThreeMinutes(): self
    {
        return $this->everyThreeMinutes()
            ->assertScheduleFrequency('every 3 minutes');
    }

    public function runsEveryFourMinutes(): self
    {
        return $this->everyFourMinutes()
            ->assertScheduleFrequency('every four minutes');
    }

    public function runsEveryFiveMinutes(): self
    {
        return $this->everyFiveMinutes()
            ->assertScheduleFrequency('every five minutes');
    }

    public function runsEveryTenMinutes(): self
    {
        return $this->everyTenMinutes()
            ->assertScheduleFrequency('every 10 minutes');
    }

    public function runsEveryFifteenMinutes(): self
    {
        return $this->everyFifteenMinutes()
            ->assertScheduleFrequency('every 15 minutes');
    }

    public function runsEveryThirtyMinutes(): self
    {
        return $this->everyThirtyMinutes()
            ->assertScheduleFrequency('every 30 minutes');
    }

    public function runsHourly(): self
    {
        return $this->hourly()
            ->assertScheduleFrequency('every hour');
    }

    public function runsEveryOddHour(): self
    {
        return $this->everyOddHour()
            ->assertScheduleFrequency('every odd hour');
    }

    public function runsEveryTwoHours(): self
    {
        return $this->everyTwoHours()
            ->assertScheduleFrequency('every 2 hours');
    }

    public function runsEveryThreeHours(): self
    {
        return $this->everyThreeHours()
            ->assertScheduleFrequency('every 3 hours');
    }

    public function runsEveryFourHours(): self
    {
        return $this->everyFourHours()
            ->assertScheduleFrequency('every 4 hours');
    }

    public function runsEverySixHours(): self
    {
        return $this->everySixHours()
            ->assertScheduleFrequency('every 6 hours');
    }

    public function runsDaily(): self
    {
        return $this->daily()
            ->assertScheduleFrequency('daily');
    }

    public function runsTwiceDaily($first = 1, $second = 13): self
    {
        $firstHour = $this->addLeadingZero($first);
        $secondHour = $this->addLeadingZero($second);

        return $this->twiceDaily($first, $second)
            ->assertScheduleFrequency("twice daily at {$firstHour}:00 and {$secondHour}:00");
    }

    public function runsWeekly(): self
    {
        return $this->weekly()
            ->assertScheduleFrequency('weekly');
    }

    public function runsMonthly(): self
    {
        return $this->monthly()
            ->assertScheduleFrequency('monthly');
    }

    public function runsTwiceMonthly(): self
    {
        return $this->twiceMonthly()
            ->assertScheduleFrequency('twice monthly');
    }

    public function runsQuarterly(): self
    {
        return $this->quarterly()
            ->assertScheduleFrequency('quarterly');
    }

    public function runsYearly(): self
    {
        return $this->yearly()
            ->assertScheduleFrequency('yearly');
    }

    public function runsHourlyAt(array|int $offset): self
    {
        $minutes = collect(Arr::wrap($offset));

        return $this->hourlyAt($offset)
            ->assertScheduleFrequency("hourly at {$minutes->implode(' and ')}");
    }

    public function runsDailyAt(string|int $time): self
    {
        return $this->dailyAt($time)
            ->assertScheduleFrequency("daily at {$time}");
    }

    public function runsTwiceDailyAt($first = 1, $second = 13, $offset = 0): self
    {
        $minutes = $this->addLeadingZero($offset);

        return $this->twiceDailyAt($first, $second, $offset)
            ->assertScheduleFrequency("twice daily at {$first}:{$minutes} and {$second}:{$minutes}");
    }

    public function runsWeeklyOn(array|string|int $dayOfWeek, $time = '0:0'): self
    {
        $days = collect(Arr::wrap($dayOfWeek))
            ->map(fn ($day) => $this->formatOrdinalNumeral($day));

        [$hour, $minutes] = $this->formatTime($time);

        return $this->weeklyOn($dayOfWeek, $time)
            ->assertScheduleFrequency("on the {$days->implode(' and ' )} day of the week at {$hour}:{$minutes}");
    }

    public function runsMonthlyOn(int|string $dayOfMonth = 1, string|int $time = '0:0'): self
    {
        [$hour, $minutes] = $this->formatTime($time);

        return $this->monthlyOn($dayOfMonth, $time)
            ->assertScheduleFrequency("monthly on the {$this->formatOrdinalNumeral($dayOfMonth)} day at {$hour}:{$minutes}");
    }

    public function runsLastDayOfMonth(string|int $time = '0:0'): self
    {
        [$hour, $minutes] = $this->formatTime($time);

        return $this->lastDayOfMonth($time)
            ->assertScheduleFrequency("on the last day of the month at {$hour}:{$minutes}");
    }

    public function runsQuarterlyOn(int|string $dayOfQuarter = 1, string|int $time = '0:0'): self
    {
        [$hour, $minutes] = $this->formatTime($time);

        return $this->quarterlyOn($dayOfQuarter, $time)
            ->assertScheduleFrequency("quarterly on the {$this->formatOrdinalNumeral($dayOfQuarter)} day at {$hour}:{$minutes}");
    }

    public function runsYearlyOn(int|string $month = 1, int|string $dayOfMonth = 1, string|int $time = '0:0'): self
    {
        [$hour, $minutes] = $this->formatTime($time);

        return $this->yearlyOn($month, $dayOfMonth, $time)
            ->assertScheduleFrequency(
                sprintf(
                    "yearly on the %s day of the %s month at {$hour}:{$minutes}",
                    $this->formatOrdinalNumeral($dayOfMonth),
                    $this->formatOrdinalNumeral($month),
                )
            );
    }

    public function runsAt(string|int $time): self
    {
        [$hour, $minutes] = $this->formatTime($time);

        return $this->at($time)
            ->assertScheduleFrequency("daily at {$hour}:{$minutes}");
    }

    public function runsOnDays(array|int|string $days): self
    {
        $formattedDays = collect(Arr::wrap(is_array($days) ? $days : func_get_args()))
            ->map(fn ($day) => $this->formatOrdinalNumeral($day));

        return $this->days(...func_get_args())
            ->assertScheduleFrequency("on the {$formattedDays->implode(' and ')} day of the week");
    }

    public function runsOnWeekdays(): self
    {
        return $this->weekdays()
            ->assertScheduleFrequency('on weekdays');
    }

    public function runsOnWeekends(): self
    {
        return $this->weekends()
            ->assertScheduleFrequency('on weekends');
    }

    public function runsOnMondays(): self
    {
        return $this->mondays()
            ->assertScheduleFrequency('on mondays');
    }

    public function runsOnTuesdays(): self
    {
        return $this->tuesdays()
            ->assertScheduleFrequency('on tuesdays');
    }

    public function runsOnWednesdays(): self
    {
        return $this->wednesdays()
            ->assertScheduleFrequency('on wednesdays');
    }

    public function runsOnThursdays(): self
    {
        return $this->thursdays()
            ->assertScheduleFrequency('on thursdays');
    }

    public function runsOnFridays(): self
    {
        return $this->fridays()
            ->assertScheduleFrequency('on fridays');
    }

    public function runsOnSaturdays(): self
    {
        return $this->saturdays()
            ->assertScheduleFrequency('on saturdays');
    }

    public function runsOnSundays(): self
    {
        return $this->sundays()
            ->assertScheduleFrequency('on sundays');
    }

    private function addLeadingZero(int|string $number): string
    {
        return str_pad($number, 2, '0', STR_PAD_LEFT);
    }

    private function formatTime($time): array
    {
        $times = explode(':', $time);

        $hour = $this->addLeadingZero($times[0]);
        $minutes = $this->addLeadingZero(isset($times[1]) ? $times[1] : 0);

        return [
            $hour,
            $minutes,
        ];
    }

    private function formatOrdinalNumeral(int|float $day): string|bool
    {
        $formatter = new NumberFormatter('en_AU', NumberFormatter::ORDINAL);

        return $formatter->format($day);
    }
}
