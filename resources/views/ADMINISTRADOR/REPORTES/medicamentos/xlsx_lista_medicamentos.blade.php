<table id="DATOS">
    <thead class="">
        <tr>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">N°</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Nombre</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Clasificacion</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">U. M.</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Cantidad</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Precio</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Tipo de Bien</th>
            <th style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#065892; color:#FFFFFF;">Estado</th>
        </tr>
    </thead>
    <tbody>
        @php
            $contador = 1;
        @endphp
        @foreach ($admin_medicamentos as $admin_medicamento)
            <tr>
                <td class="fw-normal text-center align-middle">{{ $contador }}</td>
                <td class="fw-normal text-center align-middle">{{ $admin_medicamento->name }}</td>
                <td class="fw-normal text-center align-middle">{{ $admin_medicamento->clasificacion?$admin_medicamento->clasificacion->name:'--' }}</td>
                <td class="fw-normal text-center align-middle">{{ $admin_medicamento->unidad_medida }}</td>
                <td class="fw-normal text-center align-middle">{{ $admin_medicamento->cantidad }}</td>
                <td class="fw-normal text-center align-middle">{{ number_format($admin_medicamento->precio_venta, 2,'.',',') }}</td>
                <td class="fw-normal text-center align-middle">{{ $admin_medicamento->tipo_producto}}</td>
                <td class="fw-normal text-center align-middle small">{{ $admin_medicamento->estado }}</td>  
            </tr>
            @php
                $contador++;
            @endphp
        @endforeach
    </tbody>
</table>