<table id="DATOS">
    <thead class="">
        <tr>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">N°</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">CÓDIGO</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">FECHA</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">TIPO</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">PACIENTE</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">RECETA</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @php
            $contador = 1;
        @endphp
        @foreach ($admin_farmacia as $item)
            @php
                $pacientes_value = DB::table('personas as per')
                ->join('pacientes as pa','pa.persona_id','=','per.id')
                ->join('atencions as ate','ate.paciente_id','=','pa.id')
                ->join('recetas as rec','rec.atencion_id','=','ate.id')
                ->select('rec.nro_solicitud','per.name','per.surnames')
                ->where('ate.codigo',$item->atencion)->first();
            @endphp
            <tr>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $contador }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $item->codigo }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $item->created_at->format('d/m/Y') }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $item->tipo_atencion }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $pacientes_value?$pacientes_value->name.' '.$pacientes_value->surnames:'General' }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $pacientes_value?$pacientes_value->nro_solicitud:'No' }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ number_format($item->total, 2, '.',',') }}</td>
            </tr>
            @php
                $contador++;
            @endphp
        @endforeach
    </tbody>
</table>