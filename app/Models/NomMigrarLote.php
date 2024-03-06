<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomMigrarLote extends Model
{
    use HasFactory;

    protected $table = 'rrhh.nom_migrarlote';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    public static function saveNomMigrarLote($idMigrarLote, $nameDocument)
    {
        $nuevoMigrarLote = new self();

        $nuevoMigrarLote->idmigrarlote = $idMigrarLote;
        $nuevoMigrarLote->idtiposolicitud = 35;
        $nuevoMigrarLote->nomarchivo = $nameDocument;
        $nuevoMigrarLote->idstatus = 1;
        $nuevoMigrarLote->idusuarioregistro = 606;

        $nuevoMigrarLote->save();

    }
}
