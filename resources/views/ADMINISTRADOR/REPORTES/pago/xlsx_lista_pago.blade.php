<table id="DATOS">
    <thead class="">
        <tr>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">N°</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">operación</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Nombre o razón social</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Cuenta</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Medio Pago</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Fecha</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $contador = 1;
        @endphp
        @foreach ($pagos as $admin_pago)
            <tr>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $contador }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $admin_pago->nro_operacion }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $admin_pago->cliente }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $admin_pago->ingreso }}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $admin_pago->medio_pago}}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ $admin_pago->fecha}}</td>
                <td style="border: 1px solid #000000; vertical-align: middle;">{{ number_format($admin_pago->total_cobrado, 2, '.', ',') }}</td>
            </tr>
            @php
                $contador++;
            @endphp
        @endforeach
    </tbody>
</table>