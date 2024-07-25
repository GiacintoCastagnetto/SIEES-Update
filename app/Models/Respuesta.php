<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    protected $table = 'respuesta';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';
    public $timestamps = true;
    public $incrementing = false;


    protected $fillable = [
        'id_pregunta',
        'respuesta'
    ];
}
