<?php

namespace Hatchet\LaravelScheduleTesting\Fakes;

use PHPUnit\Framework\Assert as PHPUnit;
use Illuminate\Support\Testing\Fakes\MailFake as BaseMailFake;

class MailFake extends BaseMailFake
{
    protected $rawMailables = [];

    /**
     * Send a new message with only a raw text part.
     *
     * @param  string  $text
     * @param  \Closure|string  $callback
     * @return void
     */
    public function raw($text, $callback)
    {
        $this->rawMailables[] = [
            'text' => $text,
            'callback' => $callback,
        ];
    }

    public function assertRawSent(callable $callback, string $message = 'The expected raw mail was not sent.'): void
    {
        PHPUnit::assertTrue(
            collect($this->rawMailables)
                ->filter(fn ($mailable) => $callback($mailable))
                ->count() > 0,
            $message
        );
    }
}
