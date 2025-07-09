{{-- resources/views/admin/facturacion/show.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mt-3">Factura: {{ $factura->numero_recibo }}</h1>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Detalle de la factura</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm" style="font-size: 1rem;">
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
                            <td>{{ number_format($factura->subtotal ?? 0, 0, ',', '.') }}</td>
                            <th>Descuento</th>
                            <td>{{ number_format($factura->descuento ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Impuesto (%)</th>
                            <td>{{ number_format($factura->impuesto, 0) }}%</td>
                            <th>Total a pagar</th>
                            <td><strong>{{ number_format($factura->monto ?? 0, 0, ',', '.') }}</strong></td>
                        </tr>
                        <tr>
                            <th>Método de pago</th>
                            <td>{{ ucfirst($factura->metodo_pago) }}</td>
                            <th>Referencia pago</th>
                            <td>{{ $factura->referencia_pago ?? '—'  }}</td>
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

                        <tr>
                            <th>Descripción</th>
                            <td colspan="3">{!! ($factura->descripcion) !!}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('admin.facturacion.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Regresar
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('formulario');
        const inputs = document.querySelectorAll('.cop-format');

        // función de formateo: toma sólo dígitos y mete puntos cada 3
        const formatMiles = str => {
            const digits = str.replace(/\D/g, '');
            return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        // 1) formatea el valor que ya vino en el input
        inputs.forEach(input => {
            input.value = formatMiles(input.value);
        });

        // 2) formatea mientras escribes y mantiene el cursor al final
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                input.value = formatMiles(input.value);
                input.setSelectionRange(input.value.length, input.value.length);
            });
        });

        // 3) antes de enviar, quita TODO lo que no sea dígito
        form.addEventListener('submit', () => {
            inputs.forEach(input => {
                input.value = input.value.replace(/\D/g, '');
            });
        });
    });
</script>

@endsection