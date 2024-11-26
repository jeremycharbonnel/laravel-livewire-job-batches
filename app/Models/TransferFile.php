<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransferFile extends Model
{
    protected $fillable = [
        'disk',
        'path',
        'size'
    ];

    protected $casts = [
        'disk' => 'string',
        'path' => 'string',
        'size' => 'integer'
    ];

    public function transfer(): BelongsTo
    {
        return $this->belongsTo(Transfer::class);
    }
}
