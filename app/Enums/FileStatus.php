<?php

namespace App\Enums;

enum FileStatus: string
{
    case PENDING = 'pending';

    case SIGNED = 'signed';
}
