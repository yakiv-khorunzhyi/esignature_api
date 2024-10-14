<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignatureRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'requester_id',
        'signer_id',
        'status',
        'signed_file_id',
        'signature_id',
    ];
}
