<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\Valoracion;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Config;
use App\Models\AntecedenteMedico;
use App\Models\Control;
use Illuminate\Support\Str;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('admin.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            // 'numero_historia' => 'nullable|string|max:20|unique:pacientes',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'di' => 'required|string|max:10',
            'edad' => 'required|integer|min:0|max:120',
            'fecha_nacimiento' => 'required|date',
            'estado_civil' => 'nullable|in:soltero,casado,union libre,divorciado,viudo',
            'sexo' => 'required|in:M,F',
            'ocupacion' => 'nullable|string|max:100',
            'direccion_residencia' => 'required|string|max:255',

            'celular' => 'required|string|max:20',
            'email'    => 'required|string|email|max:100|unique:pacientes,email',
            'acudiente' => 'nullable|string|max:100',
            'parentesco' => 'nullable|string|max:50',
            'ocupacion_acudiente' => 'nullable|string|max:100',
            'correo_acudiente' => 'nullable|email|max:120',
            'celular_acudiente' => 'nullable|string|max:20',
            'eps' => 'required|string|max:100',
            'tipo_vinculacion' => 'nullable|string|max:100',
            'servicio_urgencias' => 'nullable|string|max:100',
            'ultima_visita_odontologo' => 'nullable|date',
            'ultimo_tratamiento' => 'nullable|string|max:255',
            'como_se_entero' => 'nullable|string|max:255',
            'tipo_sangre' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
        ]);

        // Crear el paciente
        $paciente = new Paciente();
        // $paciente->numero_historia = $request->numero_historia;
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->di = $request->di;
        $paciente->edad = $request->edad;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->estado_civil = $request->estado_civil;
        $paciente->sexo = $request->sexo;
        $paciente->ocupacion = $request->ocupacion;
        $paciente->direccion_residencia = $request->direccion_residencia;

        $paciente->celular = $request->celular;
        $paciente->email = $request->email;
        $paciente->acudiente = $request->acudiente;
        $paciente->parentesco = $request->parentesco;
        $paciente->ocupacion_acudiente = $request->ocupacion_acudiente;
        $paciente->correo_acudiente = $request->correo_acudiente;
        $paciente->celular_acudiente = $request->celular_acudiente;
        $paciente->eps = $request->eps;
        $paciente->tipo_vinculacion = $request->tipo_vinculacion;
        $paciente->servicio_urgencias = $request->servicio_urgencias;
        $paciente->ultima_visita_odontologo = $request->ultima_visita_odontologo;
        $paciente->ultimo_tratamiento = $request->ultimo_tratamiento;
        $paciente->como_se_entero = $request->como_se_entero;
        $paciente->tipo_sangre = $request->tipo_sangre;
        $paciente->save();



        return redirect()
            ->route('admin.pacientes.index', $paciente)
            ->with('mensaje', 'Paciente Registrado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show($id, Control $controles, Paciente $paciente)
    {
        $paciente = Paciente::with([
            'anamnesis',
            'antecedentesMedicos',
            'odontograma',
            'valoracion',
            'diagnosticoHcs',
            'examenendodonticos',
            'examenperiodontals',
            'odontograma',

        ])->findOrFail($id);

        // trae todos los controles de ese paciente con su doctor
        $controles = $paciente->controles()->with('doctor')->get();
        $paciente->load('examenendodonticos');

        $odontograma = $paciente->odontograma;
        $inicial = $odontograma->initial  ?? [];
        $final   = $odontograma->final    ?? [];
        $observaciones = $odontograma->observaciones_odontograma ?? '';

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

        return view('admin.pacientes.show', compact('paciente', 'controles', 'inicial', 'final', 'observaciones', 'iconMap'))
            ->with('icono', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $paciente = Paciente::findOrFail($id);
        $valoracion = $paciente->valoracion;
        $anamnesis = $paciente->valoracion ?? new Valoracion(['paciente_id' => $paciente->id]);
        return view('admin.pacientes.edit', compact('paciente', 'valoracion', 'anamnesis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);
        // Capturamos el id para la regla “unique”
        $id = $paciente->id;

        // Validar los datos de entrada
        $request->validate([
            // 'numero_historia' => 'nullable|string|max:20|unique:pacientes',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'di' => 'required|string|max:10',
            'edad' => 'required|integer|min:0|max:120',
            'fecha_nacimiento' => 'required|date',
            'estado_civil' => 'nullable|in:soltero,casado,union libre,divorciado,viudo',
            'sexo' => 'required|in:M,F',
            'ocupacion' => 'nullable|string|max:100',
            'direccion_residencia' => 'required|string|max:255',

            'celular' => 'required|string|max:20',
            'email' => "required|string|email|max:100|unique:pacientes,email,{$id}",
            'acudiente' => 'nullable|string|max:100',
            'parentesco' => 'nullable|string|max:50',
            'ocupacion_acudiente' => 'nullable|string|max:100',
            'correo_acudiente' => 'nullable|string|max:20',
            'celular_acudiente' => 'nullable|string|max:20',
            'eps' => 'required|string|max:100',
            'tipo_vinculacion' => 'nullable|string|max:100',
            'servicio_urgencias' => 'nullable|string|max:100',
            'ultima_visita_odontologo' => 'nullable|date',
            'ultimo_tratamiento' => 'nullable|string|max:255',
            'como_se_entero' => 'nullable|string|max:255',
            'tipo_sangre' => 'required|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'historia_enfermedad_actual' => 'nullable|string'
        ]);

        // Actualizar los datos del paciente
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->di = $request->di;
        $paciente->edad = $request->edad;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->estado_civil = $request->estado_civil;
        $paciente->sexo = $request->sexo;
        $paciente->ocupacion = $request->ocupacion;
        $paciente->direccion_residencia = $request->direccion_residencia;

        $paciente->celular = $request->celular;
        $paciente->email = $request->email;
        $paciente->acudiente = $request->acudiente;
        $paciente->parentesco = $request->parentesco;
        $paciente->ocupacion_acudiente = $request->ocupacion_acudiente;
        $paciente->correo_acudiente = $request->correo_acudiente;
        $paciente->celular_acudiente = $request->celular_acudiente;
        $paciente->eps = $request->eps;
        $paciente->tipo_vinculacion = $request->tipo_vinculacion;
        $paciente->servicio_urgencias = $request->servicio_urgencias;
        $paciente->ultima_visita_odontologo = $request->ultima_visita_odontologo;
        $paciente->ultimo_tratamiento = $request->ultimo_tratamiento;
        $paciente->como_se_entero = $request->como_se_entero;
        $paciente->tipo_sangre = $request->tipo_sangre;
        $paciente->save();
        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', 'Datos Paciente Actualizados Exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */


    public function confirmDelete($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('admin.pacientes.delete', compact('paciente'));
    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id);

        $paciente->delete();
        // Redirigir a la lista de pacientes con un mensaje de éxito
        return redirect()->route('admin.pacientes.index')->with('mensaje', 'Paciente Eliminado Exitosamente.')
            ->with('icono', 'success');
    }

    // Métodos para manejar la anamnesis del paciente
    public function editAnamnesis($id)
    {
        $paciente = Paciente::findOrFail($id);
        $anamnesis = $paciente->anamnesis ?? new \App\Models\Anamnesis(['paciente_id' => $paciente->id]);

        return view('admin.pacientes.anamnesis_edit', compact('paciente', 'anamnesis'));
    }

    public function updateAnamnesis(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        $data = $request->validate([
            'motivo_consulta' => 'nullable|string',
            'historia_enfermedad_actual' => 'nullable|string',
            // Otros campos si necesitas
        ]);

        $paciente->anamnesis()->updateOrCreate(
            ['paciente_id' => $paciente->id],
            $data
        );

        return redirect()
            ->route('admin.pacientes.index', $paciente)
            ->with('mensaje', 'Anamnesis Creada Exitosamente.')
            ->with('icono', 'success');
    }

    public function pdf(Paciente $paciente)
    {
        // Cargar relaciones
        $paciente->load([
            'valoracion',
            'anamnesis',
            'antecedentesMedicos',
            'odontograma',
            'diagnosticoHcs',
            'controles.doctor',
            'examenendodonticos',
            'examenperiodontals',
        ]);

        $configuracion = Config::first();
        $examen = $paciente->examenendodonticos;
        $examenPeriodontal = $paciente->examenperiodontals;
        // Establecer zona horaria correcta
        date_default_timezone_set('America/Bogota');
        $fechaHora = Carbon::now()->format('d/m/Y H:i');

        // Generar PDF
        $pdf = Pdf::loadView('admin.pacientes.pdf', compact('paciente', 'configuracion', 'examen', 'fechaHora', 'examenPeriodontal'))
            ->setPaper('A4', 'portrait')
            ->setOptions(['defaultFont' => 'times', 'isRemoteEnabled' => true]);

        // Renderizar PDF primero
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();

        // Añadir pie de página en todas las páginas
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(30, 800, "Generado por: " . Auth::user()->email, null, 9, [0, 0, 0]);
        $canvas->page_text(250, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, [0, 0, 0]);
        $canvas->page_text(420, 800, "Fecha: {$fechaHora}", null, 9, [0, 0, 0]);

        return $pdf->stream('paciente_' . $paciente->id . '.pdf');
    }

    public function buscar_paciente(Request $request)
    {
        $di = $request->di;
        $paciente = Paciente::where('di', $di)->first();
        return view('admin.pacientes.buscar_paciente', compact('paciente'))
            ->with('icono', 'success');
    }

    public function imprimir_hc(Paciente $paciente)
    {
        $configuracion = Config::latest()->first();
        // Establecer zona horaria correcta
        date_default_timezone_set('America/Bogota');
        $fechaHora = Carbon::now()->format('d/m/Y H:i');
        // Carga tu vista Blade que arma el historial clínico
        $pdf = Pdf::loadView(
            'admin.pacientes.imprimir_hc',
            compact('paciente', 'configuracion', 'fechaHora')
        );


        // Puedes concatenar nombres y apellidos:
        $nombreArchivo = 'historia_clinica_'
            . Str::slug($paciente->di)
            . '.pdf';

        // Renderizar PDF primero para obtener el DomPDF
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();

        // Añadir pie de página en todas las páginas
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(30, 800, "Generado por: " . Auth::user()->email, null, 9, [0, 0, 0]);
        $canvas->page_text(250, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, [0, 0, 0]);
        $canvas->page_text(420, 800, "Fecha: {$fechaHora}", null, 9, [0, 0, 0]);

        return $pdf->stream($nombreArchivo);
    }
}
