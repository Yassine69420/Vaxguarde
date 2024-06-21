<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Infirmier extends Model
{
    protected $table = 'infirmiers'; // Specify the table name

    protected $primaryKey = 'INP'; // Specify the primary key field

    public $timestamps = false; // Disable timestamps (created_at, updated_at)

    protected $fillable = [
        'INP',
        'CIN',
        'nom',
        'prenom',
        'Ville',
        'date_naissance',
        'nom_Hopital',
        'Email',
        
    ];

    public function hopital()
    {
        return $this->belongsTo(Hopital::class, 'nom_Hopital', 'nom');
    }
}