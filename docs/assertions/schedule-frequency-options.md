# Schedule Frequency Options Assertions
The following assertions are mapped to each of the [Schedule Frequency Options](https://laravel.com/docs/9.x/scheduling#schedule-frequency-options) that are available to eloquently configure schedules in Laravel.

Each of these assertions have the same parameters as their counterparts.

## runsAt
Asserts that the command runs at the given time.

```php
$this->assertSchedule('command')
    ->runsAt('13:30');
```

## runsEveryMinute
Asserts that the command runs every minute.

```php
$this->assertSchedule('command')
    ->runsEveryMinute();
```

## runsEveryTwoMinutes
Asserts that the command runs every two minutes.

```php
$this->assertSchedule('command')
    ->runsEveryTwoMinutes();
```

## runsEveryThreeMinutes
Asserts that the command runs every three minutes.

```php
$this->assertSchedule('command')
    ->runsEveryThreeMinutes();
```

## runsEveryFourMinutes
Asserts that the command runs every four minutes.

```php
$this->assertSchedule('command')
    ->runsEveryFourMinutes();
```

## runsEveryFiveMinutes
Asserts that the command runs every five minutes.

```php
$this->assertSchedule('command')
    ->runsEveryFiveMinutes();
```

## runsEveryTenMinutes
Asserts that the command runs every ten minutes.

```php
$this->assertSchedule('command')
    ->runsEveryTenMinutes();
```

## runsEveryFifteenMinutes
Asserts that the command runs every fifteen minutes.

```php
$this->assertSchedule('command')
    ->runsEveryFifteenMinutes();
```

## runsEveryThirtyMinutes
Asserts that the command runs every thirty minutes.

```php
$this->assertSchedule('command')
    ->runsEveryThirtyMinutes();
```

## runsHourly
Asserts that the command runs every hour.

```php
$this->assertSchedule('command')
    ->runsHourly();
```

## runsHourlyAt
Asserts that the command runs every hour at the given time/s.

```php
$this->assertSchedule('command')
    ->runsHourlyAt(offset: 10);

// multiple times can be passed as an array
$this->assertSchedule('command')
    ->runsHourlyAt(offset: [10, 30]);
```

## runsEveryOddHour
Asserts that the command runs every odd hour.

```php
$this->assertSchedule('command')
    ->runsEveryOddHour();
```

## runsEveryTwoHours
Asserts that the command runs every two hours.

```php
$this->assertSchedule('command')
    ->runsEveryTwoHours();
```

## runsEveryThreeHours
Asserts that the command runs every three hours.

```php
$this->assertSchedule('command')
    ->runsEveryThreeHours();
```

## runsEveryFourHours
Asserts that the command runs every four hours.

```php
$this->assertSchedule('command')
    ->runsEveryFourHours();
```

## runsEverySixHours
Asserts that the command runs every six hours.

```php
$this->assertSchedule('command')
    ->runsEverySixHours();
```

## runsDaily
Asserts that the command runs daily at the start of the day.

```php
$this->assertSchedule('command')
    ->runsDaily();
```

## runsDailyAt
Asserts that the command runs daily at the given time.

```php
$this->assertSchedule('command')
    ->runsDailyAt(offset: '16:00');
```

## runsTwiceDaily
Asserts that the command runs twice daily. By default the hours checked are the first and thirteenth hour.

```php
$this->assertSchedule('command')
    ->runsTwiceDaily();

// Checking it runs at 08:00 and 20:00
$this->assertSchedule('command')
    ->runsTwiceDaily(first: 8, second: 20);
```

## runsTwiceDailyAt
Asserts that the command runs twice daily at the given time.

```php
$this->assertSchedule('command')
    ->runsTwiceDailyAt();

// Checking it runs at 08:15 and 20:15
$this->assertSchedule('command')
    ->runsTwiceDailyAt(first: 8, second: 20, offset: '15');
```

## runsWeekly
Asserts that the command runs weekly.

```php
$this->assertSchedule('command')
    ->runsWeekly();
```

## runsWeeklyOn
Asserts that the command runs weekly on the given day/s and time.

```php
$this->assertSchedule('command')
    ->runsWeeklyOn(dayOfWeek: 1, time: '12:15');

$this->assertSchedule('command')
    ->runsWeeklyOn(dayOfWeek: [1, 3, 5], time: '12:15');
```

## runsMonthly
Asserts that the command runs monthly.

```php
$this->assertSchedule('command')
    ->runsMonthly();
```

## runsMonthlyOn
Asserts that the command runs monthly on the given day and time.

```php
$this->assertSchedule('command')
    ->runsMonthlyOn(dayOfMonth: 5, time: '13:30');
```

## runsTwiceMonthly
Asserts that the command runs twice monthly. By default the days checked are the first and sixteenth of the month at 00:00.

```php
$this->assertSchedule('command')
    ->runsTwiceMonthly();

$this->assertSchedule('command')
    ->runsTwiceMonthly(first: 5, second: 10, time: '16:30');
```

## runsLastDayOfMonth
Asserts that the command runs on the last day of each month.

```php
$this->assertSchedule('command')
    ->runsLastDayOfMonth();

$this->assertSchedule('command')
    ->runsLastDayOfMonth(time: '13:30');
```

## runsQuarterly
Asserts that the command runs quarterly.

```php
$this->assertSchedule('command')
    ->runsQuarterly();
```

## runsQuarterlyOn
Asserts that the command runs quarterly on the given day and time.

```php
$this->assertSchedule('command')
    ->runsQuarterlyOn(dayOfQuarter: 5, time: '12:45');
```

## runsYearly
Asserts that the command runs yearly.

```php
$this->assertSchedule('command')
    ->runsYearly();
```

## runsYearlyOn
Asserts that the command runs yearly on the given month, day of month and time.

```php
$this->assertSchedule('command')
    ->runsYearlyOn(month: 4, dayOfMonth: 10, time: '03:30');
```

## runsOnWeekdays
Asserts that the command runs on weekdays.

```php
$this->assertSchedule('command')
    ->runsOnWeekdays();
```

## runsOnWeekends
Asserts that the command runs on weekends.

```php
$this->assertSchedule('command')
    ->runsOnWeekends();
```

## runsOnMondays
Asserts that the command runs on mondays.
```php
$this->assertSchedule('command')
    ->runsOnMondays();
```

## runsOnTuesdays
Asserts that the command runs on tuesdays.
```php
$this->assertSchedule('command')
    ->runsOnTuesdays();
```

## runsOnWednesdays
Asserts that the command runs on wednesdays.
```php
$this->assertSchedule('command')
    ->runsOnWednesdays();
```

## runsOnThursdays
Asserts that the command runs on thursdays.
```php
$this->assertSchedule('command')
    ->runsOnThursdays();
```

## runsOnFridays
Asserts that the command runs on fridays.
```php
$this->assertSchedule('command')
    ->runsOnFridays();
```

## runsOnSaturdays
Asserts that the command runs on saturdays.
```php
$this->assertSchedule('command')
    ->runsOnSaturdays();
```

## runsOnSundays
Asserts that the command runs on sundays.
```php
$this->assertSchedule('command')
    ->runsOnSundays();
```

## runsOnDays
Asserts that the command runs on the given days.
```php
$this->assertSchedule('command')
    ->runsOnDays(days: 3);

$this->assertSchedule('command')
    ->runsOnDays(days: [2, 4, 6]);
```

## runsOnDays
Asserts that the command runs on the given days.
```php
$this->assertSchedule('command')
    ->runsOnDays(days: 3);

$this->assertSchedule('command')
    ->runsOnDays(days: [2, 4, 6]);
```
