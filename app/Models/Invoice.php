<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'amount',
        'payment_id'
    ];
    public function clients()
    {
        $this->belongToMany(Client::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
