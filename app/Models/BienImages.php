<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BienImages extends Model
{
    protected $fillable = [
        'bien_id',
        'url',
    ];

    public function bien()  {
        return $this->belongsTo(Biens::class);
    }
}
