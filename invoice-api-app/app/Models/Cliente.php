<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "tbl_cliente";
    protected $primaryKey = "id_cliente";

    protected $fillable = [
        "id_cliente",
        "id_persona",
        "estado"
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, "id_persona", "id_persona");
    }
}
