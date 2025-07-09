<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Consultorio;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Horario::with('doctor', 'consultorio')->get();
        $consultorios = Consultorio::all();
        return view('admin.horarios.index', compact('horarios', 'consultorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        $horarios = Horario::with('doctor', 'consultorio')->get();
        return view('admin.horarios.create', compact('doctores', 'consultorios', 'horarios'));
    }

    public function cargar_datos_consultorio($id)
    {
        try {
            $horarios = Horario::with('doctor', 'consultorio')->where('consultorio_id', $id)->get();
            return view('admin.horarios.cargar_datos_consultorio', compact('horarios'));
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'dia'           => 'required',
            'hora_inicio'   => 'required|date_format:H:i',
            'hora_fin'      => 'required|date_format:H:i|after:hora_inicio',
            'consultorio_id' => 'required|exists:consultorios,id', // Validar que el consultorio exista
        ]);

        // Verificar si el horario ya existe para ese día, rango de horas y consultorio
        $horarioExistente = Horario::where('dia', $request->dia)
            ->where('consultorio_id', $request->consultorio_id) // Filtrar por consultorio
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('hora_inicio', '>=', $request->hora_inicio)
                        ->where('hora_inicio', '<',  $request->hora_fin);
                })
                    ->orWhere(function ($query) use ($request) {
                        $query->where('hora_fin', '>', $request->hora_inicio)
                            ->where('hora_fin', '<=', $request->hora_fin);
                    })
                    ->orWhere(function ($query) use ($request) {
                        $query->where('hora_inicio', '<', $request->hora_inicio)
                            ->where('hora_fin',   '>', $request->hora_fin);
                    });
            })
            ->exists();

        if ($horarioExistente) {
            return redirect()->back()
                ->withInput()
                ->with('mensaje', 'El horario ya existe para el día seleccionado.')
                ->with('icono', 'error');
        }

        // Crear el registro
        Horario::create($request->all());

        return redirect()->route('admin.horarios.index')
            ->with('mensaje', 'Se registró el horario de manera correcta')
            ->with('icono', 'success');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horario = Horario::find($id);
        return view('admin.horarios.show', compact('horario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horario = Horario::find($id);
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        return view('admin.horarios.edit', compact('horario', 'doctores', 'consultorios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $horario = Horario::find($id);

        $request->validate([
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_fin'    => ['required', 'date_format:H:i', 'after:hora_inicio'],

        ]);

        $horario->update($request->only(['hora_inicio', 'hora_fin']));

        return redirect()->route('admin.horarios.index')->with('success', 'Horario actualizado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */


    public function confirmDelete($id)
    {
        $horario = Horario::find($id);
        return view('admin.horarios.delete', compact('horario'));
    }

    public function destroy($id)
    {
        $horario = Horario::find($id);
        $horario->delete();
        return redirect()->route('admin.horarios.index')->with('mensaje', 'Horario eliminado exitosamente.')
            ->with('icono', 'success');
    }
}
