<table id="DATOS">
    <thead class="">
        <tr>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">N°</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">CÓDIGO</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">TIPO</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">FECHA</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">PACIENTE</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">ESPECIALIDAD</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">PROFESIONAL</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">COSTO</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">ESTADO</th>
        </tr>
    </thead>
    <tbody>
        @php
            $contador = 1;
        @endphp
        @foreach ($admin_atenciones as $item)
            <tr>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $contador }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $item->codigo }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $item->tipo }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $item->created_at->format('d/m/Y') }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $item->paciente->persona->name.' '.$item->paciente->persona->surnames }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $item->especialidad->name }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $item->medico->persona->name.' '.$item->medico->persona->surnames }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $item->especialidad->costo }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle; text-transform: uppercase">{{ $item->estado }}</td>
            </tr>
            @php
                $contador++;
            @endphp
        @endforeach
    </tbody>
</table>