<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    /** @use HasFactory<\Database\Factories\KamarFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function peserta(): HasMany{
        return $this->hasMany(Peserta::class);
    }
}
