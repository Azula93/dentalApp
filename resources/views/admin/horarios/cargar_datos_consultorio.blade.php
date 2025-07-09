<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm table-hover">
        <thead>
            <tr>
                <th class="text-center">Hora</th>
                <th class="text-center">Lunes</th>
                <th class="text-center">Martes</th>
                <th class="text-center">Miércoles</th>
                <th class="text-center">Jueves</th>
                <th class="text-center">Viernes</th>
                <th class="text-center">Sábado</th>

            </tr>
        </thead>
        <tbody>
            @php
            $hora = [
            '08:00:00 - 09:00:00',
            '09:00:00 - 10:00:00',
            '10:00:00 - 11:00:00',
            '11:00:00 - 12:00:00',
            '12:00:00 - 13:00:00',
            '13:00:00 - 14:00:00',
            '14:00:00 - 15:00:00',
            '15:00:00 - 16:00:00',
            '16:00:00 - 17:00:00',
            '17:00:00 - 18:00:00'
            ];

            $diasSemana = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
            @endphp

            @foreach($hora as $h)
            @php
            list($hora_inicio, $hora_fin) = explode(' - ', $h);
            @endphp

            <tr>
                <td>{{ $h }}</td>

                @foreach($diasSemana as $dia)
                @php
                $nombre_doctor = '';

                foreach($horarios as $horario) {
                if (strtolower($horario->dia) == strtolower($dia) && $hora_inicio >= $horario->hora_inicio && $hora_fin <= $horario->hora_fin) {
                    $nombre_doctor = $horario->doctor->nombres . ' ' . $horario->doctor->apellidos;
                    break;
                    }
                    }
                    @endphp

                    <td>{{ $nombre_doctor }}</td>
                    @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>