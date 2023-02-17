# Assertions

[[toc]]

## hasEmailOutputOnFailure
Asserts that the command has the given email recipients configured to receive an email with output on failure.

```php
$this->assertSchedule('command')
    ->hasEmailOutputOnFailure('email@gmail.com');
```

Multiple recipients can be checked by using an array:
```php
$this->assertSchedule('command')
    ->hasEmailOutputOnFailure(['email@gmail.com', 'email@outlook.com']);
```

## hasExpression
Asserts that the command has the given cron expression.

```php
$this->assertSchedule('command')
    ->hasExpression('0 * * * *');
```

## hasTimezone
Asserts that the command has the given timezone.

```php
$this->assertSchedule('command')
    ->hasTimezone('Australia/Perth');
```

Or you can pass a DateTimeZone:
```php
$this->assertSchedule('command')
    ->hasTimezone(new DateTimeZone('Australia/Perth'));
```

## isScheduled
Asserts that the command has a defined schedule.

```php
$this->assertSchedule('command')
    ->isScheduled();
```

An optional parameter can be provided to check that the command is scheduled to run at the given time.

```php
$this->assertSchedule('command')
    ->isScheduled(now()->startOfDay());
```

## isScheduledToRunAt
Asserts that the command is scheduled to run at the provided date.

```php
$this->assertSchedule('command')
    ->isScheduledToRunAt(now()->startOfDay());
```

## runsInEnvironment
Asserts that the command is scheduled to run in all provided environments.

```php
$this->assertSchedule('command')
    ->runsInEnvironment('production');
```

Multiple environments can be checked by using an array:
```php
$this->assertSchedule('command')
    ->runsInEnvironment(['production', 'staging']);
```

## runsInMaintenanceMode
Asserts that the command is scheduled to run even while the application is in maintenance mode.

```php
$this->assertSchedule('command')
    ->runsInMaintenanceMode();
```
