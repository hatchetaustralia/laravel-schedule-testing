<?php

namespace Hatchet\LaravelScheduleTesting;

use Illuminate\Console\Scheduling\Event;

class ScheduleEvent extends Event
{
    public function expressionPasses(): bool
    {
        return parent::expressionPasses();
    }
}
