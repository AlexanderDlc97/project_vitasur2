<?php

namespace App\Exports;

use App\Models\Producto;
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

class BienExportFecha implements FromView, WithColumnWidths, WithCustomStartCell, WithTitle
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     //
    // }

    protected $fi , $ff, $fi_i, $ff_f;

    public function __construct($fi , $ff, $fi_i, $ff_f)
    {
        $this->inicio = $fi;
        $this->fin = $ff;
        $this->inicio_i = $fi_i;
        $this->fin_f = $ff_f;
    }
    public function view(): View
    {
        $this->inicio;
        $this->fin;
        if(Auth::user()->role_id == '1'){
            $admin_medicamentos = Producto::whereBetween('created_at', [$this->inicio,$this->fin])->get();
        }if(Auth::user()->role_id == '4'){
            $admin_medicamentos = Producto::whereBetween('created_at', [$this->inicio,$this->fin])->where('sede_id',Auth::user()->persona->sede_id)->get();
        }if(Auth::user()->role_id == '5'){
            $admin_medicamentos = Producto::where('tipo_producto','Medicamento')->whereBetween('created_at', [$this->inicio,$this->fin])->where('sede_id',Auth::user()->persona->sede_id)->get();
        }
        return view('ADMINISTRADOR.REPORTES.medicamentos.xlsx_lista_medicamentos', compact('admin_medicamentos'));
    }

    public function title(): string
    {
    	return 'BIENES '.$this->inicio_i.' AL '.$this->fin_f;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10.78, 'B' => 12, 'C' => 15, 'D' => 15, 'E' => 40, 'F' => 20, 'G' => 40, 'H' => 15, 'I' => 15
        ];
    }
    
    public function startCell(): string
    {
        return 'A1';
    }
}
