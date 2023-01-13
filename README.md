<a href="https://hatchet.com.au">
    <p align="center">
        <img
            src="https://github.com/hatchetaustralia/laravel-schedule-testing/raw/main/docs/laravel-schedule-testing-logo.png" alt="Hatchet's Laravel Schedule Testing Package" width="439" height="250"
        />
    </p>
</a>

<p align="center">
    <img src="https://github.com/hatchetaustralia/laravel-schedule-testing/raw/main/docs/example.png" alt="Laravel Schedule Testing Example" width="80%" />
</p>

<hr>

## About Laravel Schedule Testing
Laravel Schedule Testing was created and maintained by the developers at [Hatchet](https://hatchet.com.au) and is a lightweight package for testing your scheduled commands in Laravel.

## Installation
>Minimum requirement of PHP 8.0 and Laravel 9

Require Laravel Schedule Testing via [Composer](https://getcomposer.org/):
```php
composer require hatchetaustralia/laravel-schedule-testing --dev
```


## Usage
```php
class HourlyReportCommandTest extends TestCase
{
    // Add the `InteractsWithSchedule` trait to your class
    use InteractsWithSchedule;

    public function testCommandRunsOnTheHour()
    {
        // Then, get started with using the `assertSchedule` method.
        $this->assertSchedule('reports:send-report')
            ->isScheduledToRunAt(now()->startOfHour());
    }
}
```

## Available Assertions

### isScheduled
Asserts that the command has a defined schedule.

```php
$this->assertSchedule('command')->isScheduled();
```

An optional parameter can be provided to check that the command is scheduled to run at the given time.

```php
$this->assertSchedule('command')->isScheduled(now()->startOfDay());
```

### isScheduledToRunAt
Asserts that the command is scheduled to run at the provided date.

```php
$this->assertSchedule('command')->isScheduledToRunAt(now()->startOfDay());
```

### runsInEnvironment
Asserts that the command is scheduled to run in all provided environments.

```php
$this->assertSchedule('command')->runsInEnvironment('production');
```

Multiple environments can be checked by using an array:
```php
$this->assertSchedule('command')->runsInEnvironment(['production', 'staging']);
```

### hasExpression
Asserts that the command has the given cron expression

```php
$this->assertSchedule('command')->hasExpression('0 * * * *');
```


## Contributing

Thank you for considering to contribute to Laravel Schedule Testing. All the contribution guidelines are mentioned [here](CONTRIBUTING.md).

You can have a look at the [CHANGELOG](CHANGELOG.md) for constant updates & detailed information about the changes.

## License

Laravel Schedule Testing is an open-sourced software licensed under the [Do Not Harm License](LICENSE.md).
