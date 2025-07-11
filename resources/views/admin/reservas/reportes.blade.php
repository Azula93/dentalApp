@extends('layouts.admin')
@section('content')
<div class="row justify-content-center mb-4 p-3">
    <h1 class="mt-3">Generar reporte de reserva de citas</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-4 mt-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Listado de reservas</b>
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



    <div class="col-md-8 mt-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Generar reporte por rango de fechas</b>
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
@endsection