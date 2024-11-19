<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Departement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'departement',
        'num'
    ];


    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_departement', 'departement_id', 'client_id');
    }

    public function client()
    {
        return $this->belongsToMany(Client::class, 'client_departement', 'departement_id', 'client_id');
    }
    

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class,'departement_id');
    }


    protected static function booted()
    {
        static::deleting(function (Departement $departement) {
            $departement->leads()->each(function ($lead) {
                $lead->delete(); // Soft delete each user
            });
        });
    }

    
}
