<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ApiProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Producto::paginate(15), 200);
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
            "nombre" => "required|min:5|max:255",
            "categoria_id" => "required"
        ]);
        //subir imagen ?
        $nombre_imagen = "";
        if($file = $request->file("imagen")){
            $nombre_imagen = time()."-". $file->getClientOriginalName();
            $file->move("imagenes", $nombre_imagen);
        }

        // guardar datos
        $prod = new Producto;
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->cantidad = $request->cantidad;
        $prod->descripcion = $request->descripcion;
        $prod->imagen = $nombre_imagen;
        $prod->categoria_id = $request->categoria_id;
        $prod->save();
        //responder

        return response()->json([
            "mensaje" => "Producto registrado", 
            "producto" => $prod], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = Producto::find($id);
         return response()->json($prod, 200);
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
        // PENDIENTE
        
        // validar
        /*$request->validate([
            "nombre" => "required|min:5|max:255",
            "categoria_id" => "required"
        ]);*/
        
        // guardar datos
        $prod = Producto::find($id);
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->cantidad = $request->cantidad;
        $prod->descripcion = $request->descripcion;
        
        $prod->categoria_id = $request->categoria_id;

        //subir imagen ?
        $nombre_imagen = "";
        if($file = $request->file("imagen")){
            $nombre_imagen = time()."-". $file->getClientOriginalName();
            $file->move("imagenes", $nombre_imagen);
            $prod->imagen = $nombre_imagen;
        }

        $prod->save();
        //responder

        return response()->json([
            "mensaje" => "Producto Modificado", 
            "producto" => $prod], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod =  Producto::find($id);
        $prod->delete();

        return response()->json([
            "mensaje" => "Producto Elimiando"], 200);
    }
}
