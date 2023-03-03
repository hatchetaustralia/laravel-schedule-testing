<p align="center">
  <a href="https://hatchet.com.au" target="_blank">
    <picture>
      <source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/hatchetaustralia/laravel-schedule-testing/HEAD/.github/logo-dark.png">
      <source media="(prefers-color-scheme: light)" srcset="https://raw.githubusercontent.com/hatchetaustralia/laravel-schedule-testing/HEAD/.github/logo-light.png">
      <img alt="Hatchet's Laravel Schedule Testing" src="https://raw.githubusercontent.com/hatchetaustralia/laravel-schedule-testing/HEAD/.github/logo-light.png" width="664" height="566" style="max-width: 100%; object-fit: contain;">
    </picture>
  </a>
</p>

<p align="center">
<a href="https://github.com/hatchetaustralia/laravel-schedule-testing/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/hatchetaustralia/laravel-schedule-testing"><img src="https://img.shields.io/packagist/dt/hatchetaustralia/laravel-schedule-testing" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/hatchetaustralia/laravel-schedule-testing"><img src="https://img.shields.io/packagist/v/hatchetaustralia/laravel-schedule-testing" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/hatchetaustralia/laravel-schedule-testing"><img src="https://img.shields.io/packagist/l/hatchetaustralia/laravel-schedule-testing" alt="License"></a>
</p>

## About Laravel Schedule Testing
Laravel Schedule Testing was created and is maintained by the developers at [Hatchet](https://hatchet.com.au) and is a lightweight package for testing your scheduled commands in Laravel.

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

- [hasEmailOutputOnFailure](#hasEmailOutputOnFailure)
- [hasExpression](#hasExpression)
- [hasTimezone](#hasTimezone)
- [isScheduled](#isScheduled)
- [isScheduledToRunAt](#isScheduledToRunAt)
- [runsInEnvironment](#runsInEnvironment)

### hasEmailOutputOnFailure
Asserts that the command has the given email recipients configured to receive an email with output on failure.

```php
$this->assertSchedule('command')->hasEmailOutputOnFailure('email@gmail.com');
```

Multiple recipients can be checked by using an array:
```php
$this->assertSchedule('command')->hasEmailOutputOnFailure(['email@gmail.com', 'email@outlook.com']);
```

### hasExpression
Asserts that the command has the given cron expression.

```php
$this->assertSchedule('command')->hasExpression('0 * * * *');
```

### hasTimezone
Asserts that the command has the given timezone.

```php
$this->assertSchedule('command')->hasTimezone('Australia/Perth');
```

Or you can pass a DateTimeZone:
```php
$this->assertSchedule('command')->hasTimezone(new DateTimeZone('Australia/Perth'));
```

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

## Contributing

Thank you for considering to contribute to Laravel Schedule Testing. All the contribution guidelines are mentioned [here](CONTRIBUTING.md).

You can have a look at the [CHANGELOG](CHANGELOG.md) for constant updates & detailed information about the changes.

## License

Laravel Schedule Testing is an open-sourced software licensed under the [Do Not Harm License](LICENSE.md).
