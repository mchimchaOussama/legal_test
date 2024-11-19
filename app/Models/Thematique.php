<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Lead;


class Thematique extends Model
{
    use HasFactory;
    use SoftDeletes;


       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'thematique',
        'type',
        'image',
        'theme'
    ];


    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function lead()
    {
        return $this->hasMany(Lead::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_thematique', 'client_id', 'thematique_id');
    }
    
      /**
     * The available types for the 'type' attribute.
     *
     * @var array<string>
     */
    public static array $types = ['B2B', 'B2C'];


    protected static function booted()
    {
        static::deleting(function (Thematique $thematique) {
            $thematique->leads()->each(function ($lead) {
                $lead->delete(); // Soft delete each user
            });
        });
    }


}
