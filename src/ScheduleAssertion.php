<?php

declare(strict_types=1);

namespace Hatchet\LaravelScheduleTesting;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use PHPUnit\Framework\Assert;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;

final class ScheduleAssertion
{
    private Collection $scheduledEvents;

    public function __construct(
        public string $signature,
    ) {
        $this->scheduledEvents = $this->findScheduledEventsBySignature($signature);
    }

    public function hasExpression(string $cronExpression): self
    {
        Assert::assertGreaterThan(
            0,
            $this->scheduledEvents
                ->filter(fn (Event $event) => $event->expression === $cronExpression)
                ->count(),
            "Command [{$this->signature}] cron expression does not match {$cronExpression}."
        );

        return $this;
    }

    public function runsInEnvironment(string|array $environment): self
    {
        $environments = collect(Arr::wrap($environment));

        Assert::assertGreaterThan(
            0,
            $this->scheduledEvents
                ->filter(fn (Event $event) => $environments->every(fn (string $environment) => $event->runsInEnvironment($environment)))
                ->count(),
            "Command [{$this->signature}] is not scheduled to run in {$environments->implode(' and ')}."
        );

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
            "Command [{$this->signature}] is not scheduled."
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
                // ->map(fn (Event $event) => new ScheduleEvent(
                //     $event->mutex,
                //     $event->command,
                //     $event->timezone,
                // ))
                ->filter(fn ($event) => $event->expressionPasses())
                ->count(),
            "Command [{$this->signature}] is not scheduled to run at {$scheduledAt->toDateTimeString()}."
        );

        Carbon::setTestNow($now);

        return $this;
    }

    private function findScheduledEventsBySignature(): Collection
    {
        $schedule = App::get(Schedule::class);

        // dd($schedule->events());

        return collect($schedule->events())
            ->filter(fn (Event $event) => str_contains($event->command, $this->signature));
    }
}
