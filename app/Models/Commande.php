<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Commande extends Model
{
    
    use SoftDeletes;
    
    protected $fillable = [
        "client_id",
        "nombre_leads",
        "date_livraison",
        "thematique",
        "departement",
        "description",
        "excel_path"
    ];

    
    public function  client()
    {
        return $this->belongsTo(Client::class);
    }


}
