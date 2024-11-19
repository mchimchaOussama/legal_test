<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientLead extends Model
{
    use HasFactory;

    protected $table = 'client_lead';  // The name of the pivot table

    protected $fillable = ['client_id', 'lead_id'];

}
