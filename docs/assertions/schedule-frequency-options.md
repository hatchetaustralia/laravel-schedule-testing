# Schedule Frequency Options Assertions
The following assertions are mapped to each of the [Schedule Frequency Options](https://laravel.com/docs/9.x/scheduling#schedule-frequency-options) that are available to eloquently configure schedules in Laravel.

Each of these assertions have the same parameters as their counterparts.

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

## runsTwiceDaily
Asserts that the command runs twice daily. By default the hours checked are the first and thirteenth hour.

```php
$this->assertSchedule('command')
    ->runsTwiceDaily();
```

The hours to check in the day can be passed in as parameters. This example checks that the command runs twice daily at 08:00am and 08:00pm
```php
$this->assertSchedule('command')
    ->runsTwiceDaily(first: 8, second: 20);
```

## runsWeekly
Asserts that the command runs weekly.

```php
$this->assertSchedule('command')
    ->runsWeekly();
```

## runsMonthly
Asserts that the command runs monthly.

```php
$this->assertSchedule('command')
    ->runsMonthly();
```

## runsTwiceMonthly
Asserts that the command runs twice monthly. By default the days checked are the first and sixteenth of the month at 00:00.

$first = 1, $second = 16, $time = '0:0'

```php
$this->assertSchedule('command')
    ->runsTwiceMonthly();
```

The days and time of both days can be checked by passing the following parameters. This example checks that the command runs on the 5th and 10th days at 16:30:

```php
$this->assertSchedule('command')
    ->runsTwiceMonthly(first: 5, second: 10, time: '16:30');
```

## runsQuarterly
Asserts that the command runs quarterly.

```php
$this->assertSchedule('command')
    ->runsQuarterly();
```

## runsYearly
Asserts that the command runs yearly.

```php
$this->assertSchedule('command')
    ->runsYearly();
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
