{{-- resources/views/admin/facturacion/create.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="row">
    <h1 class="mt-3">Generar comprobante de pago</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingresa la información</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.facturacion.store') }}" method="POST" id="formulario">
                    @csrf

                    {{-- Paciente y Control --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="paciente_id">Paciente</label> <b>*</b>
                            <select name="paciente_id" id="paciente_id" class="form-control" required>
                                <option value="">-- Seleccione paciente --</option>
                                @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}"
                                    {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->apellidos }} {{ $paciente->nombres }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="fecha_emision">Fecha de emisión</label> <b>*</b>
                            <input type="date" name="fecha_emision" id="fecha_emision"
                                class="form-control"
                                value="{{ old('fecha_emision', now()->toDateString()) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_pago">Fecha de pago</label> <b>*</b>
                            <input type="date" name="fecha_pago" id="fecha_pago"
                                class="form-control"
                                value="{{ old('fecha_pago', now()->toDateString()) }}" required>
                        </div>

                    </div>

                    {{-- Fechas --}}
                    <div class="row mb-3">

                    </div>

                    {{-- Desglose de montos --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="subtotal">Subtotal</label> <b>*</b>
                            <input type="text" name="subtotal" id="subtotal" step="0.01"
                                class="form-control cop-format" placeholder="0" autocomplete="off" maxlength="11" value="{{ old('subtotal') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="descuento">Descuento</label>
                            <input type="text" name="descuento" id="descuento" step="0.01"
                                class="form-control cop-format" placeholder="0" autocomplete="off" maxlength="11" value="{{ old('descuento') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="impuesto">Impuesto</label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    name="impuesto"
                                    id="impuesto"
                                    class="form-control"
                                    value="{{ old('impuesto') }}"
                                    min="0"
                                    max="100"
                                    step="0.01"
                                    oninput="
    // si teclean un valor mayor, lo dejamos en 100;
    // si es menor que 0, lo dejamos en 0
    if (this.value !== '') {
      if (parseFloat(this.value) > parseFloat(this.max)) this.value = this.max;
      if (parseFloat(this.value) < parseFloat(this.min)) this.value = this.min;
    }
  "
                                    required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="monto">Total a pagar</label> <b>*</b>
                            <input type="text" name="monto" id="monto" step="0.01"
                                class="form-control cop-format" placeholder="0" autocomplete="off" maxlength="11" value="{{  old('monto', intval($factura->monto ?? 0))  }}" required>
                        </div>
                    </div>

                    {{-- Pago y estado --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="metodo_pago">Método de pago</label> <b>*</b>
                            <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                                <option value="">-- Seleccione método --</option>
                                <option value="efectivo" {{ old('metodo_pago')=='efectivo'?'selected':'' }}>Efectivo</option>
                                <option value="tarjeta" {{ old('metodo_pago')=='tarjeta'?'selected':'' }}>Tarjeta</option>
                                <option value="transferencia" {{ old('metodo_pago')=='transferencia'?'selected':'' }}>Transferencia</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="referencia_pago">Referencia de pago</label>
                            <input type="text" name="referencia_pago" id="referencia_pago"
                                class="form-control" value="{{ old('referencia_pago') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="estado">Estado del pago</label>
                            <select name="estado" id="estado" class="form-control" required>
                                <option value="">-- Seleccione estado del pago --</option>
                                <option value="pagado" {{ old('estado')=='pagado'?'selected':'' }}>Pagado</option>
                                <option value="pendiente" {{ old('estado')=='pendiente'?'selected':'' }}>Pendiente</option>
                                <option value="anulado" {{ old('estado')=='anulado'?'selected':'' }}>Anulado</option>
                            </select>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="descripcion">Descripción (opcional)</label>
                            <textarea name="descripcion" id="descripcion" rows="3"
                                class="form-control">{{ old('descripcion') }}</textarea>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <a href="{{ route('admin.facturacion.index') }}"
                                class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Regresar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-file-invoice-dollar"></i> Generar factura
                            </button>
                        </div>
                    </div>
                </form>
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