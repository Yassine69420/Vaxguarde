<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hopital extends Model
{
    protected $table = 'hopitals'; // Specify the table name

    public $timestamps = false; // Disable timestamps (created_at, updated_at)

    protected $fillable = [
        'nom',
        'Region',
        'Ville',
        'Type',
    ];

    public function infirmiers()
    {
        return $this->hasMany(Infirmier::class, 'nom_Hopital', 'nom');
    }
}