<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CodePostale extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = ["code_postale"];
    
    public function villes()
    {
        return $this->hasMany(Ville::class);
    }


}
