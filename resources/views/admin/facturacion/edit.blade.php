{{-- resources/views/admin/facturacion/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="row">
    <h1 class="mt-3">Editar comprobante de pago</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Actualiza la información</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/facturacion/'.$factura->id) }}" method="POST" id="formulario">
                    @csrf
                    @method('PUT')
                    {{-- Paciente --}}
                    <div class="row mb-3">
                        {{-- Número de recibo (solo lectura) --}}
                        <div class="form-group mb-3 col-md-2">
                            <label for="numero_recibo">Número de recibo</label>
                            <input
                                type="text"
                                id="numero_recibo"
                                class="form-control"
                                value="{{ $factura->numero_recibo }}"
                                readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="paciente_id">Paciente <b>*</b></label>
                            <select
                                name="paciente_id"
                                id="paciente_id"
                                class="form-control"
                                required>
                                <option value="">-- Seleccione paciente --</option>
                                @foreach($pacientes as $paciente)
                                <option
                                    value="{{ $paciente->id }}"
                                    {{ old('paciente_id', $factura->paciente_id)==$paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->apellidos }} {{ $paciente->nombres }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Fechas --}}

                        <div class="col-md-3">
                            <label for="fecha_emision">Fecha de emisión <b>*</b></label>
                            <input
                                type="date"
                                name="fecha_emision"
                                id="fecha_emision"
                                class="form-control"
                                value="{{ old('fecha_emision', $factura->fecha_emision->format('Y-m-d')) }}"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_pago">Fecha de pago <b>*</b></label>
                            <input
                                type="date"
                                name="fecha_pago"
                                id="fecha_pago"
                                class="form-control"
                                value="{{ old('fecha_pago', $factura->fecha_pago->format('Y-m-d')) }}"
                                required>
                        </div>



                    </div>

                    {{-- Desglose de montos --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="subtotal">Subtotal <b>*</b></label>
                            <input
                                type="text"
                                name="subtotal"
                                id="subtotal"
                                class="form-control cop-format"
                                placeholder="0"
                                autocomplete="off"
                                maxlength="11"
                                value="{{ old('subtotal',number_format($factura->subtotal, 3)) }}"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label for="descuento">Descuento</label>
                            <input
                                type="text"
                                name="descuento"
                                id="descuento"
                                class="form-control cop-format"
                                placeholder="0"
                                autocomplete="off"
                                maxlength="11"
                                value="{{ old('descuento',number_format($factura->descuento, 0)) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="impuesto">Impuesto <b>*</b></label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    name="impuesto"
                                    id="impuesto"
                                    class="form-control"
                                    value="{{ old('impuesto',($factura->impuesto)) }}"
                                    min="0"
                                    max="100"
                                    step="0.01"
                                    oninput="
                                        if (this.value!=='') {
                                            if (parseFloat(this.value)>parseFloat(this.max)) this.value=this.max;
                                            if (parseFloat(this.value)<parseFloat(this.min)) this.value=this.min;
                                        }
                                    "
                                    required>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="monto">Total a pagar <b>*</b></label>
                            <input
                                type="text"
                                name="monto"
                                id="monto"
                                class="form-control cop-format"
                                placeholder="0"
                                autocomplete="off"
                                maxlength="11"
                                value="{{ old('monto',number_format($factura->monto, 3)) }}"
                                required>
                        </div>
                    </div>

                    {{-- Pago y estado --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="metodo_pago">Método de pago <b>*</b></label>
                            <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                                <option value="">-- Seleccione método --</option>
                                @foreach(['efectivo','tarjeta','transferencia'] as $metodo)
                                <option
                                    value="{{ $metodo }}"
                                    {{ old('metodo_pago', $factura->metodo_pago)==$metodo?'selected':'' }}>
                                    {{ ucfirst($metodo) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="referencia_pago">Referencia de pago</label>
                            <input
                                type="text"
                                name="referencia_pago"
                                id="referencia_pago"
                                class="form-control"
                                value="{{ old('referencia_pago', $factura->referencia_pago) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="estado">Estado del pago <b>*</b></label>
                            <select name="estado" id="estado" class="form-control" required>
                                <option value="">-- Seleccione estado --</option>
                                @foreach(['pagado','pendiente','anulado'] as $estado)
                                <option
                                    value="{{ $estado }}"
                                    {{ old('estado', $factura->estado)==$estado?'selected':'' }}>
                                    {{ ucfirst($estado) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="detalle_editor">Descripción (opcional)</label>
                                <textarea
                                    name="descripcion"
                                    id="detalle_editor"
                                    rows="3"
                                    class="form-control">
                                {{ old('descripcion', $factura->descripcion) }}
                                </textarea>
                                {{-- Campo real que se envía (required) --}}
                                <input type="hidden" name="detalle" id="detalle_hidden" required>

                            </div>
                        </div>
                        <script type="importmap">
                            {
    "imports": {
        "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
        "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
    }
}
</script>

                        <script type="module">
                            import {
                                ClassicEditor,
                                Essentials,
                                Bold,
                                Italic,
                                Font,
                                Paragraph
                            } from 'ckeditor5';

                            let editorInstance;

                            ClassicEditor
                                .create(document.querySelector('#detalle_editor'), {
                                    plugins: [Essentials, Bold, Italic, Font, Paragraph],
                                    toolbar: {
                                        items: [
                                            'undo', 'redo', '|',
                                            'italic', 'fontSize', 'fontFamily',
                                            'fontColor', 'fontBackgroundColor'
                                        ]
                                    }
                                })
                                .then(editor => {
                                    editorInstance = editor;
                                })
                                .catch(error => console.error(error));

                            // Copiar el contenido al input oculto antes de enviar
                            document.getElementById('formulario').addEventListener('submit', () => {
                                document.getElementById('detalle_hidden').value = editorInstance.getData();
                            });
                        </script>
                    </div>

                    {{-- Botones --}}

                    <div class="d-flex justify-content-between flex-wrap gap-2 m-3">
                        <a href="{{ route('admin.facturacion.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Regresar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-repeat"></i> Actualizar
                        </button>
                    </div>



                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.cop-format').forEach(input => {
            input.addEventListener('input', () => {
                let digits = input.value.replace(/\D/g, '');
                input.value = digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                input.setSelectionRange(input.value.length, input.value.length);
            });
        });
    });
</script>
@endpush

@endsection