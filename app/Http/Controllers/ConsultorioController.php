<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;
use App\Models\User;

class ConsultorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultorios = Consultorio::all();
        return view('admin.consultorios.index', compact('consultorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.consultorios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:consultorios',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:consultorios',
            'horario_atencion' => 'required|string|max:255',
            'tipo_consultorio' => 'required|in:privado,publico',
            'especialidad' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1',
            'estado' => 'nullable|in:activo,inactivo',
            'observaciones' => 'nullable|string|max:255',
            'ubicacion' => 'required|string|max:255'
        ]);

        Consultorio::create($request->all());

        return redirect()->route('admin.consultorios.index')
            ->with('mensaje', 'Consultorio creado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consultorio = Consultorio::findOrFail($id);
        return view('admin.consultorios.show', compact('consultorio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consultorio = consultorio::findOrFail($id);
        return view('admin.consultorios.edit', compact('consultorio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $consultorio = Consultorio::find($id);
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255|unique:consultorios,nombre,' . $consultorio->id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:consultorios,email,' . $consultorio->id,
            'horario_atencion' => 'required|string|max:255',
            'tipo_consultorio' => 'required|in:privado,publico',
            'especialidad' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1',
            'estado' => 'nullable|in:activo,inactivo',
            'observaciones' => 'nullable|string|max:255',
            'ubicacion' => 'required|string|max:255'
        ]);


        // Actualizar el consultorio
        $consultorio->update($request->all());
        return redirect()->route('admin.consultorios.index')
            ->with('mensaje', 'Consultorio Actualizado Exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultorio  $consultorio
     * @return \Illuminate\Http\Response
     */


    public function confirmDelete($id)
    {
        $consultorio = consultorio::findOrFail($id);
        return view('admin.consultorios.delete', compact('consultorio'));
    }

    public function destroy($id)
    {
        $consultorio = consultorio::find($id);

        $consultorio->delete();
        // Redirigir a la lista de consultorios con un mensaje de éxito
        return redirect()->route('admin.consultorios.index')->with('mensaje', 'Consultorio Eliminado Exitosamente.')
            ->with('icono', 'success');
    }
}
