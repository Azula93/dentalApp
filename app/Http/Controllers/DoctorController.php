<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Config; // Assuming Configuracion is the model for your configuration
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $doctores = Doctor::with('user')->get();

        return view('admin.doctores.index', compact('doctores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:doctors',
            'telefono' => 'nullable|string|max:15',
            'especialidad' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        $doctor = new Doctor();
        $doctor->user_id = $usuario->id;
        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->cedula = $request->cedula;
        $doctor->telefono = $request->telefono;
        $doctor->especialidad = $request->especialidad;
        $doctor->direccion = $request->direccion;
        $doctor->email = $request->email;
        $doctor->save();

        $usuario->assignRole('doctor'); // Asignar el rol de 'doctor' al usuario

        return redirect()->route('admin.doctores.index')->with('mensaje', 'Doctor creado exitosamente.')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $doctor = Doctor::with('user')->findOrFail($id);
        return view('admin.doctores.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctores.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:doctors,cedula,' . $doctor->id,
            'telefono' => 'nullable|string|max:15',
            'especialidad' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $doctor->user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);


        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->cedula = $request->cedula;
        $doctor->telefono = $request->telefono;
        $doctor->especialidad = $request->especialidad;
        $doctor->direccion = $request->direccion;
        $doctor->save();

        $usuario = User::find($doctor->user->id);
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        if ($request->password) {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->save();

        return redirect()->route('admin.doctores.index')
            ->with('mensaje', 'Datos Doctor actualizado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */


    public function confirmDelete($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('admin.doctores.delete', compact('doctor'));
    }


    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        // Eliminar el usuario asociado a la doctor
        $user = $doctor->user;
        $user->delete();
        // Eliminar la doctor
        $doctor->delete();
        // Redirigir a la lista de doctores con un mensaje de éxito
        return redirect()->route('admin.doctores.index')->with('mensaje', 'Perfil de Doctor eliminado exitosamente.')
            ->with('icono', 'success');
    }

    public function reportes()
    {
        $doctores = Doctor::with('user')->get();
        return view('admin.doctores.reportes', compact('doctores'));
    }

    public function pdf()
    {
        $configuracion = Config::latest()->first();
        $doctores = Doctor::all();
        $pdf = Pdf::loadView('admin.doctores.pdf', compact('configuracion', 'doctores'))
            ->setPaper('A4', 'portrait')
            ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true,]);

        // pie de pagina
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->email, null, 10, array(0, 0, 0));
        $canvas->page_text(270, 800, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        $canvas->page_text(400, 800, "Fecha:" . \Carbon\Carbon::now()->format('d/m/Y') . " | " . "Hora: " . \Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0, 0, 0));

        return $pdf->stream();
    }
}
