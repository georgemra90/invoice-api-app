<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tbl_producto";
    protected $primaryKey = "id_producto";

    protected $fillable = [
        "id_producto",
        "id_tipo_identificacion",
        "id_marca",
        "codigo",
        "nombre",
        "cantidad",
        "precio_venta",
        "descripcion",
        "estado"
    ];

    public function proveedor ()
    {
        return $this->belongsTo(Proveedor::class, "id_proveedor", "id_proveedor");
    }

    public function marca ()
    {
        return $this->belongsTo(Marca::class, "id_marca", "id_marca");
    }
}
