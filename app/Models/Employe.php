<?php

namespace App\Models;

use App\Models\PaiementSalaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employe extends Model
{
    use HasFactory;
    protected $guarded = [''];

    /**
     * Get the employe that owns the Employe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

/**
 * Get all of the paiements for the Employe
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function paiements()
{
    return $this->hasMany(PaiementSalaire::class);
}
}
