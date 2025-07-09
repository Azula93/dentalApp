<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistoriaAnamnesis;
use App\Models\AntecedenteMedico;
use Illuminate\Http\Request;

class AntecedentesMedicosController extends Controller
{
    public function edit(Paciente $paciente)
    {
        // Carga la anamnesis existente o crea un nuevo modelo vacío
        $anteMed = $paciente->antecedentesMedicos
            ?? new AntecedenteMedico(['paciente_id' => $paciente->id]);

        // Obtiene el registro existente o crea uno nuevo en memoria
        $anteMed = AntecedenteMedico::firstOrNew([
            'paciente_id' => $paciente->id
        ]);
        $anteMed->load('paciente');
        return view(
            'admin.pacientes.antecedentes_medicos',
            compact('paciente', 'anteMed')
        );

        return view('admin.pacientes.antecedentes_medicos', compact('paciente', 'anteMed'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $data = $request->validate([
            'alergias' => 'nullable|boolean',
            'trastornos_coagulacion' => 'nullable|boolean',
            'enf_respiratorias' => 'nullable|boolean',
            'alteraciones_cardiacas' => 'nullable|boolean',
            'fiebre_reumatica' => 'nullable|boolean',
            'cirugias' => 'nullable|boolean',
            'enf_renal' => 'nullable|boolean',
            'hepatitis' => 'nullable|boolean',
            'trastornos_gastricos' => 'nullable|boolean',
            'hipertension' => 'nullable|boolean',
            'diabetes' => 'nullable|boolean',
            'hospitalizaciones' => 'nullable|boolean',
            'tto_farmacologico_actual' => 'nullable|boolean',
            'tto_medico_actual' => 'nullable|boolean',
            'vih_sida' => 'nullable|boolean',
            'cancer' => 'nullable|boolean',
            'fuma' => 'nullable|boolean',
            'embarazo' => 'nullable|boolean',
            'otra_patologia' => 'nullable|boolean',
            'antecedentes_personales_otro' => 'nullable|string|max:255',
            'fam_cardiovasculares' => 'nullable|boolean',
            'fam_oncologicos' => 'nullable|boolean',
            'fam_endocrinos' => 'nullable|boolean',
            'fam_psiquiatricos' => 'nullable|boolean',
            'fam_hematologicos' => 'nullable|boolean',
            'fam_neurologicos' => 'nullable|boolean',
            'fam_autoinmunes' => 'nullable|boolean',
            'fam_otros' => 'nullable|boolean',
            'antecedentes_familiares_otro' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        // Asegura el paciente_id
        $data['paciente_id'] = $paciente->id;

        AntecedenteMedico::updateOrCreate(
            ['paciente_id' => $paciente->id],
            $data
        );

        return redirect()
            ->route('admin.pacientes.index')
            ->with('mensaje', 'Antecedentes guardados correctamente.')
            ->with('icono', 'success');
    }



    public function updateAntecedentesMedicos(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        $data = $request->validate([
            // Checkbox personales
            'alergias' => 'nullable|boolean',
            'trastornos_coagulacion' => 'nullable|boolean',
            'enf_respiratorias' => 'nullable|boolean',
            'alteraciones_cardiacas' => 'nullable|boolean',
            'fiebre_reumatica' => 'nullable|boolean',
            'cirugias' => 'nullable|boolean',
            'enf_renal' => 'nullable|boolean',
            'hepatitis' => 'nullable|boolean',
            'trastornos_gastricos' => 'nullable|boolean',
            'hipertension' => 'nullable|boolean',
            'diabetes' => 'nullable|boolean',
            'hospitalizaciones' => 'nullable|boolean',
            'tto_farmacologico_actual' => 'nullable|boolean',
            'tto_medico_actual' => 'nullable|boolean',
            'vih_sida' => 'nullable|boolean',
            'cancer' => 'nullable|boolean',
            'fuma' => 'nullable|boolean',
            'embarazo' => 'nullable|boolean',
            'otra_patologia' => 'nullable|boolean',
            // Checkbox familiares
            'fam_cardiovasculares' => 'nullable|boolean',
            'fam_oncologicos' => 'nullable|boolean',
            'fam_endocrinos' => 'nullable|boolean',
            'fam_psiquiatricos' => 'nullable|boolean',
            'fam_hematologicos' => 'nullable|boolean',
            'fam_neurologicos' => 'nullable|boolean',
            'fam_autoinmunes' => 'nullable|boolean',
            'fam_otros' => 'nullable|boolean',
            // Otros campos
            'antecedentes_personales_otro' => 'nullable|string',
            'antecedentes_familiares_otro' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $paciente->antecedentesMedicos()->updateOrCreate(
            ['paciente_id' => $paciente->id],
            $data
        );

        return redirect()
            ->route('admin.pacientes.index', $paciente)
            ->with('mensaje', 'Antecedentes médicos guardados correctamente.')
            ->with('icono', 'success');;
    }
}
