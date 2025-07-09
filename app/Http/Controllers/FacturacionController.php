<?php

namespace App\Http\Controllers;

use App\Models\Facturacion;
use App\Models\Paciente;
use App\Models\Config;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FacturacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas = Facturacion::all();
        return view('admin.facturacion.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pacientes = Paciente::orderBy('apellidos', 'asc')->get();
        return view('admin.facturacion.create', compact('pacientes'));
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
            'paciente_id' => 'required|exists:pacientes,id',
            'control_id' => 'nullable|exists:controles,id',
            'fecha_emision' => 'required|date',
            'fecha_pago' => 'required|date',
            'subtotal' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0',
            'impuesto' => 'nullable|numeric|min:0',
            'monto' => 'required|numeric|min:0',
            'estado' => 'nullable|in:pendiente,pagado,anulado',
            'metodo_pago' => 'required|string|max:50',
            'referencia_pago' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $factura = new Facturacion();
        $factura->paciente_id = $request->paciente_id;
        $factura->control_id = $request->control_id;
        $factura->fecha_emision = $request->fecha_emision;
        $factura->fecha_pago = $request->fecha_pago;
        $factura->subtotal = $request->subtotal;
        $factura->descuento = $request->descuento ?? 0;
        $factura->impuesto = $request->impuesto ?? 0;
        $factura->monto = $request->monto;
        $factura->metodo_pago = $request->metodo_pago;
        $factura->referencia_pago = $request->referencia_pago;
        $factura->descripcion = $request->descripcion;
        $factura->estado = $request->estado ?? 'pagado'; // por defecto 'pagado'

        $factura->save();

        return redirect()
            ->route('admin.facturacion.index')
            ->with('mensaje', 'Factura generada exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facturacion  $facturacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factura = Facturacion::findOrFail($id);
        return view('admin.facturacion.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facturacion  $facturacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $factura = Facturacion::findOrFail($id);
        $pacientes = Paciente::orderBy('apellidos', 'asc')->get();
        return view('admin.facturacion.edit', compact('factura', 'pacientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facturacion  $facturacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'control_id' => 'nullable|exists:controles,id',
            'fecha_emision' => 'required|date',
            'fecha_pago' => 'required|date',
            'subtotal' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0',
            'impuesto' => 'nullable|numeric|min:0',
            'monto' => 'required|numeric|min:0',
            'estado' => 'nullable|in:pendiente,pagado,anulado',
            'metodo_pago' => 'required|string|max:50',
            'referencia_pago' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $factura = Facturacion::findOrFail($id);
        $factura->paciente_id = $request->paciente_id;
        $factura->control_id = $request->control_id;
        $factura->fecha_emision = $request->fecha_emision;
        $factura->fecha_pago = $request->fecha_pago;
        $factura->subtotal = $request->subtotal;
        $factura->descuento = $request->descuento ?? 0;
        $factura->impuesto = $request->impuesto ?? 0;
        $factura->monto = $request->monto;
        $factura->metodo_pago = $request->metodo_pago;
        $factura->referencia_pago = $request->referencia_pago;
        $factura->descripcion = $request->descripcion;
        $factura->estado = $request->estado ?? 'pagado'; // por defecto 'pagado'

        $factura->save();

        return redirect()
            ->route('admin.facturacion.index')
            ->with('mensaje', 'Factura actualizada exitosamente.')
            ->with('icono', 'success');
    }

    public function pdf($id)
    {
        $config = Config::latest()->first();
        $factura = Facturacion::findOrFail($id);
        // $factura->load(['paciente']); // lo que necesites

        $data = "Se generó el recibo de pago para el paciente: {$factura->paciente->nombres} {$factura->paciente->apellidos}, fecha: {$factura->fecha_emision} con el monto total de: {$factura->monto}.";

        // Generar código QR
        $qrCode = new QrCode($data);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $qrCodeBase64 = base64_encode($result->getString());


        $fechaHora = Carbon::now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('admin.facturacion.pdf', compact('factura', 'config', 'fechaHora', 'qrCodeBase64'))
            ->setPaper('A4', 'portrait')
            ->setOptions(['defaultFont' => 'times', 'isRemoteEnabled' => true]);

        // pie de página…
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(30, 800, "Generado por: " . Auth::user()->email, null, 9, [0, 0, 0]);
        $canvas->page_text(250, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, [0, 0, 0]);
        $canvas->page_text(420, 800, "Fecha: {$fechaHora}", null, 9, [0, 0, 0]);

        return $pdf->stream("factura_{$factura->numero_recibo}.pdf");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facturacion  $facturacion
     * @return \Illuminate\Http\Response
     */

    public function confirmDelete($id)
    {
        $factura = Facturacion::findOrFail($id);
        return view('admin.facturacion.delete', compact('factura'));
    }

    public function destroy($id)
    {
        $factura = Facturacion::findOrFail($id);
        $factura->delete();

        return redirect()
            ->route('admin.facturacion.index')
            ->with('mensaje', 'Factura eliminada exitosamente.')
            ->with('icono', 'success');
    }
}
