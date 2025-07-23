<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Camper extends Model{
    protected $table = 'camper';
    protected $primarykey = 'id';
    public $timestamps = true;
    protected $fillable = ['nombre', 'edad', 'documento', 'tipo_documento', 'nivel_ingles', 'nivel_programacion'];
}