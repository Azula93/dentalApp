<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\DiagnosticoHc;
use Illuminate\Http\Request;

class DiagnosticoHcController extends Controller
{
    protected $procedimientos = [
        'Oseo',
        'Dental',
        'Periodoncia',
        'DCM',
        'Miofuncional',
        'Implantológico',
        'Tejidos Blandos',
        'Endodóntico',
        'Rehabilitación Oral',
    ];

    public function edit(Paciente $paciente)
    {
        // 1) Trae todos los DiagnosticoHc ya guardados
        $paciente->load('diagnosticoHcs');

        // 2) Para cada procedimiento fijo, busca o crea uno en memoria
        $rows = collect();
        foreach ($this->procedimientos as $proc) {
            // intenta encontrar uno ya guardado
            $diag = $paciente->diagnosticoHcs
                ->firstWhere('procedimiento', $proc);

            if (! $diag) {
                // si no existe, crea un modelo en memoria (no persiste)
                $diag = new DiagnosticoHc([
                    'paciente_id'   => $paciente->id,
                    'procedimiento' => $proc,
                    'diagnostico'   => '',
                    'solucion'      => '',
                ]);
            }

            $rows->push($diag);
        }

        // 3) pásalo al view como 'diagnosticos'
        return view('admin.pacientes.diagnostico-hc', [
            'paciente'     => $paciente,
            'diagnosticos' => $rows,
        ]);
    }

    public function update(Request $request, Paciente $paciente)
    {
        $data = $request->validate([
            'diagnosticos'             => 'required|array',
            'diagnosticos.*.procedimiento' => 'required|string',
            'diagnosticos.*.diagnostico'   => 'nullable|string',
            'diagnosticos.*.solucion'      => 'nullable|string',
            'diagnosticos.*.id'            => 'nullable|exists:diagnostico_hc,id',
        ]);

        foreach ($data['diagnosticos'] as $item) {
            // si viene un ID, actualiza; si no, crea nuevo
            if (!empty($item['id'])) {
                DiagnosticoHc::find($item['id'])->update([
                    'diagnostico' => $item['diagnostico'],
                    'solucion'    => $item['solucion'],
                ]);
            } else {
                $paciente->diagnosticoHcs()->create([
                    'procedimiento' => $item['procedimiento'],
                    'diagnostico'   => $item['diagnostico'],
                    'solucion'      => $item['solucion'],
                ]);
            }
        }

        return redirect()
            ->route('admin.pacientes.show', $paciente)
            ->with('mensaje', 'Diagnósticos guardados correctamente.')
            ->with('icono', 'success');
    }
}
