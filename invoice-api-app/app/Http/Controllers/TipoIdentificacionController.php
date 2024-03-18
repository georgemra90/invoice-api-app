<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoIdentificacion;
use Illuminate\Http\Request;

class TipoIdentificacionController extends Controller
{
    // GET - Todos
    public function listar() {
        try {
            $tiposIdentificacion = TipoIdentificacion::get();
            return response() -> json($tiposIdentificacion, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // GET - Consultar ID 
    public function consultar($id) {
        try {
            $tipoIdentificacion = TipoIdentificacion::find($id);
            return response() -> json($tipoIdentificacion, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // POST - Guardar
    public function guardar(Request $request) {
        try {
            $tipo["nombre"] = $request["nombre"];
            $tipo["mascara"] = $request["mascara"];
            $resultado = TipoIdentificacion::create($tipo);
            return response() -> json($resultado, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // PUT - Actualizar
    public function actualizar(Request $request) {
        try {
            $tipo["id_tipo_identificacion"] = $request["id_tipo_identificacion"];
            $tipo["nombre"] = $request["nombre"];
            $tipo["mascara"] = $request["mascara"];
            $resultado = TipoIdentificacion::find($tipo["id_tipo_identificacion"])->update($tipo);
            return response() -> json($resultado, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // DELETE - Borrar
    public function eliminar($id) {
        try {
            $resultado = TipoIdentificacion::find($id)->delete();
            return response() -> json($resultado, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }
}
