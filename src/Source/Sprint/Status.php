<?php

namespace App\Source\Sprint;

class Status
{
    public const READY_TO_START = 1;
    public const IN_PROGRESS = 2;
    public const DONE = 3;

    public static function getStatuses(): array
    {
        return [
            'Ready to Start' => self::READY_TO_START,
            'In Progress' => self::IN_PROGRESS,
            'Done' => self::DONE,
        ];
    }
}
