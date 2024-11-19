<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Coupon extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        "coupon",
        "reduction",
        "date_debut",
        "date_fin",
        "lead_id"
    ];


    public function clients()
    {
        return $this->belongsToMany(Client::Class);
    }

    public function lead()
    {
        return $this->hasone(Lead::class);
    }

}
