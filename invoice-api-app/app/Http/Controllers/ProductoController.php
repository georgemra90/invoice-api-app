<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;



class ProductoController extends Controller
{
    // Listar todos los productos
    public function listar()
    {
        try {
            $productos = Producto::all();
            return response()->json($productos, 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()], 500);
        }
    }

    // Consultar producto por ID
    public function consultar($id)
    {
        try {
            $producto = Producto::find($id);
            if (!$producto) {
                return response()->json(["error" => "Producto no encontrado"], 404);
            }
            return response()->json($producto, 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()], 500);
        }
    }

    // Guardar un nuevo producto
    public function guardar(Request $request)
    {
        try {
            $producto = Producto::create($request->all());
            return response()->json($producto, 201);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()], 500);
        }
    }

    // Actualizar un producto existente
    public function actualizar(Request $request)
    {
        try {
            $id = $request->input('id_producto');
            $producto = Producto::find($id);
            if (!$producto) {
                return response()->json(["error" => "Producto no encontrado"], 404);
            }
            $producto->update($request->all());
            return response()->json($producto, 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()], 500);
        }
    }

    // Eliminar un producto
    public function eliminar($id)
    {
        try {
            $producto = Producto::find($id);
            if (!$producto) {
                return response()->json(["error" => "Producto no encontrado"], 404);
            }
            $producto->delete();
            return response()->json(["message" => "Producto eliminado correctamente"], 200);
        } catch (\Throwable $ex) {
            return response()->json(["error" => $ex->getMessage()], 500);
        }
    }
}
