<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Odontograma;
use Illuminate\Http\Request;

class OdontogramaController extends Controller
{
    public function edit(Paciente $paciente)
    {
        // Carga (o instancia) el odontograma
        $odontograma = $paciente->odontograma
            ?? new Odontograma(['paciente_id' => $paciente->id]);

        // Arrays con los hallazgos guardados
        $inicial = $odontograma->initial  ?? [];
        $final   = $odontograma->final    ?? [];
        $observaciones = $odontograma->observaciones_odontograma ?? '';

        // (Opcional) si prefieres definir aquí las herramientas y cuadrantes,
        // o déjalos en la propia vista Blade.
        $iconMap = [
            'amalgama'             => '🟦',
            'resina'               => '🟩',
            'diente_ausente'       => '|',
            'endodoncia'           => '🔼',
            'corona'               => '🔵',
            'exodoncia'            => '❌',
            'caries'               => '🟥',
            'necesidad_endodoncia' => '🔺',
            'no_erupcionado'       => '➖',
        ];

        return view('admin.pacientes.odontograma', compact(
            'paciente',
            'odontograma',
            'inicial',
            'final',
            'observaciones',
            'iconMap'
        ));
    }


    public function update(Request $request, Paciente $paciente)
    {
        $data = $request->validate([
            'inicial'                    => 'array',
            'final'                      => 'array',
            'observaciones_odontograma'  => 'nullable|string',
        ]);

        // Convertir cada valor coma‑separado en array
        $parsedInicial = [];
        foreach ($data['inicial'] as $diente => $herramientasStr) {
            $parsedInicial[$diente] = $herramientasStr !== ''
                ? explode(',', $herramientasStr)
                : [];
        }

        $parsedFinal = [];
        foreach ($data['final'] as $diente => $herramientasStr) {
            $parsedFinal[$diente] = $herramientasStr !== ''
                ? explode(',', $herramientasStr)
                : [];
        }

        $odontograma = $paciente->odontograma
            ?? new Odontograma(['paciente_id' => $paciente->id]);

        // Ahora asignas arrays de arrays
        $odontograma->initial = $parsedInicial;
        $odontograma->final   = $parsedFinal;
        $odontograma->observaciones_odontograma = $data['observaciones_odontograma'] ?? null;
        $odontograma->save();

        return redirect()->route('admin.pacientes.show', $paciente->id)
            ->with('success', 'Odontograma guardado correctamente.');
    }
}
