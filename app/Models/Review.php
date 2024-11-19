<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'review',
        'client_id',
        'rating',
        'publier',
        'departement_id',
        'thematique_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
