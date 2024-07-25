<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
  use HasFactory;
  protected $table = 'area';
  protected $primaryKey = 'id';
  protected $connection = 'mysql';
  public $timestamps = true;
  public $incrementing = false;


  protected $fillable = [
    'area'
  ];
}
