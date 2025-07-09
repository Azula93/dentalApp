<?php


namespace Database\Seeders;

use App\Models\Consultorio;
use App\Models\Secretaria;
use App\Models\Doctor;
use App\Models\Horario;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Config;
use PhpParser\Comment\Doc;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        $this->call([RoleSeeder::class]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Colaborador',
            'email' => 'colaborador@colaborador.com',
            'password' => bcrypt('colaborador123'),
        ])->assignRole('colaborador');

        Secretaria::create([
            'nombres' => 'Secreatria',
            'apellidos' => 'Uno',
            'cc' => '1234567890',
            'telefono' => '9874563210',
            'direccion' => 'calle de la vida',
            'fecha_nacimiento' => '10/10/2000',
            'user_id' => '2'
        ]);



        User::create([
            'name' => 'Paciente1',
            'email' => 'paciente1@paciente1.com',
            'password' => bcrypt('paciente123'),
        ])->assignRole('paciente');

        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('user23'),
        ])->assignRole('user');

        User::create([
            'name' => 'Doctor1',
            'email' => 'doctor1@doctor.com',
            'password' => bcrypt('doctor123'),
        ])->assignRole('doctor');

        Doctor::create([
            'nombres' => 'Doctor1',
            'apellidos' => 'Uno',
            'cedula' => '1234567809',
            'telefono' => '9874563210',
            'especialidad' => 'Ortodoncia',
            'direccion' => 'calle de la salud',
            'email' => 'doctor1@doctor.com',
            'user_id' => '3'
        ]);


        Consultorio::create([
            'nombre' => 'Consultorio 1',
            'direccion' => 'Consultorio de ortodoncia',
            'telefono' => '9874563210',
            'email' => 'cosnult1@consul.com',
            'horario_atencion' => 'lunes a viernes de 8:00 a 17:00',
            'tipo_consultorio' => 'Privado',
            'especialidad' => 'Ortodoncia',
            'ciudad' => 'Ciudad de la salud',
            'capacidad' => '10',
            'estado' => 'Activo',
            'observaciones' => 'Consultorio de ortodoncia',
            'ubicacion' => 'Calle de la salud',

        ]);

        Consultorio::create([
            'nombre' => 'Consultorio 2',
            'direccion' => 'Consultorio de ortopedia',
            'telefono' => '9874573210',
            'email' => 'cosnult2@consul.com',
            'horario_atencion' => 'lunes a viernes de 8:00 a 17:00',
            'tipo_consultorio' => 'Publico',
            'especialidad' => 'Ortodoncia',
            'ciudad' => 'Ciudad de la salud',
            'capacidad' => '10',
            'estado' => 'Activo',
            'observaciones' => 'Consultorio de ortodoncia',
            'ubicacion' => 'Calle de la salud',
        ]);

        Consultorio::create([
            'nombre' => 'Consultorio 3',
            'direccion' => 'Consultorio de ortopedia',
            'telefono' => '9847773210',
            'email' => 'cosnult3@consul.com',
            'horario_atencion' => 'lunes a viernes de 8:00 a 17:00',
            'tipo_consultorio' => 'Privado',
            'especialidad' => 'Ortodoncia',
            'ciudad' => 'Ciudad de la salud',
            'capacidad' => '10',
            'estado' => 'Activo',
            'observaciones' => 'Consultorio de ortodoncia',
            'ubicacion' => 'Calle de la salud',
        ]);


        User::create([
            'name' => 'Doctor2',
            'email' => 'doctor2@doctor.com',
            'password' => bcrypt('doctor123'),
        ])->assignRole('doctor');

        Doctor::create([
            'nombres' => 'Doctor2',
            'apellidos' => 'Dos',
            'cedula' => '1234586890',
            'telefono' => '9874563210',
            'especialidad' => 'Ortodoncia',
            'direccion' => 'calle de la salud',
            'email' => 'doctor2@doctor.com',
            'user_id' => '4'
        ]);

        User::create([
            'name' => 'Doctor3',
            'email' => 'doctor3@doctor.com',
            'password' => bcrypt('doctor123'),
        ])->assignRole('doctor');

        Doctor::create([
            'nombres' => 'Doctor3',
            'apellidos' => 'Tres',
            'cedula' => '1238567890',
            'telefono' => '9874563210',
            'especialidad' => 'Ortodoncia',
            'direccion' => 'calle de la salud',
            'email' => 'doctor3@doctor.com',
            'user_id' => '5'
        ]);

        $this->call([PacienteSeeder::class]);

        Horario::create([
            'dia' => 'Lunes',
            'hora_inicio' => '08:00:00',
            'hora_fin' => '12:00:00',
            'consultorio_id' => 1,
            'doctor_id' => 1,
        ]);

        Config::create([
            'nombre'    => 'CLÍNICA DENTAL HILARI',
            'direccion' => 'CALLE MOLINOS NRO 200',
            'telefono'  => '477 48 744',
            'email'    => 'infoclinicahilari@gmail.com',
            'logo'      => 'logos/BAaMiuyHHGWAifaWLIWaEhnZcRANInuUmCMnk7TD.jpg',
        ]);
    }
}
