<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'nom',
        'prenom',
        'tel',
        'email',
        'mot_de_passe',
        'accepter',
        'activer',
        'addresse',
        'numero_identification',
        'siren',
        'siret',
        'rcs',
        'entreprise',
        'verification',
        'firstActivateCompte'
    ];



    public function ville()
    {
        return $this->belongsToMany(Ville::class, 'client_ville', 'client_id', 'ville_id');
    }
    
    public function departement()
    {
        return $this->belongsToMany(Departement::class, 'client_departement', 'client_id', 'departement_id');
    }

    public function thematique()
    {
        return $this->belongsToMany(Thematique::class, 'client_thematique', 'client_id', 'thematique_id');
    }

    public function anormals()
    {
        return $this->hasMany(Anormal::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::Class);
    }



    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    

    protected static function booted()
    {
        static::deleting(function (Client $client) {
            $client->payments()->each(function ($payment) {
                $payment->delete(); // Soft delete each user
            });
        });
    }

    public function viewedLeads()
    {
        return $this->belongsToMany(Lead::class, 'client_lead', 'client_id', 'lead_id')->withTimestamps();
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


}
