<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transfer extends Model
{
    protected $fillable = [
        'batch_id',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(TransferFile::class);
    }
}
