<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $table = 'Vaccinations'; // Specify the table name

    public $timestamps = false; // Disable timestamps (created_at, updated_at)

    protected $fillable = [
        'Date',
        'Lieu',
        'ID_enfant',
        'type_vaccination',
    ];

    public function enfant()
    {
        return $this->belongsTo(Enfant::class, 'ID_enfant', 'ID');
    }
}