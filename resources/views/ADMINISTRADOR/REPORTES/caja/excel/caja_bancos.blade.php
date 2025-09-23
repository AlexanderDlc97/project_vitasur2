<table id="DATOS">
    <thead class="">
        <tr>
            <th colspan="3" style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#76B82A; color:#ffffff;">KAITA INTERNATIONAL</th>
        </tr>
        <tr>
            <th colspan="3" style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold;">REPORTE DE INGRESOS Y EGRESOS BANCOS</th>
        </tr>
        <tr>
            <th style="text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid #000000;">FECHA</th>
            <th colspan="2" style="text-align: start; vertical-align: middle; border: 1px solid #000000;">{{ $fecha }}</th>
        </tr>
        <tr>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($cuentas_bancos as $c_banco)
            @php
                $banco = \App\Models\Banco::where('id', $c_banco->banco_id)->first();
                $tipo_cuenta = \App\Models\Tipocuenta::where('id', $c_banco->tipocuenta_id)->first();
                $mov_ingresos = \App\Models\Cobro::where('cuentabanco_id', $c_banco->id)->whereBetween('created_at', [$desde,$hasta])->get();
                $mov_egresos = \App\Models\Pago::where('id_egreso', $c_banco->id)->whereBetween('created_at', [$desde,$hasta])->get();
            @endphp
            <tr><td></td></tr>

            <tr>
                <td colspan="2" style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">{{ $banco->name }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#e1e1e1; color:#000000;">TIPO DE C.</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $tipo_cuenta->name }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#e1e1e1; color:#000000;">NÚMERO DE C.</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $c_banco->nro_cuenta }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#e1e1e1; color:#000000;">MONEDA</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">Soles</td>
            </tr>
            {{-- <tr>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#e1e1e1; color:#000000;">SALDO INICIAL</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $c_banco->saldo_inicial }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#e1e1e1; color:#000000;">SALDO FINAL</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $c_banco->saldo_final}}</td>
            </tr> --}}

            <tr>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#e1e1e1; color:#000000;">SALDO</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $c_banco->apertura_cuenta }}</td>
            </tr>

            <tr><td></td></tr>

            <tr>
                <td colspan="7" style="text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid #000000;">INGRESOS</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">FECHA</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">FECHA VALUTA</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">DESCRIPCIÓN OPERACIÓN</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">MONTO</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">N° OPERACIÓN</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">REFERENCIA</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;"></td>
            </tr>
            @foreach($mov_ingresos as $m_ingreso)
                <tr>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_ingreso->fecha}}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_ingreso->fecha}}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_ingreso->tipo_transaccion }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_ingreso->total_cobrado }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_ingreso->nro_operacion }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_ingreso->cliente }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_ingreso->medio_pago }}</td>
                </tr>
            @endforeach
            @if($mov_ingresos->count() >= 5) 
            @elseif($mov_ingresos->count() == 4)
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
            @elseif($mov_ingresos->count() == 3)
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
            @elseif($mov_ingresos->count() == 2)
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
            @elseif($mov_ingresos->count() == 1)
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
            @elseif($mov_ingresos->count() == 0)
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">TOTAL</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">{{ $mov_ingresos->sum('total_cobrado') }}</td>
            </tr>

            <tr><td></td></tr>

            <tr>
                <td colspan="7" style="text-align: center; vertical-align: middle; font-weight: bold; border: 1px solid #000000;">EGRESOS</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">FECHA</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">FECHA VALUTA</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">DESCRIPCIÓN OPERACIÓN</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">MONTO</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">N° OPERACIÓN</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">REFERENCIA</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;"></td>
            </tr>

            @foreach($mov_egresos as $m_egreso)
                <tr>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_egreso->fecha}}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_egreso->fecha}}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_egreso->tipo_transaccion }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_egreso->total_pagado }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_egreso->nro_operacion }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_egreso->proveedor }}</td>
                    <td style="text-align: center; vertical-align: middle; border: 1px solid #000000;">{{ $m_egreso->medio_pago }}</td>
                </tr>
            @endforeach
            @if($mov_egresos->count() >= 5) 
            @elseif($mov_egresos->count() == 4)
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
            @elseif($mov_egresos->count() == 3)
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
            @elseif($mov_egresos->count() == 2)
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
            @elseif($mov_egresos->count() == 1)
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
            @elseif($mov_egresos->count() == 0)
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                    <td style="border: 1px solid #000000;"></td>
                </tr>
            @endif

            <tr>
                <td></td>
                <td></td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">TOTAL</td>
                <td style="text-align: center; vertical-align: middle; border: 1px solid #000000; font-weight: bold; background-color:#6c757d; color:#ffffff;">{{ $mov_egresos->sum('total_pagado') }}</td>
            </tr>
            <tr>
                <td></td>
            </tr>
        @endforeach

    </tbody>
</table>