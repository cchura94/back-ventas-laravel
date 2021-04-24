<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ApiClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        if($buscar){
            $clientes = Cliente::where("ci_nit", "like", "%".$buscar."%")->paginate(15);
        }else{
            $clientes = Cliente::paginate(15);
        }
        return response()->json($clientes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombres" => "string|min:2|max:30",
            "apellidos" => "required|string|min:2|max:50",
            "ci_nit" => "required|unique:clientes",
            "correo" => "email"
        ]);

        // guardar
        $clie = new Cliente;
        $clie->nombres = $request->nombres;
        $clie->apellidos = $request->apellidos;
        $clie->ci_nit = $request->ci_nit;
        $clie->telefono = $request->telefono;
        $clie->correo = $request->correo;
        $clie->save();

        return response()->json([
            "mensaje" => "Cliente Registrado", 
            "cliente" => $clie
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clie = Cliente::find($id);
        return response()->json($clie, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validar
        $request->validate([
            "nombres" => "string|min:2|max:30",
            "apellidos" => "required|string|min:2|max:50",
            "ci_nit" => "required",
            "correo" => "email"
        ]);

        // Modificar Cliente
        $clie = Cliente::find($id);
        $clie->nombres = $request->nombres;
        $clie->apellidos = $request->apellidos;
        $clie->ci_nit = $request->ci_nit;
        $clie->telefono = $request->telefono;
        $clie->correo = $request->correo;
        $clie->save();

        return response()->json([
            "mensaje" => "Cliente Modificado", 
            "cliente" => $clie
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clie = Cliente::find($id);
        $clie->delete();

        return response()->json([
            "mensaje" => "Cliente Eliminado"
        ], 200);
    }
}
