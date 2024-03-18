<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    // GET - Todos
    public function listar() {
        try {
            $tiposUsuario = TipoUsuario::get();
            return response() -> json($tiposUsuario, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // GET - Consultar ID 
    public function consultar($id) {
        try {
            $tipoUsuario = TipoUsuario::find($id);
            return response() -> json($tipoUsuario, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // POST - Guardar
    public function guardar(Request $request) {
        try {
            $usuario["nombre"] = $request["nombre"];
            $usuario["estado"] = $request["estado"];
            $resultado = TipoUsuario::create($usuario);
            return response() -> json($resultado, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // PUT - Actualizar
    public function actualizar(Request $request) {
        try {
            $usuario["id_usuario"] = $request["id_usuario"];
            $usuario["nombre"] = $request["nombre"];
            $usuario["estado"] = $request["estado"];
            $resultado = TipoUsuario::find($usuario["id_usuario"])->update($usuario);
            return response() -> json($resultado, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // DELETE - Borrar
    public function eliminar($id) {
        try {
            $resultado = TipoUsuario::find($id)->delete();
            return response() -> json($resultado, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }
}
