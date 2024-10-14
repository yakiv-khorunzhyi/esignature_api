<?php

namespace App\Enums;

enum FileType: string
{
    case DOCUMENT = 'document';

    case SIGNATURE = 'signature';

    case SIGNED_DOCUMENT = 'signed_document';
}
