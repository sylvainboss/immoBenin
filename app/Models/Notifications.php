<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [
        'userid',
        'message',
        'read'
    ];

    /**
     * Relation avec l'utilisateur (Many to One).
     * Chaque message appartient à un utilisateur.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
