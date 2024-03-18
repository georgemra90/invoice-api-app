<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "tbl_tipo_identificacion";
    protected $primaryKey = "id_tipo_identificacion";

    protected $fillable = [
        "id_tipo_identificacion",
        "nombre",
        "mascara"
    ];

    public function persona() {
        return $this->belongsTo(Persona::class, "id_tipo_identificacion");
    }
}