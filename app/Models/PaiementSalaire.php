<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementSalaire extends Model
{
    use HasFactory;
    protected $guarded = [''];

    /**
     * Get the employe that owns the PaiementSalaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}
