<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntecedentesMedicosController;
use App\Http\Controllers\DiagnosticoHcController;
use App\Http\Controllers\OdontogramaController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\ExamenendodonticoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PacienteControlController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas configuracion
Route::get('/admin/configs', [App\Http\Controllers\ConfigController::class, 'index'])->name('admin.configs.index')->middleware('auth', 'can:admin.configs.index');

Route::get('/admin/configs/create', [App\Http\Controllers\ConfigController::class, 'create'])->name('admin.configs.create')->middleware('auth', 'can:admin.configs.create');

Route::post('/admin/configs/create', [App\Http\Controllers\ConfigController::class, 'store'])->name('admin.configs.store')->middleware('auth', 'can:admin.configs.store');

Route::get('/admin/configs/{id}', [App\Http\Controllers\ConfigController::class, 'show'])->name('admin.configs.show')->middleware('auth', 'can:admin.configs.show');

Route::get('/admin/configs/{id}/edit', [App\Http\Controllers\ConfigController::class, 'edit'])->name('admin.configs.edit')->middleware('auth', 'can:admin.configs.edit');

Route::put('/admin/configs/{id}', [App\Http\Controllers\ConfigController::class, 'update'])->name('admin.configs.update')->middleware('auth', 'can:admin.configs.update');

Route::get('/admin/configs/{id}/confirm-delete', [App\Http\Controllers\ConfigController::class, 'confirmDelete'])->name('admin.configs.confirm-delete')->middleware('auth', 'can:admin.configs.confirm-delete');

Route::delete('/admin/configs/{id}', [App\Http\Controllers\ConfigController::class, 'destroy'])->name('admin.configs.destroy')->middleware('auth', 'can:admin.configs.destroy');



//Rutas para el admin
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

// Rutas admin-usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth', 'can:admin.usuarios.index');

Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth', 'can:admin.usuarios.create');

Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'storage'])->name('admin.usuarios.storage')->middleware('auth', 'can:admin.usuarios.create');

Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth', 'can:admin.usuarios.show');

Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth', 'can:admin.usuarios.edit');

Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth', 'can:admin.usuarios.update');

Route::get('/admin/usuarios/{id}/confirm-delete', [App\Http\Controllers\UsuarioController::class, 'confirmDelete'])->name('admin.usuarios.confirm-delete')->middleware('auth', 'can:admin.usuarios.confirm-delete');

Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth', 'can:admin.usuarios.destroy');

// Rutas admin- secretarias
Route::get('/admin/secretarias', [App\Http\Controllers\SecretariaController::class, 'index'])->name('admin.secretarias.index')->middleware('auth', 'can:admin.secretarias.index');

Route::get('/admin/secretarias/create', [App\Http\Controllers\SecretariaController::class, 'create'])->name('admin.secretarias.create')->middleware('auth', 'can:admin.secretarias.create');

Route::post('/admin/secretarias/create', [App\Http\Controllers\SecretariaController::class, 'store'])->name('admin.secretarias.store')->middleware('auth', 'can:admin.secretarias.create');

Route::get('/admin/secretarias/{id}', [App\Http\Controllers\SecretariaController::class, 'show'])->name('admin.secretarias.show')->middleware('auth', 'can:admin.secretarias.show');

Route::get('/admin/secretarias/{id}/edit', [App\Http\Controllers\SecretariaController::class, 'edit'])->name('admin.secretarias.edit')->middleware('auth', 'can:admin.secretarias.edit');

Route::put('/admin/secretarias/{id}', [App\Http\Controllers\SecretariaController::class, 'update'])->name('admin.secretarias.update')->middleware('auth', 'can:admin.secretarias.update');

Route::get('/admin/secretarias/{id}/confirm-delete', [App\Http\Controllers\SecretariaController::class, 'confirmDelete'])->name('admin.secretarias.confirm-delete')->middleware('auth', 'can:admin.secretarias.confirm-delete');

Route::delete('/admin/secretarias/{id}', [App\Http\Controllers\SecretariaController::class, 'destroy'])->name('admin.secretarias.destroy')->middleware('auth', 'can:admin.secretarias.destroy');



// RUTAS CONTROLES DE PACIENTES

Route::get('/admin/pacientes/controles', [PacienteControlController::class, 'index'])
    ->name('admin.pacientes.controles.index_controles')
    ->middleware('auth');

