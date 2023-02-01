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
        $formatter = new NumberFormatter('en_AU', NumberFormatter::ORDINAL);

        $days = collect(Arr::wrap($dayOfWeek))
            ->map(fn ($day) => $formatter->format($day));

        $times = explode(':', $time);

        $hour = $this->addLeadingZero($times[0]);
        $minutes = $this->addLeadingZero(isset($times[1]) ? $times[1] : 0);

        return $this->weeklyOn($dayOfWeek, $time)
            ->assertScheduleFrequency("on the {$days->implode(' and ' )} day of the week at {$hour}:{$minutes}");
    }

    public function runsMonthlyOn(): self
    {
        return $this->monthlyOn()
            ->assertScheduleFrequency('');
    }

    public function runsLastDayOfMonth(): self
    {
        return $this->lastDayOfMonth()
            ->assertScheduleFrequency('');
    }

    public function runsQuarterlyOn(): self
    {
        return $this->quarterlyOn()
            ->assertScheduleFrequency('');
    }

    public function runsYearlyOn(): self
    {
        return $this->yearlyOn()
            ->assertScheduleFrequency('');
    }

    private function addLeadingZero(int|string $number): string
    {
        return str_pad($number, 2, '0', STR_PAD_LEFT);
    }
}
