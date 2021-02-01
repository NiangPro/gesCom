<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employed extends Model
{
    use HasFactory;

    protected $table = "employeds";

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'tel',
        'fonction',
        'adresse'
    ];
}
