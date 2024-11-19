<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_coupon extends Model
{
    use HasFactory;
    protected $fillable = ["coupon_id", "client_id", "lead_id"];

}