// Crear nuevo control
Route::get('/admin/pacientes/controles/create', [PacienteControlController::class, 'create'])
    ->name('admin.pacientes.controles.create_controles')
    ->middleware('auth');

// Guardar nuevo control
Route::post('/admin/pacientes/controles/create', [PacienteControlController::class, 'store'])
    ->name('admin.pacientes.controles.create_controles')
    ->middleware('auth');

Route::get(
    '/admin/pacientes/controles/pdf_controles/{id}',
    [App\Http\Controllers\PacienteControlController::class, 'pdf']
)->name('admin.pacientes.controles.pdf_controles')->middleware('auth');


// // Ver un control específico
Route::get('/admin/pacientes/controles/{id}', [PacienteControlController::class, 'show'])
    ->name('admin.pacientes.controles.show_controles')
    ->middleware('auth');

// // Editar un control
Route::get('/admin/pacientes/controles/{control}/edit', [PacienteControlController::class, 'edit'])
    ->name('admin.pacientes.controles.edit_controles')
    ->middleware('auth');

// // Actualizar un control
Route::put('/admin/pacientes/controles/{control}', [PacienteControlController::class, 'update'])
    ->name('admin.pacientes.controles.update_controles')
    ->middleware('auth');

Route::get('/admin/pacientes/controles/{id}/confirm-delete_controles', [App\Http\Controllers\PacienteControlController::class, 'confirmDelete'])->name('admin.pacientes.controles.confirm-delete_controles')
    ->middleware('auth');

// // Eliminar un control
Route::delete('/admin/pacientes/controles/{id}', [PacienteControlController::class, 'destroy'])
    ->name('admin.pacientes.controles.destroy_controles')
    ->middleware('auth');

//Rutas admin-pacientes ******************

Route::get('/admin/pacientes', [App\Http\Controllers\PacienteController::class, 'index'])->name('admin.pacientes.index')->middleware('auth', 'can:admin.pacientes.index');

Route::get('/admin/pacientes/create', [App\Http\Controllers\PacienteController::class, 'create'])->name('admin.pacientes.create')->middleware('auth', 'can:admin.pacientes.create');

Route::post('/admin/pacientes/create', [App\Http\Controllers\PacienteController::class, 'store'])->name('admin.pacientes.store')->middleware('auth', 'can:admin.pacientes.create');

