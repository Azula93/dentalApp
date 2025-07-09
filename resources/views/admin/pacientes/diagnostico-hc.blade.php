@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <h1 class="p-3 text-center">Diagnóstico HC de {{ $paciente->nombres }} {{ $paciente->apellidos }}</h1>

    <form method="POST" action="{{ route('admin.pacientes.diagnostico-hc.update', $paciente) }}">
        @csrf @method('PUT')

        <table class="table">
            <thead>
                <tr>
                    <th>Procedimiento</th>
                    <th>Diagnóstico</th>
                    <th>Solución</th>
                </tr>
            </thead>
            <tbody>
                @foreach($diagnosticos as $i => $diag)
                <tr>
                    {{-- mantenemos el id en caso de que ya exista --}}
                    <input type="hidden"
                        name="diagnosticos[{{ $i }}][id]"
                        value="{{ $diag->id ?? '' }}">

                    {{-- el propio procedimiento --}}
                    <td>
                        <input type="hidden"
                            name="diagnosticos[{{ $i }}][procedimiento]"
                            value="{{ $diag->procedimiento }}">
                        {{ $diag->procedimiento }}
                    </td>

                    {{-- campo de diagnóstico libre --}}
                    <td>
                        <textarea name="diagnosticos[{{ $i }}][diagnostico]"
                            class="form-control"
                            rows="2">{{ old("diagnosticos.$i.diagnostico", $diag->diagnostico) }}</textarea>
                    </td>

                    {{-- campo de solución libre --}}
                    <td>
                        <textarea name="diagnosticos[{{ $i }}][solucion]"
                            class="form-control"
                            rows="2">{{ old("diagnosticos.$i.solucion", $diag->solucion) }}</textarea>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between flex-wrap gap-2">
            <a href="{{route('admin.pacientes.index')}}" class="btn btn-secondary m-2"><i class="fa-solid fa-arrow-left"></i> Regresar</a>

            <button class="btn btn-primary m-2"><i class="fa-solid fa-cloud"></i> Guardar Diagnóstico</button>
        </div>
    </form>

</div>
@endsection