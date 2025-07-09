<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seeder para los roles y permisos admin(super user), colaborador, doc, paciente, usuarios
        $admin = Role::create(['name' => 'admin']);
        $colaborador = Role::create(['name' => 'colaborador']);
        $doctor = Role::create(['name' => 'doctor']);
        $paciente = Role::create(['name' => 'paciente']);
        $user = Role::create(['name' => 'user']);

        Permission::create(['name' => 'admin.index']);
        //usuarios
        permission::create(['name' => 'admin.usuarios.index'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.usuarios.create'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.usuarios.storage'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.usuarios.show'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.usuarios.edit'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.usuarios.update'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.usuarios.confirm-delete'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.usuarios.destroy'])->syncRoles([$admin]);

        // Config
        permission::create(['name' => 'admin.configs.index'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.configs.create'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.configs.store'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.configs.show'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.configs.edit'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.configs.update'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.configs.confirm-delete'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.configs.destroy'])->syncRoles([$admin]);

        // secretarias
        permission::create(['name' => 'admin.secretarias.index'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.secretarias.create'])->syncRoles([$admin, $doctor]);
        permission::create(['name' => 'admin.secretarias.store'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.secretarias.show'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.secretarias.edit'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.secretarias.update'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.secretarias.confirm-delete'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.secretarias.destroy'])->syncRoles([$admin]);

        // pacientes
        permission::create(['name' => 'admin.pacientes.index'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.create'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.pacientes.store'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.pacientes.show'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.edit'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.pacientes.update'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.pacientes.confirm-delete'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.pacientes.destroy'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.pacientes.anamnesis.edit'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.anamnesis.update'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.antecedentes-medicos.edit'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.pacientes.antecedentes-medicos.update'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.odontograma.edit'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.odontograma.update'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.valoracion.edit'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.valoracion.update'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.diagnostico-hc.edit'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.diagnostico-hc.update'])->syncRoles([$admin, $colaborador, $doctor]);
        permission::create(['name' => 'admin.pacientes.pdf'])->syncRoles([$admin, $colaborador, $doctor]);

        // consultorios
        permission::create(['name' => 'admin.consultorios.index'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.consultorios.create'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.consultorios.store'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.consultorios.show'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.consultorios.edit'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.consultorios.update'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.consultorios.confirm-delete'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.consultorios.destroy'])->syncRoles([$admin, $colaborador]);

        //doctores
        permission::create(['name' => 'admin.doctores.index'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.doctores.create'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.doctores.store'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.doctores.show'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.doctores.edit'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.doctores.update'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.doctores.confirm-delete'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.doctores.destroy'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.doctores.reportes'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.doctores.pdf'])->syncRoles([$admin, $colaborador]);


        //horarios
        permission::create(['name' => 'admin.horarios.index'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.horarios.create'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.horarios.store'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.horarios.show'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.horarios.edit'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.horarios.update'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.horarios.confirm-delete'])->syncRoles([$admin, $colaborador]);
        permission::create(['name' => 'admin.horarios.destroy'])->syncRoles([$admin, $colaborador]);

        //ajax
        permission::create(['name' => 'admin.horarios.cargar_datos_consultorio'])->syncRoles([$admin, $colaborador]);


        //rutas para el usuario 

        permission::create(['name' => 'cargar_datos_consultorio'])->syncRoles([$admin, $user]);
        permission::create(['name' => 'cargar_reserva_doctores'])->syncRoles([$admin, $user]);
        permission::create(['name' => 'ver_reservas'])->syncRoles([$admin, $user]);
        permission::create(['name' => 'admin.eventos.create'])->syncRoles([$admin, $user]);
        permission::create(['name' => 'admin.eventos.destroy'])->syncRoles([$admin, $user]);

        //rutas para las reservas de citas
        permission::create(['name' => 'admin.reservas.reportes'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.reservas.pdf'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.reservas.pdf_fechas'])->syncRoles([$admin]);

        //rutas para FACTURACION
        permission::create(['name' => 'admin.facturacion.index'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.facturacion.create'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.facturacion.store'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.facturacion.show'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.facturacion.edit'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.facturacion.update'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.facturacion.pdf'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.facturacion.confirm-delete'])->syncRoles([$admin]);
        permission::create(['name' => 'admin.facturacion.destroy'])->syncRoles([$admin]);
    }
}
