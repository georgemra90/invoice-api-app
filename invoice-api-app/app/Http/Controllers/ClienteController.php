<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Persona;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // GET - Todos.
    public function listar()
    {
        try {
            $clientes = Cliente::with('persona')->get();
            foreach ($clientes as $cliente) {
                $cliente["persona"]["tipo_identificacion"] = $cliente->persona->tipoIdentificacion;
            }
            return response()->json($clientes, 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()], 500);
        }
    }

    // GET - Consultar ID
    public function consultar($id)
    {
        try {
            $cliente = Cliente::with('persona')->find($id);
            if ($cliente != null) {
                $cliente["persona"]["tipo_identificacion"] = $cliente->persona->tipoIdentificacion;
                return response()->json($cliente, 200);
            }
            return response()->json(null, 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()], 500);
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
                    // Extraer los valores del cliente.
                    $cliente["id_cliente"] = $request["id_cliente"];
                    $cliente["id_persona"] = $resPersona["id_persona"];
                    $cliente["estado"] = $request["estado"];

                    $resCliente = Cliente::create($cliente);
                    return response()->json($resCliente, 200);
                }

                return response()->json(["error" => "No se logró crear el cliente."], 500);
            } else {
                // Verificar si el cliente ya existe.
                $validarCliente = Cliente::firstWhere("id_persona", $validarPersona["id_persona"]);
                if ($validarCliente != null) {
                    return response()->json(["error" => "El cliente ya existe."]);
                }

                // Actualizamos la información de la persona.
                $persona["id_persona"] = $validarPersona["id_persona"];
                $persona["id_tipo_identificacion"] = $request["persona"]["id_tipo_identificacion"];
                $persona["nombre"] = $request["persona"]["nombre"];
                $persona["apellidos"] = $request["persona"]["apellidos"];
                $persona["correo"] = $request["persona"]["correo"];
                $persona["telefono"] = $request["persona"]["telefono"];

                Persona::find($validarPersona["id_persona"])->update($persona);

                // Actualizamos la información del cliente.
                $cliente["id_cliente"] = $request["id_cliente"];
                $cliente["id_persona"] = $validarPersona["id_persona"];
                $cliente["estado"] = $request["estado"];

                $resCliente = Cliente::create($cliente);
                return response()->json($resCliente, 200);
            }
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()], 500);
        }
    }

    // PUT - Actualizar
    public function actualizar(Request $request)
    {
        try {
            $validarCliente = Cliente::find($request["id_cliente"]);
            if ($validarCliente == null) {
                return response()->json(["error" => "No existe un cliente con ese identificador."], 500);
            }

            // Actualizamos la información de la persona.
            $persona["id_persona"] = $request["id_persona"];
            $persona["id_tipo_identificacion"] = $request["persona"]["id_tipo_identificacion"];
            $persona["nombre"] = $request["persona"]["nombre"];
            $persona["apellidos"] = $request["persona"]["apellidos"];
            $persona["correo"] = $request["persona"]["correo"];
            $persona["telefono"] = $request["persona"]["telefono"];

            Persona::find($request["id_persona"])->update($persona);

            // Actualizamos la información del cliente.
            $cliente["id_cliente"] = $request["id_cliente"];
            $cliente["id_persona"] = $request["id_persona"];
            $cliente["estado"] = $request["estado"];

            $resCliente = Cliente::find($request["id_cliente"])->update($cliente);
            return response()->json($resCliente, 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()], 500);
        }
    }

    // DELETE - Eliminar ID
    public function eliminar($id)
    {
        try {
            return response()->json(Cliente::find($id)->delete(), 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()], 500);
        }
    }
}
