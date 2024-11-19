<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Ville extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ville',
        'code_postale_id',
        'featured',
        'image',
    ];


    
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_ville', 'ville_id', 'client_id');
    }
    


    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }


    public function code_postale()
    {
        return $this->belongsTo(CodePostale::class);
    }


    protected static function booted()
    {
        static::deleting(function (Ville $ville) {
            $ville->leads()->each(function ($lead) {
                $lead->delete(); // Soft delete each user
            });
        });
    }

}
