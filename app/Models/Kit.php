<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kit extends Model
{
    /** @use HasFactory<\Database\Factories\KitFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function peserta(): BelongsTo{
        return $this->belongsTo(Peserta::class);
    }
}
