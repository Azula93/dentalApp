<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuraciones = Config::all();
        return view('admin.configuraciones.index', compact('configuraciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.configuraciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255 |unique:configs,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $configuracion = new Config();
        $configuracion->nombre = $request->nombre;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->email = $request->email;
        $configuracion->logo = $request->file('logo')->store('logos', 'public');
        $configuracion->save();

        return redirect()
            ->route('admin.configs.index')
            ->with('mensaje', 'Configuración Creada Exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $configuracion = Config::find($id);
        return view('admin.configuraciones.show', compact('configuracion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $configuracion = Config::find($id);
        return view('admin.configuraciones.edit', compact('configuracion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email'     => [
                'required',
                'email',
                'max:255',
                Rule::unique('configs', 'email')->ignore($id),
            ],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $configuracion = Config::find($id);
        $configuracion->nombre = $request->nombre;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->email = $request->email;


        // Verificar si se ha subido un nuevo logo
        if ($request->hasFile('logo')) {
            Storage::delete('public/' . $configuracion->logo); // Eliminar el logo anterior
            $configuracion->logo = $request->file('logo')->store('logos', 'public');
        }

        $configuracion->save();

        return redirect()
            ->route('admin.configs.index')
            ->with('mensaje', 'Configuración Actualizada Exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */


    public function confirmDelete($id)
    {
        $configuracion = Config::find($id);
        return view('admin.configuraciones.delete', compact('configuracion'));
    }

    public function destroy($id)
    {
        $configuracion = Config::find($id);

        Storage::delete('public/' . $configuracion->logo); // Eliminar el logo del almacenamiento
        Config::destroy($id); // Eliminar la configuración de la base de datos

        return redirect()
            ->route('admin.configs.index')
            ->with('mensaje', 'Configuración Eliminada Exitosamente.')
            ->with('icono', 'success');
    }
}
