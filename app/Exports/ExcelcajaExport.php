<?php

namespace App\Exports;

use App\Models\Cuentabancaria;
use App\Models\Cuentasbanco;
use App\Models\Registrocaja;
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

class ExcelcajaExport implements FromView, WithStyles, WithDrawings, WithColumnWidths, WithCustomStartCell, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $fi , $ff;

    public function __construct($fi , $ff)
    {
        $this->inicio = $fi;
        $this->fin = $ff;
    }

    public function view(): View
    {
        $fechac_ini = $this->inicio;
        $fechac_fn = $this->fin;
        // echo '<pre>';
        // var_dump($fechac_ini,$fechac_fn);
        // echo '</pre>';
        // die();
        if(Gate::allows(Auth::user()->role_id == '1')){
            $banco = Cuentabancaria::all();
            return view('ADMINISTRADOR.REPORTES.CAJA.excel.caja_excel', compact('banco','fechac_ini','fechac_fn'));
        }if((Auth::user()->role_id == '4')){
            $banco = Cuentabancaria::where('sede_id', Auth::user()->persona->sede_id)->get();
            return view('ADMINISTRADOR.REPORTES.caja.excel.caja_excel', compact('banco','fechac_ini','fechac_fn'));
        }else{
            abort(403);
        };

    }
    public function title(): string
    {
    	return 'Comprob_ventas';
    }
    public function styles(Worksheet $sheet)
    {
        $style = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        );
        
        return [
            // Style the first row as bold text.
            'A1:H9'    => [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => ['argb' => '76B82A'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            'D6:E6' => [
                'underline'       =>  true,
            ],
            'A9:H9'    => [
                // 'borders' => [
                //     'outline' => [
                //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                //         'color' => ['argb' => 'EE1A24'],
                //     ],
                // ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];

    }
    public function columnWidths(): array
    {
        return [
            'A' => 8, 'B' => 35, 'C' => 32, 'D' => 20, 'E' => 20, 'F' => 20, 'G' => 20, 'H' => 20
        ];
    }
    
    public function startCell(): string
    {
        return 'B2';
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('images/icon.png'));
        $drawing->setHeight(75);
        $drawing->setOffsetX(-40);
        $drawing->setOffsetY(60);
        $drawing->setCoordinates('B2');

        return $drawing;
    }
    
}
