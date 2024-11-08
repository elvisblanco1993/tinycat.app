<?php

namespace App\Enums;

enum ProjectStatuses: string
{
    case NOT_STARTED = 'not_started';
    case IN_PROGRESS = 'in_progress';
    case ON_HOLD = 'on_hold';
    case DELAYED = 'delayed';
    case COMPLETED = 'completed';
}
