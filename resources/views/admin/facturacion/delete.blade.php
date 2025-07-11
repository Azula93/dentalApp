@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mt-3">Eliminar Factura: {{ $factura->numero_recibo }}</h1>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Detalle de la factura</h3>
            </div>
            {{-- Resumen de datos para que el usuario vea qué va a borrar --}}
            <div class="alert alert-warning ">
                <p><i class="fa-solid fa-triangle-exclamation me-1"></i>
                    <strong>¡Atención!</strong> <br> Esta acción es irreversible. Se eliminará la factura que se muestra a continuación.
                </p>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/facturacion', $factura->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <table class="table table-bordered table-sm" style="font-size: 0.9rem;">
                        <tbody>
                            <tr>
                                <th width="25%">Paciente</th>
                                <td>
                                    {{ $factura->paciente->apellidos }} {{ $factura->paciente->nombres }}
                                </td>

                            </tr>
                            <tr>
                                <th>Fecha emisión</th>
                                <td>{{ \Carbon\Carbon::parse($factura->fecha_emision)->format('d/m/Y') }}</td>
                                <th>Fecha pago</th>
                                <td>{{ \Carbon\Carbon::parse($factura->fecha_pago)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Subtotal</th>
                                <td>{{ number_format($factura->subtotal, 3) }}</td>
                                <th>Descuento</th>
                                <td>{{ number_format($factura->descuento, 0) }}</td>
                            </tr>
                            <tr>
                                <th>Impuesto (%)</th>
                                <td>{{ number_format($factura->impuesto, 2) }}%</td>
                                <th>Total</th>
                                <td><strong>{{ number_format($factura->monto, 3) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Método de pago</th>
                                <td>{{ ucfirst($factura->metodo_pago) }}</td>
                                <th>Referencia pago</th>
                                <td>{{ $factura->referencia_pago ?: '—' }}</td>
                            </tr>
                            <tr>
                                <th>Estado</th>
                                <td colspan="3">
                                    @if($factura->estado == 'pagado')
                                    <span class="badge bg-success">Pagado</span>
                                    @elseif($factura->estado == 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                    @else
                                    <span class="badge bg-danger">Anulado</span>
                                    @endif
                                </td>
                            </tr>
                            @if($factura->descripcion)
                            <tr>
                                <th>Descripción</th>
                                <td colspan="3">{!! ($factura->descripcion) !!}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
            </div>
            <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                <a href="{{ route('admin.facturacion.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Regresar
                </a>
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Eliminar factura</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection