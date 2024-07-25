<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;
    protected $table = 'tema';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';
    public $timestamps = true;
    public $incrementing = false;


    protected $fillable = [
        'id',
        'id_area',
        'tema'
    ];
}
