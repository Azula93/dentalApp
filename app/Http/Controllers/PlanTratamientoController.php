<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\PlanTratamiento;

class PlanTratamientoController extends Controller
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
    public function create(Paciente $paciente) {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        $plan = $paciente->planTratamiento;

        // 2) Si no existe, inicializa en memoria (no guarda)
        if (! $plan) {
            $plan = new PlanTratamiento([
                'paciente_id'                   => $paciente->id,
                'ortodoncia_correctiva'        => false,
                'compensacion_ortodoncia'      => false,
                'ortopedia_dentofacial'        => false,
                'cirugia_ortognatica'          => false,
                'objetivos'                    => '',
                'exodoncias'                   => '',
                'posibles_exodoncias'          => '',
                'sin_exodoncias'               => '',
                'aparatologia_complementaria'  => '',
                'contencion'                   => '',
            ]);
        }

        // 3) Devuelve la misma vista
        return view('admin.pacientes.plan_tratamiento', compact('paciente', 'plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        // 1) Valida
        $data = $request->validate([
            'ortodoncia_correctiva'        => 'boolean',
            'compensacion_ortodoncia'      => 'boolean',
            'ortopedia_dentofacial'        => 'boolean',
            'cirugia_ortognatica'          => 'boolean',
            'objetivos'                    => 'nullable|string',
            'exodoncias'                   => 'nullable|string',
            'posibles_exodoncias'          => 'nullable|string',
            'sin_exodoncias'               => 'nullable|string',
            'aparatologia_complementaria'  => 'nullable|string',
            'contencion'                   => 'nullable|string',
        ]);

        // 2) Upsert
        $plan = $paciente->planTratamiento;
        if ($plan) {
            $plan->update($data);
        } else {
            $data['paciente_id'] = $paciente->id;
            PlanTratamiento::create($data);
        }

        // 3) Redirige con mensaje
        return redirect()
            ->route('admin.pacientes.show', $paciente)
            ->with('mensaje', 'Plan de tratamiento guardado.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
