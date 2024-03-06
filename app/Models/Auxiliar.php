<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    use HasFactory;

    protected $table = 'rrhh.auxiliar';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'cedula',
        'codcon',
        'cantidad',
        'monto',
        'fecha',
        'usado'
    ];
}
