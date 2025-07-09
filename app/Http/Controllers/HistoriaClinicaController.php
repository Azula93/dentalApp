<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use Illuminate\Http\Request;
use App\Http\Requests\DatosPersonalesRequest;
use App\Models\Paciente;

class HistoriaClinicaController extends Controller
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
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function show(HistoriaClinica $historiaClinica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoriaClinica $historiaClinica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoriaClinica $historiaClinica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoriaClinica $historiaClinica)
    {
        //
    }


    public function editDatosPersonales(Paciente $paciente)
    {
        return view('admin.historia.datos_personales', compact('paciente'));
    }

    /**
     * Guardar los cambios de Datos Personales
     */
    public function updateDatosPersonales(Request $request, Paciente $paciente)
    {
        // Valida y actualiza solo los campos de datos personales
        $paciente->update($request->validated());

        return redirect()
            ->route('admin.pacientes.historia.datos-personales.edit', $paciente)
            ->with('mensaje', 'Datos personales guardados correctamente.')
            ->with('icono', 'success');
    }
}
