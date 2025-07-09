<?php

namespace App\Http\Controllers;

use App\Models\Examenperiodontal;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ExamenperiodontalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Examenperiodontal  $examenperiodontal
     * @return \Illuminate\Http\Response
     */
    public function show(Examenperiodontal $examenperiodontal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Examenperiodontal  $examenperiodontal
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        $examenenperiodontal = $paciente->examenenperiodontals ?? $paciente->examenenperiodontals()->make();
        return view('admin.pacientes.examenenperiodontal', compact('examenenperiodontal', 'paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Examenperiodontal  $examenperiodontal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $datos = request()->validate([
            'otros' => 'nullable|string',
            'calculos_superior' => 'nullable|string',
            'sensibilidad_superior' => 'nullable|string',
            'trauma_superior' => 'nullable|string',
            'furca_superior' => 'nullable|string',
            'bolsa_superior' => 'nullable|string',
            'movilidad_superior' => 'nullable|string',
            'exudado_superior' => 'nullable|string',
            'hemorragia_superior' => 'nullable|string',
            'agrandamientoG_superior' => 'nullable|string',
            'retraccion_superior' => 'nullable|string',
            'biotipo_superior' => 'nullable|string',
            'pronostico_superior' => 'nullable|string',

            'otros_inferior' => 'nullable|string',
            'calculos_inferior' => 'nullable|string',
            'sensibilidad_inferior' => 'nullable|string',
            'trauma_inferior' => 'nullable|string',
            'furca_inferior' => 'nullable|string',
            'bolsa_inferior' => 'nullable|string',
            'movilidad_inferior' => 'nullable|string',
            'exudado_inferior' => 'nullable|string',
            'hemorragia_inferior' => 'nullable|string',
            'agrandamientoG_inferior' => 'nullable|string',
            'retraccion_inferior' => 'nullable|string',
            'biotipo_inferior' => 'nullable|string',
            'pronostico_inferior' => 'nullable|string',

        ]);

        $paciente->examenperiodontals()->updateOrCreate(
            [],
            $datos
        );

        return redirect()->route('admin.pacientes.show', $paciente)
            ->with('mensaje', 'Examen periodontal creado correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Examenperiodontal  $examenperiodontal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examenperiodontal $examenperiodontal)
    {
        //
    }
}
