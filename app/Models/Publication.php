<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Publication extends Model
{
    use HasFactory;
   use SoftDeletes;

    protected $fillable = [
        'client_id',
        'prospect_id',
        'user_id',
        'lead_id',
        'date',
        'payer',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function Prospect()
    {
        return $this->belongsTo(Lead::class, 'prospect_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
