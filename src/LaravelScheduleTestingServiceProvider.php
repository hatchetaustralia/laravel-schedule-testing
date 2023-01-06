<?php

declare(strict_types=1);

namespace Hatchet\LaravelScheduleTesting;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * @internal
 */
final class LaravelScheduleTestingServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        // todo - I'm not sure this is necessary at all ae

        // $macro = fn (string $signature) => new ScheduleAssertion($signature);

        // if (class_exists(\Illuminate\Testing\TestResponse::class)) {
        //     \Illuminate\Testing\TestResponse::macro('assertSchedule', $macro);
        // } else {
        //     \Illuminate\Foundation\Testing\TestResponse::macro('assertSchedule', $macro);
        // }
    }
}
