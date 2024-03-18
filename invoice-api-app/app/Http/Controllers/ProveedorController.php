<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Persona;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    // GET - Listar todos
    public function listar()
    {
        try {
            $proveedores = Proveedor::with('persona')->get();
            foreach ($proveedores as $proveedor) {
                $proveedor["persona"]["tipo_identificacion"] = $proveedor->persona->tipoIdentificacion;
            }
            return response()->json($proveedores, 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()]);
        }
    }

    // GET - Consultar ID
    public function consultar($id)
    {
        try {
            $proveedor = Proveedor::with('persona')->find($id);
            if ($proveedor) {
                $proveedor["persona"]["tipo_identificacion"] = $proveedor->persona->tipoIdentificacion;
                return response()->json($proveedor, 200);
            }
            return response()->json(null, 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()]);
        }
    }

    // POST - Guardar
    public function guardar(Request $request)
    {
        try {
            // Verificar que exista la persona.
            $validarPersona = Persona::firstWhere("identificacion", $request["persona"]["identificacion"]);
            if ($validarPersona == null) {
                // Extraer valores de la persona.
                $persona = $request["persona"];
                $persona["id_persona"] = 0;

                // Crear la persona.
                $resPersona = Persona::create($persona);
                if ($resPersona != null) {
                    // Extraer los valores del proveedor.
                    $proveedor["id_proveedor"] = 0;
                    $proveedor["id_persona"] = $resPersona["id_persona"];
                    $proveedor["estado"] = $request["estado"];

                    $resProveedor = Proveedor::create($proveedor);
                    return response()->json($resProveedor, 200);
                }

                return response()->json(["error" => "No se logró crear el proveedor."], 500);
            } else {
                // Verificar si el proveedor ya existe.
                $validarProveedor = Proveedor::firstWhere("id_persona", $validarPersona["id_persona"]);
                if ($validarProveedor != null) {
                    return response()->json(["error" => "El proveedor ya existe."]);
                }

                // Actualizamos la información de la persona.
                $persona["id_persona"] = $validarPersona["id_persona"];
                $persona["id_tipo_identificacion"] = $request["persona"]["id_tipo_identificacion"];
                $persona["nombre"] = $request["persona"]["nombre"];
                $persona["apellidos"] = $request["persona"]["apellidos"];
                $persona["correo"] = $request["persona"]["correo"];
                $persona["telefono"] = $request["persona"]["telefono"];

                Persona::find($validarPersona["id_persona"])->update($persona);

                // Actualizamos la información del proveedor.
                $proveedor["id_proveedor"] = $request["id_proveedor"];
                $proveedor["id_persona"] = $validarPersona["id_persona"];
                $proveedor["estado"] = $request["estado"];

                $resProveedor = Proveedor::create($proveedor);
                return response()->json($resProveedor, 200);
            }
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()]);
        }
    }

    // PUT - Actualizar
    public function actualizar(Request $request)
    {
        try {
            $validarProveedor = Proveedor::find($request["id_proveedor"]);
            if ($validarProveedor == null) {
                return response()->json(["error" => "No existe un proveedor con ese identificador."], 500);
            }

            // Actualizamos la información de la persona.
            $persona["id_persona"] = $request["id_persona"];
            $persona["id_tipo_identificacion"] = $request["persona"]["id_tipo_identificacion"];
            $persona["nombre"] = $request["persona"]["nombre"];
            $persona["apellidos"] = $request["persona"]["apellidos"];
            $persona["correo"] = $request["persona"]["correo"];
            $persona["telefono"] = $request["persona"]["telefono"];

            Persona::find($request["id_persona"])->update($persona);

            // Actualizamos la información del proveedor.
            $proveedor["id_proveedor"] = $request["id_proveedor"];
            $proveedor["id_persona"] = $validarProveedor["id_persona"];
            $proveedor["estado"] = $request["estado"];

            $resProveedor = Proveedor::find($request["id_proveedor"])->update($proveedor);
            return response()->json($resProveedor, 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()]);
        }
    }

    // DELETE - Eliminar ID
    public function eliminar($id) 
    {
        try {
            return response()->json(Proveedor::find($id)->delete(), 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()]);
        }
    }
}
