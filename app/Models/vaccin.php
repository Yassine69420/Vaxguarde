<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class vaccin extends Model
{
    protected $table = 'Vaccins'; // Specify the table name

    protected $primaryKey = 'nom'; // Specify the primary key field

    public $timestamps = false; // Disable timestamps (created_at, updated_at)

    protected $fillable = [
        'nom',
        'status',
        'semaine',
    ];
}