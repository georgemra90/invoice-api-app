<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_persona";
    protected $primaryKey = "id_persona";

    protected $fillable = [
        "id_persona",
        "id_tipo_identificacion",
        "identificacion",
        "nombre",
        "apellidos",
        "correo",
        "telefono"
    ];

    public function tipoIdentificacion() {
        return $this->hasOne(TipoIdentificacion::class, "id_tipo_identificacion");
    }
}
