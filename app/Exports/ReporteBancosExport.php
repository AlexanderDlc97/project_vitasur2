<?php

namespace App\Exports;

use App\Models\Caja;
use App\Models\Cuentabancaria;
use App\Models\Cuentasbanco;
use App\Models\Movimientocaja;
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

class ReporteBancosExport implements FromView, WithTitle, WithColumnWidths
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Caja::all();
    // }
    protected $fi , $ff, $fi_i;

    public function __construct($fi , $ff, $fi_i)
    {
        $this->inicio = $fi;
        $this->fin = $ff;
        $this->inicio_i = $fi_i;
    }
    public function view(): View
    {
        $this->inicio;
        $this->fin;
        $fecha = $this->inicio_i;
        $desde = $this->inicio;
        $hasta = $this->fin;
        $caja_bancos = Movimientocaja::whereBetween('created_at', [$this->inicio,$this->fin])->get();
        $cuentas_bancos = Cuentabancaria::where('sede_id', Auth::user()->persona->sede_id)->get();
        return view('ADMINISTRADOR.REPORTES.caja.excel.caja_bancos', compact('caja_bancos', 'cuentas_bancos', 'fecha', 'desde', 'hasta'));
    }

    public function title(): string
    {
    	return 'REPORTE BANCOS '.$this->inicio_i;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15, 'B' => 25, 'C' => 35, 'D' => 15, 'E' => 15, 'F' => 35, 'G' => 15, 'H' => 10.78, 'I' => 10.78, 'J' => 10.78, 'K' => 10.78, 'L' => 10.78, 'M' => 10.78, 'N' => 10.78, 'O' => 10.78, 'P' => 10.78, 'Q' => 10.78, 'R' => 10.78
        ];
    }
}
