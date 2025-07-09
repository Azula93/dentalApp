<div class="card mb-4">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">{{ $titulo }}</h5>
    </div>
    <div class="card-body">
        {{-- Toolbar (igual que antes) --}}


        @foreach($filas as $linea)
        <div class="odontograma-linea d-flex justify-content-between mb-4">


            @foreach($linea as $diente)
            @php $marcadas = $toothTools[$diente] ?? []; @endphp

            <div class="diente {{ $marcadas ? 'active' : '' }}"
                data-diente="{{ $diente }}"
                data-tools='@json($marcadas)'>
                <i class="fa fa-tooth fa-2x"></i><br>
                {{-- Esto imprimirá 18,17,…,28 según la fila --}}
                <small>{{ $diente }}</small>

                {{-- Badges de cada herramienta marcada --}}
                <div class="badge-container">
                    @foreach($marcadas as $t)
                    <span class="badge bg-info">{{ $herramientas[$t] }}</span>
                    @endforeach
                </div>
            </div>
            @endforeach

        </div>
        @endforeach

        {{-- Convenciones (igual que antes) --}}
    </div>
</div>