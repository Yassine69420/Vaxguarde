<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Enfant extends Model
{


    public $incrementing = false;

   protected $table = 'enfants'; // Specify the table name

    protected $primaryKey = 'id'; // Specify the primary key field

    public $timestamps = false; // Disable timestamps (created_at, updated_at)

    protected $fillable = [
        'id',
        'nom',
        'prenom',
        'date_naissance',
        'CIN_Parent',
    ];

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'CIN_Parent', 'CIN');
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class, 'ID_enfant', 'id');
    }
}