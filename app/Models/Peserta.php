<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peserta extends Model
{
    /** @use HasFactory<\Database\Factories\PesertaFactory> */
    use HasFactory;

    protected$guarded = ['id'];

    public function kamar(): BelongsTo{
        return $this->belongsTo(Kamar::class);
    }
}