Route::get('/admin/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'show'])->name('admin.pacientes.show')->middleware('auth', 'can:admin.pacientes.show');

Route::get('/admin/pacientes/{id}/edit', [App\Http\Controllers\PacienteController::class, 'edit'])->name('admin.pacientes.edit')->middleware('auth', 'can:admin.pacientes.edit');

Route::put('/admin/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'update'])->name('admin.pacientes.update')->middleware('auth', 'can:admin.pacientes.update');

Route::get('/admin/pacientes/{id}/confirm-delete', [App\Http\Controllers\PacienteController::class, 'confirmDelete'])->name('admin.pacientes.confirm-delete')->middleware('auth', 'can:admin.pacientes.confirm-delete');

Route::delete('/admin/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'destroy'])->name('admin.pacientes.destroy')->middleware('auth', 'can:admin.pacientes.destroy');

Route::get('admin/pacientes/{paciente}/pdf', [PacienteController::class, 'pdf'])
    ->name('admin.pacientes.pdf')->middleware('auth', 'can:admin.pacientes.pdf');
// rutas anamnesis *******************
// Route::middleware('auth')->group(function () {
//     // Mostrar el formulario de anamnesis
//     Route::get(
//         'admin/pacientes/{paciente}/anamnesis',
//         [HistoriaAnamnesisController::class, 'edit']
//     )
//         ->middleware('can:admin.pacientes.anamnesis.edit')
//         ->name('admin.pacientes.anamnesis.edit');

//     // Guardar/actualizar anamnesis
//     Route::put(
//         'admin/pacientes/{paciente}/anamnesis',
//         [HistoriaAnamnesisController::class, 'update']
//     )->middleware('can:admin.pacientes.anamnesis.update')
//         ->name('admin.pacientes.anamnesis.update');
// });

//Rutas antecedentes medicos ******************
Route::get(
    'admin/pacientes/{paciente}/antecedentes-medicos',
    [AntecedentesMedicosController::class, 'edit']
)
    ->middleware('auth', 'can:admin.pacientes.antecedentes-medicos.edit')
    ->name('admin.pacientes.antecedentes-medicos.edit');

Route::put(
    'admin/pacientes/{paciente}/antecedentes-medicos',
    [AntecedentesMedicosController::class, 'update']
)
    ->middleware('auth', 'can:admin.pacientes.antecedentes-medicos.update')
    ->name('admin.pacientes.antecedentes-medicos.update');

// ODONTOGRAMA
Route::get(
    '/admin/pacientes/{paciente}/odontograma/edit',
    [OdontogramaController::class, 'edit']
)
    ->middleware('auth', 'can:admin.pacientes.odontograma.edit')
    ->name('admin.pacientes.odontograma.edit');


Route::put(
    '/admin/pacientes/{paciente}/odontograma',
    [OdontogramaController::class, 'update']
)
    ->middleware('auth', 'can:admin.pacientes.odontograma.update')
    ->name('admin.pacientes.odontograma.update');

// Route::get('admin/pacientes/{id}/odontograma', [PacienteController::class, 'odontograma'])
//     ->name('admin.pacientes.odontograma');

//  valoración 
Route::get(
    '/admin/pacientes/{paciente}/valoracion',
    [ValoracionController::class, 'edit']
)
    ->middleware('auth', 'can:admin.pacientes.valoracion.edit')
    ->name('admin.pacientes.valoracion.edit');

// Guardar o actualizar
Route::put(
    '/admin/pacientes/{paciente}/valoracion',
    [ValoracionController::class, 'update']
)
    ->middleware('auth', 'can:admin.pacientes.valoracion.update')
    ->name('admin.pacientes.valoracion.update');


// rutas diagnostico-hc
Route::get(
    '/admin/pacientes/{paciente}/diagnostico-hc',
    [DiagnosticoHcController::class, 'edit']
)
    ->name('admin.pacientes.diagnostico-hc.edit')->middleware('auth', 'can:admin.pacientes.diagnostico-hc.edit');

Route::put(
    '/admin/pacientes/{paciente}/diagnostico-hc',
    [DiagnosticoHcController::class, 'update']
)->name('admin.pacientes.diagnostico-hc.update')->middleware('auth', 'can:admin.pacientes.diagnostico-hc.update');

// *****************************************************************


//Rutas admin-consultorios
Route::get('/admin/consultorios', [App\Http\Controllers\ConsultorioController::class, 'index'])->name('admin.consultorios.index')->middleware('auth', 'can:admin.consultorios.index');

Route::get('/admin/consultorios/create', [App\Http\Controllers\ConsultorioController::class, 'create'])->name('admin.consultorios.create')->middleware('auth', 'can:admin.consultorios.create');

Route::post('/admin/consultorios/create', [App\Http\Controllers\ConsultorioController::class, 'store'])->name('admin.consultorios.store')->middleware('auth', 'can:admin.consultorios.create');

Route::get('/admin/consultorios/{id}', [App\Http\Controllers\ConsultorioController::class, 'show'])->name('admin.consultorios.show')->middleware('auth', 'can:admin.consultorios.show');

Route::get('/admin/consultorios/{id}/edit', [App\Http\Controllers\ConsultorioController::class, 'edit'])->name('admin.consultorios.edit')->middleware('auth', 'can:admin.consultorios.edit');

Route::put('/admin/consultorios/{id}', [App\Http\Controllers\ConsultorioController::class, 'update'])->name('admin.consultorios.update')->middleware('auth', 'can:admin.consultorios.update');

Route::get('/admin/consultorios/{id}/confirm-delete', [App\Http\Controllers\ConsultorioController::class, 'confirmDelete'])->name('admin.consultorios.confirm-delete')->middleware('auth', 'can:admin.consultorios.confirm-delete');

Route::delete('/admin/consultorios/{id}', [App\Http\Controllers\ConsultorioController::class, 'destroy'])->name('admin.consultorios.destroy')->middleware('auth', 'can:admin.consultorios.destroy');

//Rutas admin-doctores
Route::get('/admin/doctores', [App\Http\Controllers\DoctorController::class, 'index'])->name('admin.doctores.index')->middleware('auth', 'can:admin.doctores.index');
Route::get('/admin/doctores/create', [App\Http\Controllers\DoctorController::class, 'create'])->name('admin.doctores.create')->middleware('auth', 'can:admin.doctores.create');
Route::post('/admin/doctores/create', [App\Http\Controllers\DoctorController::class, 'store'])->name('admin.doctores.store')->middleware('auth', 'can:admin.doctores.create');
Route::get('/admin/doctores/pdf', [App\Http\Controllers\DoctorController::class, 'pdf'])->name('admin.doctores.pdf')->middleware('auth', 'can:admin.doctores.pdf');
Route::get('/admin/doctores/reportes', [App\Http\Controllers\DoctorController::class, 'reportes'])->name('admin.doctores.reportes')->middleware('auth', 'can:admin.doctores.reportes');
Route::get('/admin/doctores/{id}', [App\Http\Controllers\DoctorController::class, 'show'])->name('admin.doctores.show')->middleware('auth', 'can:admin.doctores.show');
Route::get('/admin/doctores/{id}/edit', [App\Http\Controllers\DoctorController::class, 'edit'])->name('admin.doctores.edit')->middleware('auth', 'can:admin.doctores.edit');
Route::put('/admin/doctores/{id}', [App\Http\Controllers\DoctorController::class, 'update'])->name('admin.doctores.update')->middleware('auth', 'can:admin.doctores.update');
Route::get('/admin/doctores/{id}/confirm-delete', [App\Http\Controllers\DoctorController::class, 'confirmDelete'])->name('admin.doctores.confirm-delete')->middleware('auth', 'can:admin.doctores.confirm-delete');
Route::delete('/admin/doctores/{id}', [App\Http\Controllers\DoctorController::class, 'destroy'])->name('admin.doctores.destroy')->middleware('auth', 'can:admin.doctores.destroy');

//Rutas admin-horarios
Route::get('/admin/horarios', [App\Http\Controllers\HorarioController::class, 'index'])->name('admin.horarios.index')->middleware('auth', 'can:admin.horarios.index');

Route::get('/admin/horarios/create', [App\Http\Controllers\HorarioController::class, 'create'])->name('admin.horarios.create')->middleware('auth', 'can:admin.horarios.create');

Route::post('/admin/horarios/create', [App\Http\Controllers\HorarioController::class, 'store'])->name('admin.horarios.store')->middleware('auth', 'can:admin.horarios.create');

Route::get('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'show'])->name('admin.horarios.show')->middleware('auth', 'can:admin.horarios.show');

Route::get('/admin/horarios/{id}/edit', [App\Http\Controllers\HorarioController::class, 'edit'])->name('admin.horarios.edit')->middleware('auth', 'can:admin.horarios.edit');

Route::put('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'update'])->name('admin.horarios.update')->middleware('auth', 'can:admin.horarios.update');

Route::get('/admin/horarios/{id}/confirm-delete', [App\Http\Controllers\HorarioController::class, 'confirmDelete'])->name('admin.horarios.confirm-delete')->middleware('auth', 'can:admin.horarios.confirm-delete');

Route::delete('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'destroy'])->name('admin.horarios.destroy')->middleware('auth', 'can:admin.horarios.destroy');


// AJAX
Route::get('/admin/horarios/consultorios/{id}', [App\Http\Controllers\HorarioController::class, 'cargar_datos_consultorio'])->name('admin.horarios.cargar_datos_consultorio')->middleware('auth', 'can:admin.horarios.cargar_datos_consultorio');

// Rutas usuario-normal 
Route::get('/consultorios/{id}', [App\Http\Controllers\WebController::class, 'cargar_datos_consultorio'])->name('cargar_datos_consultorio')->middleware('auth', 'can:cargar_datos_consultorio');

Route::get('/cargar_reserva_doctores/{id}', [App\Http\Controllers\WebController::class, 'cargar_reserva_doctores'])->name('cargar_reserva_doctores')->middleware('auth', 'can:cargar_reserva_doctores');

Route::get('/admin/ver_reservas/{id}', [App\Http\Controllers\AdminController::class, 'ver_reservas'])->name('ver_reservas')->middleware('auth', 'can:ver_reservas');

Route::post('/admin/eventos/create', [App\Http\Controllers\EventController::class, 'store'])->name('admin.eventos.create')->middleware('auth', 'can:admin.eventos.create');

Route::delete('/admin/eventos/destroy/{id}', [App\Http\Controllers\EventController::class, 'destroy'])->name('admin.eventos.destroy')->middleware('auth', 'can:admin.eventos.destroy');

//Rutas reservas
Route::get('/admin/reservas/reportes', [App\Http\Controllers\EventController::class, 'reportes'])->name('admin.reservas.reportes')->middleware('auth', 'can:admin.reservas.reportes');

Route::get('/admin/reservas/pdf', [App\Http\Controllers\EventController::class, 'pdf'])->name('admin.reservas.pdf')->middleware('auth', 'can:admin.reservas.pdf');

Route::get('/admin/reservas/pdf_fechas', [App\Http\Controllers\EventController::class, 'pdf_fechas'])->name('admin.reservas.pdf_fechas')->middleware('auth', 'can:admin.reservas.pdf_fechas');

//**** Rutas CONTROLES *****

// RUTAS ANAMNESIS 
Route::get('pacientes/{id}/anamnesis', [PacienteController::class, 'editAnamnesis'])->name('admin.pacientes.anamnesis.edit')->middleware('auth', 'can:admin.pacientes.anamnesis.edit');
Route::put('pacientes/{id}/anamnesis', [PacienteController::class, 'updateAnamnesis'])->name('admin.pacientes.anamnesis.update')->middleware('auth', 'can:admin.pacientes.anamnesis.update');


// ***********RUTAS PARA FACTURACION**********

Route::get('/admin/facturacion', [FacturacionController::class, 'index'])
    ->name('admin.facturacion.index')
    ->middleware('auth', 'can:admin.facturacion.index');

Route::get('/admin/facturacion/create', [FacturacionController::class, 'create'])
    ->name('admin.facturacion.create')
    ->middleware('auth', 'can:admin.facturacion.create');


Route::post('/admin/facturacion/create', [FacturacionController::class, 'store'])
    ->name('admin.facturacion.store')
    ->middleware('auth', 'can:admin.facturacion.store');

Route::get(
    '/admin/facturacion/pdf/{id}',
    [FacturacionController::class, 'pdf']
)->name('admin.facturacion.pdf')->middleware('auth', 'can:admin.facturacion.pdf');


Route::get('/admin/facturacion/{id}', [FacturacionController::class, 'show'])
    ->name('admin.facturacion.show')
    ->middleware('auth', 'can:admin.facturacion.show');


Route::get('/admin/facturacion/{id}/edit', [FacturacionController::class, 'edit'])
    ->name('admin.facturacion.edit')
    ->middleware('auth', 'can:admin.facturacion.edit');



Route::put('/admin/facturacion/{id}', [FacturacionController::class, 'update'])
    ->name('admin.facturacion.update')
    ->middleware('auth', 'can:admin.facturacion.update');

Route::get('/admin/facturacion/{id}/confirm-delete', [App\Http\Controllers\FacturacionController::class, 'confirmDelete'])
    ->name('admin.facturacion.confirm-delete')
    ->middleware('auth', 'can:admin.facturacion.confirm-delete');


Route::delete('/admin/facturacion/{id}', [FacturacionController::class, 'destroy'])
    ->name('admin.facturacion.destroy')
    ->middleware('auth', 'can:admin.facturacion.destroy');


// RUTAS EXAMEN ENDODONTICO
Route::get('/admin/pacientes/{paciente}/examenendodontico', [
    ExamenendodonticoController::class,
    'edit'
])->name('admin.pacientes.examenendodontico.edit')->middleware('auth');

Route::put('/admin/pacientes/{paciente}/examenendodontico', [
    ExamenendodonticoController::class,
    'update'
])->name('admin.pacientes.examenendodontico.update')->middleware('auth');

// RUTAS EXAMEN PERIODONTAL
Route::get('/admin/pacientes/{paciente}/examenperiodontal', [
    App\Http\Controllers\ExamenperiodontalController::class,
    'edit'
])->name('admin.pacientes.examenperiodontal.edit')->middleware('auth');

Route::put('/admin/pacientes/{paciente}/examenperiodontal', [
    App\Http\Controllers\ExamenperiodontalController::class,
    'update'
])->name('admin.pacientes.examenperiodontal.update')->middleware('auth');
