<?php

namespace App\DateTime;

class FakeClock implements ClockInterface
{

    public function isNight(): bool
    {
        return true;
    }
}
