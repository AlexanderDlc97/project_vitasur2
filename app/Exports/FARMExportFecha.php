<?php

namespace App\Exports;

use App\Models\Farmacia;
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

class FARMExportFecha implements FromView, WithColumnWidths, WithCustomStartCell, WithTitle
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Farmacia::all();
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
            $admin_farmacia = Farmacia::whereBetween('created_at', [$this->inicio,$this->fin])->get();
        }if(Auth::user()->role_id == '5'){
            $admin_farmacia = Farmacia::where('sede_id',Auth::user()->persona->sede_id)->whereBetween('created_at', [$this->inicio,$this->fin])->get();
        }
        return view('ADMINISTRADOR.REPORTES.farmacia.xlsx_lista_farmacia', compact('admin_farmacia'));
    }

    public function title(): string
    {
    	return 'AT '.$this->inicio_i.' AL '.$this->fin_f;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10.78, 'B' => 12, 'C' => 15, 'D' => 20, 'E' => 40, 'F' => 15, 'G' => 15
        ];
    }
    
    public function startCell(): string
    {
        return 'A1';
    }
}
