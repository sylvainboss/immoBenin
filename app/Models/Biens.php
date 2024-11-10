<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biens extends Model
{

    protected $fillable = [
        'nom',
        'adresse',
        'ville_id',
        'prix',
        'type_id',
        'superficie',
        'userid',
        'accept',
        'nombre_piece',
        'document',
        'categorie'
    ];

    /**
     * Relation avec la ville (Many to One).
     * Chaque enregistrement appartient à une ville.
     */
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    /**
     * Relation avec le type (Many to One).
     * Chaque enregistrement appartient à un type.
     */
    public function type()
    {
        return $this->belongsTo(Types::class, 'type_id');
    }

    /**
     * Relation avec l'utilisateur (Many to One).
     * Chaque enregistrement appartient à un utilisateur.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function images()  {
        return $this->hasMany(BienImages::class, 'bien_id');
    }
}
