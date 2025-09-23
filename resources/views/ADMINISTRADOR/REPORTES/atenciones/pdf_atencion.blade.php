<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VITASUR | ATENCION - {{ $admin_atencione->codigo }}</title>
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.css') }}">
    <style>
        @font-face
        {
            font-family: 'Roboto', sans-serif;
            font-style: normal;
            font-weight: normal;
            src: local('Roboto'), url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap') format('truetype');
        }
    
        @page
        {
            margin: 0cm 0cm;
        }

        .page-break
        {
            page-break-after: always;
        }
        
        body
        {
            font-family: 'Roboto', sans-serif;
            margin-top: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 1cm;
            background-image: url({{ public_path('images/logo-light.png') }});
            background-repeat: no-repeat;
            background-size: 100% auto;
            background-attachment: fixed;
            background-position: center;
        }

        .text-white
        {
            color: #fff;
        }
        
        .page-break
        {
            page-break-after: always;
        }

        .contenido
        {
            border: 1px solid #000;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="contenido">
        <table class="w-100 px-1">
            <td style="width: 20%">
                <p class="my-1 fw-bold text-uppercase">Datos del paciente</p>
            </td>
            <td style="width: 80%">
                <p class="my-1 fw-bold text-primary">{{ 'AT-'.$admin_atencione->codigo.' | '.\Carbon\Carbon::parse($admin_atencione->fecha)->format('d-m-Y'). ' ' .\Carbon\Carbon::parse($admin_atencione->hora)->format('H:i') }}</p>
            </td>
        </table>
        <table class="w-100 border-top border-dark"></table>
        <table class="w-100 px-1">
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Nombres y apellidos</td>
                <td style="width: 50%">{{ $admin_atencione->paciente->persona->name. ' ' .$admin_atencione->paciente->persona->surnames }}</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">Identificación</td>
                <td style="width: 15%">{{ $admin_atencione->paciente->persona->identificacion. ' - ' .$admin_atencione->paciente->persona->nro_identificacion }}</td>
            </tr>
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Dirección</td>
                <td style="width: 50%">{{ $admin_atencione->paciente->persona->direccion }}</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">Contacto</td>
                <td style="width: 15%">{{ $admin_atencione->paciente->persona->nro_contacto }}</td>
            </tr>
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Responsable</td>
                <td style="width: 50%">{{ $admin_atencione->paciente->responsable }}</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">Historia Clínica</td>
                <td style="width: 15%">{{ $admin_atencione->paciente->historia_clinica }}</td>
            </tr>
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Estado civil</td>
                <td style="width: 50%">{{ $admin_atencione->paciente->persona->estado_civil }}</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">Sexo</td>
                <td style="width: 15%">{{ $admin_atencione->paciente->persona->sexo }}</td>
            </tr>
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Ocupación</td>
                <td style="width: 50%">{{ $admin_atencione->paciente->ocupacion }}</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">F. N.</td>
                <td style="width: 15%">@if(empty($admin_atencione->paciente->persona->fecha_nacimiento))@else{{ \Carbon\Carbon::parse($admin_atencione->paciente->persona->fecha_nacimiento)->format('d-m-Y').' - ('.$edad.' años)'}}@endif</td>
            </tr>
        </table>
        <table class="w-100 border-top border-dark"></table>
        <table class="w-100 px-1">
            <td style="width: 20%">
                <p class="my-1 fw-bold text-uppercase">Acto médico</p>
            </td>
            <td style="width: 80%">
                <p class="my-1 fw-bold text-primary">{{ 'AT-'.$admin_atencione->codigo.' | '.\Carbon\Carbon::parse($admin_atencione->fecha)->format('d-m-Y'). ' ' .\Carbon\Carbon::parse($admin_atencione->hora)->format('H:i') }}</p>
            </td>
        </table>
        <table class="w-100 border-top border-dark"></table>
        <table class="w-100 px-1">
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Código</td>
                <td style="width: 50%">{{ $admin_atencione->codigo }}</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">Tipo</td>
                <td style="width: 15%">{{ $admin_atencione->tipo }}</td>
            </tr>
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Especialidad</td>
                <td style="width: 50%">{{ $admin_atencione->especialidad->name }}</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">Nro. Cita</td>
                <td style="width: 15%">@if(empty($admin_atencione->cita_id))@else{{ $admin_atencione->cita->codigo }}@endif</td>
            </tr>
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Profesional</td>
                <td style="width: 50%">{{ $admin_atencione->medico->persona->name. ' ' .$admin_atencione->medico->persona->surnames }}</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">Fecha | Hora</td>
                <td style="width: 15%">{{ \Carbon\Carbon::parse($admin_atencione->fecha)->format('d-m-Y'). ' | ' .\Carbon\Carbon::parse($admin_atencione->hora)->format('H:i') }}</td>
            </tr>
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Estado</td>
                <td style="width: 50%">@if($admin_atencione->estado == 'En atención')<span class="badge text-uppercase small bg-success border-0">{{ $admin_atencione->estado }}</span>@else<span class="badge text-uppercase small bg-dark border-0">{{ $admin_atencione->estado }}</span>@endif</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">Duración</td>
                <td style="width: 15%">{{ $admin_atencione->duracion }} MIN.</td>
            </tr>
        </table>
        <table class="w-100 border-top border-dark"></table>
        <table class="w-100 px-1">
            <td style="width: 20%">
                <p class="my-1 fw-bold text-uppercase">Consulta</p>
            </td>
            <td style="width: 80%">
                <p class="my-1 fw-bold text-primary">{{ 'AT-'.$admin_atencione->codigo.' | '.\Carbon\Carbon::parse($admin_atencione->fecha)->format('d-m-Y'). ' ' .\Carbon\Carbon::parse($admin_atencione->hora)->format('H:i') }}</p>
            </td>
        </table>
        <table class="w-100 border-top border-dark"></table>
        @php
            $consulta = \App\Models\Consulta::where('atencion_id', $admin_atencione->id)->first();
        @endphp
        @if($admin_atencione->paciente->persona->sexo == "Mujer")
            <table class="w-100 px-1">
                <td class="text-uppercase fw-bold small" style="width: 20%">¿Gestando?</td>
                <td style="width: 50%">{{ $consulta->gestando }}</td>
            </table>
        @endif
        <table class="w-100 px-1 mb-2">
            <td class="text-uppercase fw-bold small">ANTECEDENTES PATOLOGICOS</td>
        </table>
        <table class="w-100 px-1 mb-2">
            <tr>
                @if($admin_atencione->especialidad->id == '1')
                    @php
                        $cargar_consulta_select = DB::table('antecedentes_patologicos as antpat')->join('antecedentepatologico_consulta as apatocon','apatocon.antecedentepatologico_id','=','antpat.id')->select('apatocon.id','antpat.id as id_antecedente','antpat.name')->where('apatocon.consulta_id',$consulta->id)->get();
                    @endphp
                    @foreach($cargar_consulta_select as $cargar_consulta_selects)
                        <td style="width: 20%">{{$cargar_consulta_selects->name}}</td>
                    @endforeach
                @else
                @endif
                <td style="width: 80%">{{$consulta->otros}}</td>
            </tr>
        </table>
        @if($admin_atencione->especialidad->id == '1')
        <table class="w-100 px-1 mb-2">
            <tr>
                <td class="fw-bold small" style="width: 20%; font-size: 8.5px">Antecedentes familiares</td>
                <td style="width: 35%">{{ $consulta->antecedentes}}</td>
            </tr>
            <tr>
                @php
                    $cargar_habnoc_select = DB::table('habitos_nocivos as habnoc')->join('consulta_habitonocivo as habicons','habicons.habitonocivo_id','=','habnoc.id')->select('habicons.id','habnoc.id as id_habito','habnoc.name')->where('habicons.consulta_id',$consulta->id)->get();
                @endphp
                <td class="fw-bold small" style="width: 20%; font-size: 8.5px">Habitos nocivos</td>
                @foreach($cargar_habnoc_select as $cargar_habnoc_selects)
                        <td style="width: 35%">{{$cargar_habnoc_selects->name}}</td>
                    @endforeach
            </tr>
        </table>
        @endif
        <table class="w-100 px-1 mb-2">
            <tr>
                <td class="text-uppercase fw-bold small">Anamnesis</td>
            </tr>
            <tr>
                <td>{{ $consulta->anamnesis }}</td>
            </tr>
        </table>
        <table class="w-100 px-1">
            <td class="text-uppercase fw-bold small">Signos vitales</td>
        </table>
        <table class="w-100 px-1 mb-2">
            <tr>
                <td class="fw-bold small" style="width: 20%; font-size: 8.5px">Presión Arterial (mm Hg)</td>
                <td style="width: 15%">{{ $consulta->presion_arterial_uno.' / '.$consulta->presion_arterial_dos }}</td>
                <td class="fw-bold small" style="width: 20%; font-size: 8.5px">Frecuencia Cardiaca (Lat. x Min)</td>
                <td style="width: 15%">{{ $consulta->frecuencia_cardiaca }}</td>
                <td class="fw-bold small" style="width: 15%; font-size: 8.5px">Temperatura Corp. (°C)</td>
                <td style="width: 15%">{{ $consulta->temperatura_corporal }}</td>
            </tr>
            <tr>
                <td class="fw-bold small" style="width: 20%; font-size: 8.5px">Presión Venosa Central (cm H20)</td>
                <td style="width: 15%">{{ $consulta->presion_venosa_central }}</td>
                <td class="fw-bold small" style="width: 20%; font-size: 8.5px">Frecuencia Respiratoria x Min</td>
                <td style="width: 15%">{{ $consulta->Frecuencia_respiratoria }}</td>
                <td class="fw-bold small" style="width: 15%; font-size: 8.5px">Sat. O2</td>
                <td style="width: 15%">{{ $consulta->sat_o2 }}</td>
            </tr>
        </table>
        <table class="w-100 px-1">
            <td class="text-uppercase fw-bold small">Antropométria</td>
        </table>
        <table class="w-100 px-1 mb-2">
            <tr>
                <td class="fw-bold small" style="width: 20%; font-size: 8.5px">Peso (Kg)</td>
                <td style="width: 10%">{{ $consulta->peso }}</td>
                <td class="fw-bold small" style="width: 10%; font-size: 8.5px">Talla (m)</td>
                <td style="width: 10%">{{ $consulta->talla }}</td>
                <td class="fw-bold small" style="width: 10%; font-size: 8.5px">IMC (%)</td>
                <td style="width: 10%">{{ $consulta->imc }}</td>
                <td class="fw-bold small" style="width: 15%; font-size: 8.5px">Perímetro Abdom. (cm)</td>
                <td style="width: 15%">{{ $consulta->perimetro_abdominal }}</td>
            </tr>
        </table>
        <table class="w-100 border-top border-dark"></table>
        @if($admin_atencione->especialidad->id == '5')
            <table class="w-100 px-1 mb-2">
                <td class="text-uppercase fw-bold small">Aparatos y Sistemas</td>
            </table>
            <table class="w-100 px-1 mb-2">
                <tr>
                    <td class="fw-bold small" style="width: 20%; font-size: 8.5px">Pulsos Periféricos: </td>
                    <td style="width: 10%">{{ $consulta->pulsos_perifericos }}</td>
                    <td class="fw-bold small" style="width: 10%; font-size: 8.5px">Aparato Respiratorio:</td>
                    <td style="width: 10%">{{ $consulta->aparato_respiratorio }}</td>
                    <td class="fw-bold small" style="width: 10%; font-size: 8.5px">Abdomen:</td>
                    <td style="width: 10%">{{ $consulta->abdomen }}</td>
                    <td class="fw-bold small" style="width: 15%; font-size: 8.5px">Extremidades:</td>
                    <td style="width: 15%">{{ $consulta->extremidades }}</td>
                    <td class="fw-bold small" style="width: 15%; font-size: 8.5px">Electro cardiograma:</td>
                    <td style="width: 15%">{{ $consulta->electro_cardiograma }}</td>
                </tr>
            </table>
            <table class="w-100 px-1 mb-2">
                <tr>
                    <td class="text-uppercase fw-bold small">RIESGO QUIRURGICO</td>
                </tr>
                <tr>
                    <td>{{ $consulta->riesgo_quirurgico }}</td>
                </tr>
            </table>
        @endif
        @if($admin_atencione->especialidad->id == '6')
            <table class="w-100 px-1 mb-2">
                <tr>
                    <td class="text-uppercase fw-bold small">PLAN DE TRATAMIENTO</td>
                </tr>
            </table>
            <table class="w-100 px-1 mb-2">
                @php
                    $cargar_recurst_select = DB::table('recursos_terapeuticos as rectera')->join('consulta_recursoterapeutico as consrecu','consrecu.recursoterapeutico_id','=','rectera.id')->select('consrecu.id','rectera.id as id_recursot','rectera.name')->where('consrecu.consulta_id',$consulta->id)->get();
                @endphp
                <tr>
                    <td class="fw-bold small" style="width: 10%; font-size: 8.5px">Sesiones programadas: </td>
                    <td style="width: 5%">{{ $consulta->sesiones_programadas }}</td>
                    <td class="fw-bold small" style="width: 10%; font-size: 8.5px">Frecuencia de sesiones:</td>
                    <td style="width: 10%">{{ $consulta->frecuencia_sesiones }}</td>
                    <td class="fw-bold small" style="width: 10%; font-size: 8.5px">Recursos terapeuticos:</td>
                    @foreach ($cargar_recurst_select as $cargar_recurst_selects)
                    <td style="width: 10%">{{$cargar_recurst_selects->name}}</td>
                    @endforeach
                </tr>
            </table>
        @endif
        <table class="w-100 px-1 mb-2">
            <tr>
                <td class="text-uppercase fw-bold small">tratamiento</td>
            </tr>
            <tr>
                <td>{{ $consulta->tratamiento }}</td>
            </tr>
        </table>
        @if($admin_atencione->especialidad->id == '2' || $admin_atencione->especialidad->id == '3' || $admin_atencione->especialidad->id == '4')
            <table class="w-100 px-1 mb-2">
                <tr>
                    <td class="fw-bold small" style="width: 10%; font-size: 8.5px">interconsulta: </td>
                    <td style="width: 10%">{{ $consulta->interconsulta }}</td>
                    <td class="fw-bold small" style="width: 15%; font-size: 8.5px">motivo de interconsulta:</td>
                    <td style="width: 20%">{{ $consulta->motivo_interconsulta }}</td>
                    <td class="fw-bold small" style="width: 15%; font-size: 8.5px">solicitud de interconsulta:</td>
                    <td style="width: 15%">{{ $consulta->solicitud_interconsulta }}</td>
                </tr>
            </table>
        @endif
        <table class="w-100 border-top border-dark"></table>
        <table class="w-100 px-1">
            <td style="width: 20%">
                <p class="my-1 fw-bold text-uppercase">Procedimiento</p>
            </td>
            <td style="width: 80%">
                <p class="my-1 fw-bold text-primary">{{ 'AT-'.$admin_atencione->codigo.' | '.\Carbon\Carbon::parse($admin_atencione->fecha)->format('d-m-Y'). ' ' .\Carbon\Carbon::parse($admin_atencione->hora)->format('H:i') }}</p>
            </td>
        </table>
        <table class="w-100 border-top border-dark"></table>
        @php
            $procedimiento = \App\Models\Procedimiento::where('atencion_id', $admin_atencione->id)->first();
        @endphp
        <table class="w-100 px-1">
            <td class="text-uppercase fw-bold small">Registro de dolor</td>
        </table>
        <table class="w-100 px-1 mb-2">
            <tr>
                <td style="width: 20%">{{ $procedimiento?$procedimiento->registro_dolor:'' }}</td>
                <td style="width: 80%">{{ $procedimiento?$procedimiento->detalle_registro_dolor:'' }}</td>
            </tr>
        </table>
        
        <table class="w-100 px-1">
            <td class="text-uppercase fw-bold small">Diagnóstico</td>
        </table>
        <table class="w-100 px-1 mb-2" style="min-height: 100px">
            <thead>
                <tr>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">N°</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Código</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 55%">Descripción Diagnóstico</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Tipo</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Caso</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Alta</th>
                </tr>
            </thead>
            <tbody id="dt_categories" class="text-center">
                @php
                    $contador = 1;
                    $diagnosticos = \App\Models\Diagnosticoprocedimiento::where('procedimiento_id', $procedimiento?$procedimiento->id:'')->get();
                @endphp
                @if($diagnosticos)
                    @foreach($diagnosticos as $item_diagnostico)
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $item_diagnostico->diagnostico->codigo }}</td>
                            <td>{{ $item_diagnostico->diagnostico->name }}</td>
                            <td>{{ $item_diagnostico->tipo }}</td>
                            <td>{{ $item_diagnostico->caso }}</td>
                            <td>{{ $item_diagnostico->alta }}</td>
                        </tr>
                        @php
                            $contador++;
                        @endphp
                    @endforeach
                @else
                    <tr>
                        
                    </tr>
                @endif
            </tbody>
        </table>
        <table class="w-100 px-1">
            <td class="text-uppercase fw-bold small">Información adicional</td>
        </table>
        <table class="w-100 px-1 mb-2">
            <tr>
                <td style="width: 100%">{{ $procedimiento?$procedimiento->informacion_adicional:'' }}</td>
            </tr>
        </table>
        <table class="w-100 px-1">
            <td class="text-uppercase fw-bold small">Resultado Atención</td>
        </table>
        <table class="w-100 px-1 mb-2">
            <tr>
                <td style="width: 100%">{{ $procedimiento?$procedimiento->resultado_atencion:'' }}</td>
            </tr>
        </table>
        <table class="w-100 border-top border-dark"></table>
        <table class="w-100 px-1">
            <td style="width: 20%">
                <p class="my-1 fw-bold text-uppercase">Receta</p>
            </td>
            <td style="width: 80%">
                <p class="my-1 fw-bold text-primary">{{ 'AT-'.$admin_atencione->codigo.' | '.\Carbon\Carbon::parse($admin_atencione->fecha)->format('d-m-Y'). ' ' .\Carbon\Carbon::parse($admin_atencione->hora)->format('H:i') }}</p>
            </td>
        </table>
        <table class="w-100 border-top border-dark"></table>
        @php
            $receta = \App\Models\Receta::where('atencion_id', $admin_atencione->id)->first();
        @endphp
        <table class="w-100 px-1 mb-2">
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Nro. Solicitud</td>
                <td style="width: 50%">{{ $receta?$receta->nro_solicitud:'' }}</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">Fecha</td>
                <td style="width: 15%">{{ $receta?\Carbon\Carbon::parse($receta->fecha)->format('d-m-Y'):'' }}</td>
            </tr>
        </table>
        <table class="w-100 px-1 mb-2" style="min-height: 100px">
            <thead>
                <tr>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">N°</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Código</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Descripción</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Unidad</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">Via</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Cantidad</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Indicaciones</th>
                </tr>
            </thead>
            <tbody id="dt_categories" class="text-center">
                @php
                    $contador = 1;
                    $medicamentos = \App\Models\Medicamentoreceta::where('receta_id', $receta?$receta->id:'')->get();
                @endphp
                @if($medicamentos)
                    @foreach($medicamentos as $item_med)
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $item_med->producto->codigo }}</td>
                            <td>{{ $item_med->producto->name }}</td>
                            <td>{{ $item_med->producto->unidad_medida }}</td>
                            <td>{{ $item_med->via }}</td>
                            <td>{{ $item_med->cantidad }}</td>
                            <td>{{ $item_med->indicaciones }}</td>
                        </tr>
                        @php
                            $contador++;
                        @endphp
                    @endforeach
                @else
                    <tr>
                        
                    </tr>
                @endif
            </tbody>
        </table>
        <table class="w-100 px-1">
            <td class="text-uppercase fw-bold small">Información adicional</td>
        </table>
        <table class="w-100 px-1 mb-2">
            <tr>
                <td style="width: 100%">{{ $receta?$receta->informacion_adicionales:'' }}</td>
            </tr>
        </table>
        <table class="w-100 border-top border-dark"></table>
        <table class="w-100 px-1">
            <td style="width: 20%">
                <p class="my-1 fw-bold text-uppercase">Exam. Auxiliares</p>
            </td>
            <td style="width: 80%">
                <p class="my-1 fw-bold text-primary">{{ 'AT-'.$admin_atencione->codigo.' | '.\Carbon\Carbon::parse($admin_atencione->fecha)->format('d-m-Y'). ' ' .\Carbon\Carbon::parse($admin_atencione->hora)->format('H:i') }}</p>
            </td>
        </table>
        <table class="w-100 border-top border-dark"></table>
        @php
            $eauxliare = \App\Models\Eauxiliar::where('atencion_id', $admin_atencione->id)->first();
        @endphp
        <table class="w-100 px-1 mb-2">
            <tr>
                <td class="text-uppercase fw-bold small" style="width: 20%">Nro. Solicitud</td>
                <td style="width: 50%">{{ $eauxliare?$eauxliare->nro_solicitud:'' }}</td>
                <td class="text-uppercase fw-bold small" style="width: 15%">Fecha</td>
                <td style="width: 15%">{{ $eauxliare?\Carbon\Carbon::parse($eauxliare->fecha)->format('d-m-Y'):'' }}</td>
            </tr>
        </table>
        <table class="w-100 px-1 mb-2" style="min-height: 100px">
            <thead>
                <tr>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 5%">N°</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 10%">Analisis</th>
                    <th class="bg-primary text-white align-middle fw-bold text-uppercase small text-center" style="width: 30%">Tipo de Analisis</th>
                </tr>
            </thead>
            <tbody id="dt_auxili" class="text-center">
                @php
                    $contadores_anali = 1;
                    $exuliares_valor = \App\Models\Detalleeauxiliar::where('eauxiliares_id', $eauxliare?$eauxliare->id:'')->get();
                @endphp
                @if($exuliares_valor)
                    @foreach($exuliares_valor as $item_analisis)
                        <tr>
                            <td>{{ $contadores_anali }}</td>
                            <td>{{ $item_analisis->analisis}}</td>
                            <td>{{ $item_analisis->t_analisis}}</td>
                        </tr>
                        @php
                            $contadores_anali++;
                        @endphp
                    @endforeach
                @else
                    <tr>
                        
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <footer>
        <script type="text/php">
            if ( isset($pdf) ) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Roboto, sans-serif", "normal");
                    $pdf->text(270, 820, "PÁGINA $PAGE_NUM DE $PAGE_COUNT", $font, 8);
                ');
            }
        </script>
    </footer>
</body>
</html>