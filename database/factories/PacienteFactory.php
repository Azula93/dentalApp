<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero_historia'          => $this->faker->unique()->numerify('HC-####'),
            'nombres'                  => $this->faker->firstName,
            'apellidos'                => $this->faker->lastName,
            'di'                       => $this->faker->unique()->numerify('##########'),
            'edad'                     => $this->faker->numberBetween(0, 99),
            'fecha_nacimiento'         => $this->faker->date('Y-m-d', '2005-01-01'),
            'estado_civil'             => $this->faker->randomElement(['soltero', 'casado', 'union libre', 'divorciado', 'viudo']),
            'sexo'                     => $this->faker->randomElement(['M', 'F']),
            'ocupacion'                => $this->faker->jobTitle,
            'direccion_residencia'     => $this->faker->address,

            'celular'                  => $this->faker->phoneNumber,
            'email'                    => $this->faker->unique()->safeEmail,
            'acudiente'                => $this->faker->name,
            'parentesco'               => $this->faker->randomElement(['Padre', 'Madre', 'Cónyuge', 'Hermano', 'Hijo', 'Otro']),
            'ocupacion_acudiente'      => $this->faker->jobTitle,
            'correo_acudiente'       => $this->faker->unique()->safeEmail,
            'celular_acudiente'        => $this->faker->phoneNumber,
            'eps'                      => $this->faker->company,
            'tipo_vinculacion'         => $this->faker->randomElement(['Cotizante', 'Beneficiario', 'Subsidiado']),
            'servicio_urgencias'       => $this->faker->company,
            'ultima_visita_odontologo' => $this->faker->date('Y-m-d'),
            'ultimo_tratamiento'       => $this->faker->sentence,
            'como_se_entero'           => $this->faker->sentence,
            'tipo_sangre'              => $this->faker->randomElement(['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-']),

        ];
    }
}
