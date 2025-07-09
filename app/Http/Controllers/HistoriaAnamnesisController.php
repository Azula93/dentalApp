<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistoriaAnamnesis;
use Illuminate\Http\Request;

class HistoriaAnamnesisController extends Controller
{
    public function edit(Paciente $paciente)
    {
        // Carga la anamnesis existente o crea un nuevo modelo vacío
        $anam = $paciente->anamnesis
            ?? new HistoriaAnamnesis(['paciente_id' => $paciente->id]);

        return view('admin.pacientes.anamnesis', compact('paciente', 'anam'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $data = $request->validate([
            'motivo_consulta'       => 'nullable|string',
            'historia_enfermedad_actual' => 'nullable|string',

        ]);


        // Asegura el paciente_id
        $data['paciente_id'] = $paciente->id;

        HistoriaAnamnesis::updateOrCreate(
            ['paciente_id' => $paciente->id],
            $data
        );

        return redirect()
            ->route('admin.pacientes.index')
            ->with('mensaje', 'Anamnesis guardada correctamente.')
            ->with('icono', 'success');
    }
}
