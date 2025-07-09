<?php

namespace App\Http\Controllers;

use App\Models\Control;
use App\Models\Paciente;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Config;
use Carbon\Carbon;



class PacienteControlController extends Controller
{
    public function index()
    {

        $controles = Control::with('paciente', 'doctor')->get();
        return view('admin.pacientes.controles.index_controles', compact('controles'));
    }

    public function create()
    {
        $pacientes = Paciente::orderBy('apellidos', 'asc')->get();
        $doctores  = Doctor::orderBy('nombres')->get();
        return view('admin.pacientes.controles.create_controles', compact('pacientes', 'doctores'));
    }

    public function show($id)
    {
        $control = Control::with('paciente', 'doctor')->findOrFail($id);
        return view('admin.pacientes.controles.show_controles', compact('control'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /* ───── 1. reglas de validación ───── */
        $rules = [
            'paciente_id'     => 'required|exists:pacientes,id',
            'detalle'         => 'required|string',
            'fecha_consulta'  => 'required|date',
        ];

        // si NO es doctor (admin o secretaria), exigimos doctor_id del formulario
        if (! Auth::user()->doctor) {
            $rules['doctor_id'] = 'required|exists:doctors,id';
        }

        $data = $request->validate($rules);

        /* ───── 2. crear historial ───── */
        $control = new Control($data);

        // si es doctor logueado, usar su propio id
        if (Auth::user()->doctor) {
            $control->doctor_id = Auth::user()->doctor->id;
        }

        $control->save();

        /* ───── 3. redirigir ───── */
        return redirect()
            ->route('admin.pacientes.controles.index_controles')
            ->with('mensaje', 'Control registrado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Control  $control
     * @return \Illuminate\Http\Response
     */
    public function edit(Control $control)
    {
        $doctores  = Doctor::orderBy('apellidos')->get();
        $pacientes = Paciente::orderBy('nombres')->get();
        return view('admin.pacientes.controles.edit_controles', compact('control', 'pacientes', 'doctores'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Control  $control
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Control $control)
    {


        $rules = [
            'paciente_id'    => 'required|exists:pacientes,id',
            'fecha_consulta' => 'required|date',
            'detalle'        => 'required|string',
        ];

        if (! Auth::user()->doctor) {
            $rules['doctor_id'] = 'required|exists:doctors,id';
        }

        $data = $request->validate($rules);

        // Si es doctor logueado, fuerza su propio id
        if (Auth::user()->doctor) {
            $data['doctor_id'] = Auth::user()->doctor->id;
        }

        $control->fill($data)->save();

        return redirect()
            ->route('admin.pacientes.controles.index_controles')
            ->with('mensaje', 'Control actualizado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Control  $control
     * @return \Illuminate\Http\Response
     */


    public function confirmDelete($id)
    {
        $control = Control::findOrFail($id);
        return view('admin.pacientes.controles.delete_controles', compact('control'));
    }

    public function destroy($id)
    {
        $control = Control::find($id);

        $control->delete();
        // Redirigir a la lista de pacientes con un mensaje de éxito
        return redirect()->route('admin.pacientes.controles.index_controles')
            ->with('mensaje', 'Registro de control eliminado exitosamente.')
            ->with('icono', 'success');
    }


    public function pdf($id)
    {
        $configuracion = Config::latest()->first();
        $control = Control::findOrFail($id);

        $pdf = PDF::loadView('admin.pacientes.controles.pdf_controles', compact('control', 'configuracion'));

        // // Establecer zona horaria correcta
        date_default_timezone_set('America/Bogota');
        $fechaHora = Carbon::now()->format('d/m/Y H:i');

        // // pie de pagina
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(30, 800, "Generado por: " . Auth::user()->email, null, 9, [0, 0, 0]);
        $canvas->page_text(250, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, [0, 0, 0]);
        $canvas->page_text(420, 800, "Fecha: {$fechaHora}", null, 9, [0, 0, 0]);

        return $pdf->stream("control_{$control->id}.pdf");
    }
}
