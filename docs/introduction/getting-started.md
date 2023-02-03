# Getting Started

## Installation

>Minimum requirement of PHP 8.0 and Laravel 9

Require `hatchetaustralia/laravel-schedule-testing` via [Composer](https://getcomposer.org/):
```php
composer require hatchetaustralia/laravel-schedule-testing --dev
```

## Usage
```php{11,16}
<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase;
use Hatchet\LaravelScheduleTesting\InteractsWithSchedule;

class HourlyReportCommandTest extends TestCase // [!code focus:20]
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

All assertions can be chained off of one another:

```php
$this->assertSchedule('reports:send-report')
    ->runsEveryMinute()
    ->hasTimezone('Pacific/Auckland')
    ->runsInEnvironment('production');
```
