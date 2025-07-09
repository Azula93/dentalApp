<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Event;
use PhpParser\Comment\Doc;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = \App\Models\User::count();
        $totalsecretarias = \App\Models\Secretaria::count();
        $totalpacientes = \App\Models\Paciente::count();
        $totalconsultorios = \App\Models\Consultorio::count();
        $totaldoctores = \App\Models\Doctor::count();
        $totalhorarios = \App\Models\Horario::count();
        $totalEventos = \App\Models\Event::count();

        $consultorios = Consultorio::all();
        $doctores = Doctor::all();
        $eventos = Event::all();



        return view('admin.index', compact(
            'totalUsers',
            'totalsecretarias',
            'totalpacientes',
            'totalconsultorios',
            'totaldoctores',
            'totalhorarios',
            'consultorios',
            'doctores',
            'eventos',
            'totalEventos'
        ));
    }

    public function ver_reservas($id)
    {
        $eventos = Event::where('user_id', $id)->get();
        return view('admin.ver_reservas', compact('eventos'));
    }
}
