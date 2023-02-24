<?php

declare(strict_types=1);

namespace Hatchet\LaravelScheduleTesting;

use DateTimeZone;
use Carbon\Carbon;
use ReflectionMethod;
use ReflectionFunction;
use Illuminate\Support\Arr;
use PHPUnit\Framework\Assert;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Hatchet\LaravelScheduleTesting\Fakes\MailFake;
use Hatchet\LaravelScheduleTesting\Traits\MakesScheduleFrequencyAssertions;

final class ScheduleAssertion
{
    use MakesScheduleFrequencyAssertions;

    /** @var Collection<Int,Event> */
    private Collection $scheduledEvents;

    public function __construct(
        public string $signature,
    ) {
        $this->scheduledEvents = $this->findScheduledEventsBySignature();
    }

    public function hasExpression(string $cronExpression): self
    {
        Assert::assertGreaterThan(
            0,
            $this->scheduledEvents
                ->filter(fn (Event $event) => $event->expression === $cronExpression)
                ->count(),
            $this->failureMessage("cron expression does not match {$cronExpression}.")
        );

        return $this;
    }

    public function runsInMaintenanceMode(): self
    {
        Assert::assertGreaterThan(
            0,
            $this->scheduledEvents
                ->filter(fn (Event $event) => $event->evenInMaintenanceMode)
                ->count(),
            $this->failureMessage('does not run in maintenance mode.')
        );

        return $this;
    }

    public function canOverlap(): self
    {
        Assert::assertGreaterThan(
            0,
            $this->scheduledEvents
                ->filter(fn (Event $event) => ! $event->withoutOverlapping)
                ->count(),
            $this->failureMessage('is configured to prevent overlapping.')
        );

        return $this;
    }

    public function cannotOverlap(): self
    {
        Assert::assertGreaterThan(
            0,
            $this->scheduledEvents
                ->filter(fn (Event $event) => $event->withoutOverlapping)
                ->count(),
            $this->failureMessage('is configured to allow overlapping.')
        );

        return $this;
    }

    /**
     * @param string|array<int,string> $environment
     */
    public function runsInEnvironment(string|array $environment): self
    {
        $environments = collect(Arr::wrap($environment));

        Assert::assertGreaterThan(
            0,
            $this->scheduledEvents
                ->filter(fn (Event $event) => $environments->every(
                    fn (string $environment) => $event->runsInEnvironment($environment)
                ))
                ->count(),
            $this->failureMessage("is not scheduled to run in {$environments->implode(' and ')}.")
        );

        return $this;
    }

    /**
     * @param string|array<int,string> $email
     */
    public function hasEmailOutputOnFailure(string|array $email): self
    {
        Mail::fake();
        Mail::swap(new MailFake);

        // Trigger failure callbacks
        $this->scheduledEvents
            ->each
            ->finish(app(), exitCode: 1);

        $emails = collect(Arr::wrap($email));

        Mail::assertRawSent(function ($mail) use ($emails) {
            $function = new ReflectionFunction($mail['callback']);

            $variables = $function->getStaticVariables();

            $hasEmails = isset($variables['addresses']) && is_array($variables['addresses'])
                ? collect($variables['addresses'])->diff($emails)->isEmpty()
                : false;

            $fromScheduleEvent = $function->getClosureThis()::class === Event::class;

            return $fromScheduleEvent && $hasEmails;
        }, $this->failureMessage("does not have {$emails->implode(', ')} configured for a failure output email."));

        return $this;
    }

    public function isScheduled(?Carbon $scheduledAt = null): self
    {
        if (! is_null($scheduledAt)) {
            return $this->isScheduledToRunAt($scheduledAt);
        }

        Assert::assertGreaterThan(
            0,
            $this->scheduledEvents->count(),
            $this->failureMessage('is not scheduled.')
        );

        return $this;
    }

    public function isScheduledToRunAt(Carbon $scheduledAt): self
    {
        $now = Carbon::now();

        Carbon::setTestNow($scheduledAt);

        Assert::assertGreaterThan(
            0,
            $this->scheduledEvents
                ->filter(function ($event) {
                    $reflectionMethod = new ReflectionMethod(Event::class, 'expressionPasses');
                    $reflectionMethod->setAccessible(true);

                    return $reflectionMethod->invoke($event);
                })
                ->count(),
            $this->failureMessage("is not scheduled to run at {$scheduledAt->toDateTimeString()}.")
        );

        Carbon::setTestNow($now);

        return $this;
    }

    public function hasTimezone(DateTimeZone|string $timezone): self
    {
        $timezoneName = fn (DateTimeZone|string $timezone) =>
            is_string($timezone)
                ? $timezone
                : $timezone->getName();

        Assert::assertTrue(
            $this->scheduledEvents->some(
                fn (Event $event): bool => $timezoneName($event->timezone) == $timezoneName($timezone)
            ),
            $this->failureMessage("does not have the timezone {$timezoneName($timezone)}.")
        );

        return $this;
    }

    /**
     * @return Collection<Int,Event>
     */
    private function findScheduledEventsBySignature(): Collection
    {
        /** @var Collection<Int,Event> */
        $events = (App::get(Schedule::class))->events();

        return collect($events)
            ->filter(
                fn (Event $event) =>
                    is_string($event->command) && str_contains($event->command, $this->signature)
            );
    }

    private function failureMessage(string $message): string
    {
        $prefix = "Command [{$this->signature}]";

        return "{$prefix} {$message}";
    }
}
