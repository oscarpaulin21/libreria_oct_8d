<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Usar el modelo
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     *Mostrar informacion de la base de datos en una vista.
     */
    public function index()
    {
        //Obtener toda la informacion de la base de datos utilizando el modelo
        $libros = Libro::all();
        return view('libros.index', compact('libros'));
    }
    
    /**
     *Funcion insertar
     */
    public function create()
    {
        return view('libros.create');
    }

    /**
     *Guardar informacion en la base de datos.
     */
    public function store(Request $request)
    {
        //Utilizamos el modelo para insertar la informacion en la base de datos
        //<nombre formulario> => $request-><NombreBD>
        Libro::create([
            'nombre' => $request->nombre,
            'autor' => $request->autor,
            'editorial' => $request->editorial,
            'precio' => $request->precio
        ]);

        //Redireccionamos al usuario al formulario de creacion
        return redirect()->route('libros.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Editar registro
     */
    public function edit(Libro $libro)
    {
        //regersar datos de libro
        return view('libros.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        //creal la validación para el formulario
        $request->validate([
            'nombre' => 'required',
            'autor' => 'required',
            'editorial' => 'required',
            'precio' => 'required'
        ]);

        //indicar la actualizaciuon de todos los campos
        $libro->update($request->all());

        //Redireccionar al usuario al index y enviar un mensaje
        return redirect()->route('libros.index')
        ->with('success', 'Libro actualizado correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(libro $libro)
    {
        //Funcion para eliminar registro
        $libro->delete();

        return redirect()->route('libros.index')
        ->with('success', 'Libro eliminado correctamente');

    }
}