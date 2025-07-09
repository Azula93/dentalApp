<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Config;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PhpParser\Comment\Doc;

class EventController extends Controller
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

        $request->validate([

            'doctor_id'     => 'required|exists:doctors,id',
            'fecha_reserva' => 'required|date|after_or_equal:today',
            'hora_reserva' => 'required|date_format:H:i',

        ]);
        $doctor = Doctor::find($request->doctor_id);
        $fecha_reserva = $request->fecha_reserva;
        $hora_reserva = $request->hora_reserva . ':00';

        $dia = date('l', strtotime($fecha_reserva));
        $dia_de_reserva = $this->traducir_dia($dia);

        // Verificar si el horario del doctor existe
        $horarios = Horario::where('doctor_id', $doctor->id)
            ->where('dia', $dia_de_reserva)
            ->where('hora_inicio', '<=', $hora_reserva)
            ->where('hora_fin', '>', $hora_reserva)
            ->exists();

        // Verificar si ya existe un evento en la misma fecha y hora
        if (!$horarios) {
            return redirect()->back()->with([
                'mensaje' => 'El horario seleccionado no está disponible para el doctor.',
                'icono' => 'error',
                'hora_reserva' => 'El horario seleccionado no está disponible para el doctor.',
            ]);
        }

        $fecha_hora_reserva = $fecha_reserva . " " . $hora_reserva;
        //  Verificar si ya existe un evento en la misma fecha y hora
        $eventos_duplicados = Event::where('doctor_id', $doctor->id)
            ->where('start', $fecha_hora_reserva)
            ->exists();

        if ($eventos_duplicados) {

            return redirect()->back()->with([
                'mensaje' => 'Ya existe una cita reservada para este doctor en la fecha y hora seleccionadas.',
                'icono' => 'error',
                'hora_reserva' => 'Ya existe una cita reservada para este doctor en la fecha y hora seleccionadas.',
            ]);
        }


        $evento = new Event();
        $evento->title = $request->hora_reserva . " " . $doctor->especialidad;
        $evento->start = $request->fecha_reserva . " " . $hora_reserva;
        $evento->end = $request->fecha_reserva . " " . $hora_reserva;
        $evento->color = '#3788d8';
        $evento->user_id = Auth::user()->id;
        $evento->doctor_id  = $request->doctor_id;
        $evento->consultorio_id   = '1';
        $evento->save();

        return redirect()
            ->route('admin.index')
            ->with('mensaje', 'Cita reservada correctamente')
            ->with('icono', 'success');
    }

    private function traducir_dia($dia)
    {
        $dias = [
            'Monday' => 'LUNES',
            'Tuesday' => 'MARTES',
            'Wednesday' => 'MIERCOLES',
            'Thursday' => 'JUEVES',
            'Friday' => 'VIERNES',
            'Saturday' => 'SABADO',
            'Sunday' => 'DOMINGO',
        ];
        return $dias[$dia] ?? $dias;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::destroy($id);
        return redirect()->back()->with([
            'mensaje' => 'Reserva eliminada correctamente',
            'icono' => 'success',

        ]);
    }

    public function reportes()
    {
        return view('admin.reservas.reportes');
    }

    public function pdf()
    {
        $configuracion = Config::latest()->first();
        $eventos = Event::all();

        $pdf = \Pdf::loadView('admin.reservas.pdf', compact('configuracion', 'eventos'))
            ->setPaper('A4', 'portrait')
            ->setOptions(['defaultFont' => 'nunito', 'isRemoteEnabled' => true,]);

        // pie de pagina
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->email, null, 10, array(0, 0, 0));
        $canvas->page_text(270, 800, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        $canvas->page_text(400, 800, "Fecha:" . \Carbon\Carbon::now()->format('d/m/Y') . " | " . "Hora: " . \Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0, 0, 0));

        return $pdf->stream();
    }

    public function pdf_fechas(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');

        $eventos = Event::whereBetween('start', [request('fecha_inicio'), request('fecha_fin')])
            ->get();
        $configuracion = Config::latest()->first();
        $pdf = \Pdf::loadView('admin.reservas.pdf_fechas', compact('configuracion', 'eventos', 'fecha_inicio', 'fecha_fin'))
            ->setPaper('A4', 'portrait')
            ->setOptions(['defaultFont' => 'nunito', 'isRemoteEnabled' => true,]);

        // pie de pagina
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->email, null, 10, array(0, 0, 0));
        $canvas->page_text(270, 800, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        $canvas->page_text(400, 800, "Fecha:" . \Carbon\Carbon::now()->format('d/m/Y') . " | " . "Hora: " . \Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0, 0, 0));

        return $pdf->stream();
    }
}
