<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "tbl_marca";
    protected $primaryKey = "id_marca";

    protected $fillable = [
        "id_marca",
        "nombre",
        "estado"
    ];
}
