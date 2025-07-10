@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Generar Reporte</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-4 mt-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Listado de reservas
                </h3>
            </div>
            <div class="card-body">
                <a href="{{url('admin/reservas/pdf')}}" target="_blank"
                    class="btn btn-success "><i class="fa-solid fa-print"></i>
                    Generar Listado Reservas
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mt-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Generar reporte por rango de fechas
                </h3>
            </div>
            <div class="card-body">
                <form action="{{route('admin.reservas.pdf_fechas')}}" method="GET" target="_blank">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Fecha incio</label>
                            <input type="date" class="form-control" name="fecha_inicio"
                                value="">
                        </div>

                        <div class="col-md-4">
                            <label for="">Fecha fin</label>
                            <input type="date" class="form-control" name="fecha_fin"
                                value="">
                        </div>

                        <div class="col-md-4">
                            <div style="height: 32px;"></div>
                            <button class="btn btn-success"><i class="fa-solid fa-print"></i> Generar Reporte</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mt-4">
        <div class="form-group ">
            <a href="{{url('admin/doctores')}}"
                class="btn btn-secondary "><i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>
</div>


@endsection