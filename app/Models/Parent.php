<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    protected $table = 'Parents'; // Specify the table name

    protected $primaryKey = 'CIN'; // Specify the primary key field

    public $timestamps = false; // Disable timestamps (created_at, updated_at)

    protected $fillable = [
        'CIN',
        'nom',
        'prenom',
        'adress',
        'telephone',
        'Email',
        'Region',
        'Pays',
    ];

    public function enfants()
    {
        return $this->hasMany(Enfant::class, 'CIN_Parent', 'CIN');
    }
}