<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    // GET - Todos
    public function listar() {
        try {
            $marcas = Marca::get();
            return response() -> json($marcas, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // GET - Consultar ID 
    public function consultar($id) {
        try {
            $marca = Marca::find($id);
            return response() -> json($marca, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // POST - Guardar
    public function guardar(Request $request) {
        try {
            $marca["nombre"] = $request["nombre"];
            $marca["estado"] = $request["estado"];
            $resultado = Marca::create($marca);
            return response() -> json($resultado, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // PUT - Actualizar
    public function actualizar(Request $request) {
        try {
            $marca["id_marca"] = $request["id_marca"];
            $marca["nombre"] = $request["nombre"];
            $marca["estado"] = $request["estado"];
            $resultado = Marca::find($marca["id_marca"])->update($marca);
            return response() -> json($resultado, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }

    // DELETE - Borrar
    public function eliminar($id) {
        try {
            $resultado = Marca::find($id)->delete();
            return response() -> json($resultado, 200);
        } catch (\Throwable $ex) {
            return response() -> json(["error" => $ex->getMessage()], 500); 
        }
    }
}
