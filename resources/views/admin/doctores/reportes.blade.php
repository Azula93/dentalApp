@extends('layouts.admin')
@section('content')
<div class="row">
    <h1 class="mt-3">Generar Reporte</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos para reporte</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <div class="form-group ">
                            <a href="{{url('admin/doctores/pdf')}}"
                                class="btn btn-success "><i class="fa-solid fa-print"></i>
                                Listado personal medico
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="form-group ">
                            <a href="{{url('admin/doctores')}}"
                                class="btn btn-secondary ">Regresar</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    @endsection