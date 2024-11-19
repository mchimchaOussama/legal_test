<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Lead extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'agent',
        'heure',
        'date',
        'thematique_id',
        'ville_id',
        'departement_id',
        'code_postale',
        'modeConsommation',
        'proprietaire',
        'metrage',
        'adressePostale', // adresse
        'disponibilite',
        'commentaireAgent',
        'commentaireAuditeur',
        'lienMp3Bip',
        'lienMp3',
        'publier',
        'user_id',
        'adresse_cache',
        'adresse_reelle',
        'payer',
        'prospect_id',
        'prix',
        'description',
        'code_postale_id',
        'reference',
        'entreprise',
        'gerantNonSalarie',
        'nombreDeSalarie',
        'lange',
        'activite',
        'gerant',
        'modeChauffage',
        'fournisseurGaz',
        'fournisseurElectrecite',
        'coutGaz',
        'coutElectrecite',
        'salarie',
        'datSalarie',
        'thematiqueDinteret',
        'lange2',
        'maison',
        'interetAmeliorationHabitat',
        'fonctionEntreprise',
        'operationActuel',
        'nombreLineConcernees',
        'telephonFix',
        'telephonMobile',
        'typeServicesRecherche',
        'DatChangementOperateur',
        'commentaireParticulier'
    ];
    


    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
    
    
    public function departement()
    {
        return $this->belongsTo(Departement::class,'departement_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prospect()
    {
        return $this->belongsTo(Prospect::class, 'prospect_id');
    }

    public function thematique()
    {
        return $this->belongsTo(Thematique::class);
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
        return $this->hasMany(Payment::class,'lead_id');
    }

    public function coupon()
    {
        return $this->hasone(Coupon::class);
    }


    public function clients()
    {
        $this->belongToMany(Client::class);
    }

    public function viewedByClients()
    {
        return $this->belongsToMany(Client::class, 'client_lead', 'lead_id', 'client_id')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    

}
