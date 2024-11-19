<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Prospect extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nom',
        'prenom',
        'tel',
        'email',
        'adresse',
        'civilite',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
    public function anormals()
    {
        return $this->hasMany(Anormal::class);
    }
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    

}
