{{-- resources/views/partials/diente.blade.php --}}
<div class="diente position-relative mx-1"
    data-diente="{{ $diente }}"
    data-tools='@json($marcadas)'>
    <i class="fa fa-tooth fa-2x"></i><br>
    <small>{{ $diente }}</small>

    <div class="badge-container">
        @foreach($marcadas as $t)
        <span class="badge bg-info">{{ $herramientas[$t] }}</span>
        @endforeach
    </div>
</div>