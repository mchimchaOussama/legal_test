<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'prix',
        'methode',
        'client_id',
        'lead_id',
        'user_id',
        'prospect_id',
        'thematique_id',
        'ville_id',
        'departement_id',
        'publication_id',
        'paymentId'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class,'lead_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    public function prospect()
    {
        return $this->belongsTo(Prospect::class, "prospect_id");
    }
    public function thematique()
    {
        return $this->belongsTo(Thematique::class ,'thematique_id');
    }
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
    public function departement()
    {
        return $this->belongsTo(Departement::class,'departement_id');
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
