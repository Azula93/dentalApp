<?php

namespace App\Http\Controllers;

use App\Models\Examenendodontico;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ExamenendodonticoController extends Controller
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
     * @param  \App\Models\Examenendodontico  $examenendodontico
     * @return \Illuminate\Http\Response
     */
    public function show(Examenendodontico $examenendodontico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Examenendodontico  $examenendodontico
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        $examenendodontico = $paciente->examenendodonticos ?? $paciente->examenendodonticos()->make();
        return view('admin.pacientes.examenendodontico', compact('examenendodontico', 'paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Examenendodontico  $examenendodontico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $datos = request()->validate([
            'otros_superior' => 'nullable|string',
            'movilidad_superior' => 'nullable|string',
            'palpacion_superior' => 'nullable|string',
            'percusion_superior' => 'nullable|string',
            'fistula_superior' => 'nullable|string',
            'calor_superior' => 'nullable|string',
            'frio_superior' => 'nullable|string',
            'electricidad_superior' => 'nullable|string',
            'color_superior' => 'nullable|string',
            'cavitaria_superior' => 'nullable|string',
            'trauma_superior' => 'nullable|string',
            'pronostico_superior' => 'nullable|string',
            'otros_inferior' => 'nullable|string',
            // INFERIOR
            'movilidad_inferior' => 'nullable|string',
            'palpacion_inferior' => 'nullable|string',
            'percusion_inferior' => 'nullable|string',
            'fistula_inferior' => 'nullable|string',
            'calor_inferior' => 'nullable|string',
            'frio_inferior' => 'nullable|string',
            'electricidad_inferior' => 'nullable|string',
            'color_inferior' => 'nullable|string',
            'cavitaria_inferior' => 'nullable|string',
            'trauma_inferior' => 'nullable|string',
            'pronostico_inferior' => 'nullable|string',
            'fecha' => 'nullable|date',
        ]);

        $paciente->examenendodonticos()->updateOrCreate(
            [],
            $datos
        );

        return redirect()->route('admin.pacientes.show', $paciente)
            ->with('mensaje', 'Examen endodontico actualizado correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Examenendodontico  $examenendodontico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examenendodontico $examenendodontico)
    {
        //
    }
}
