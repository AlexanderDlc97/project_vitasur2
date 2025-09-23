<?php

namespace App\Exports;

use App\Models\Cobro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class CobroExportFecha implements FromView, WithColumnWidths, WithCustomStartCell, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $fi , $ff, $fi_i, $ff_f, $fecha_asignada_value;

    public function __construct($fi , $ff, $fi_i, $ff_f, $fecha_asignada_value)
    {
        $this->inicio = $fi;
        $this->fin = $ff;
        $this->inicio_i = $fi_i;
        $this->fin_f = $ff_f;
        $this->fecha_asignada_value = $fecha_asignada_value;
    }
    public function view(): View
    {
        $this->inicio;
        $this->fin;
        if(Auth::user()->role_id == '1'){
            if($this->fecha_asignada_value == 'fecha_asignada' || $this->fecha_asignada_value == ''){
                $cobros = Cobro::all();
            }else{
                $cobros = Cobro::whereBetween('created_at', [$this->inicio,$this->fin])->get();
            }
        }if(Auth::user()->role_id == '4'){
            if($this->fecha_asignada_value == 'fecha_asignada'){
                $cobros = Cobro::where('sede_id',Auth::user()->persona->sede_id)->get();
            }else{
                $cobros = Cobro::where('sede_id',Auth::user()->persona->sede_id)->whereBetween('created_at', [$this->inicio,$this->fin])->get();
            }
        }
        return view('ADMINISTRADOR.REPORTES.cobro.xlsx_lista_cobro', compact('cobros'));
    }

    public function title(): string
    {
    	return 'AT '.$this->inicio_i.' AL '.$this->fin_f;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10.78, 'B' => 20, 'C' => 35, 'D' => 20, 'E' => 25, 'F' => 15, 'G' => 15
        ];
    }
    
    public function startCell(): string
    {
        return 'A1';
    }
}
