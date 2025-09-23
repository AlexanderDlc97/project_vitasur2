<?php

namespace App\Exports;

use App\Models\Movimientocaja;
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

class ExceldetallecajaExport implements FromView, WithStyles, WithDrawings, WithColumnWidths, WithCustomStartCell, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $regist;

    public function __construct($regist)
    {
        $this->registro = $regist;
    }

    public function view(): View
    {
        // echo '<pre>';
        // var_dump($dtcajas);
        // echo '</pre>';
        // die();
        $registrando = $this->registro->id;
        $dtcajas = Movimientocaja::where('registrocaja_id', $this->registro->id)->get();
        return view('ADMINISTRADOR.REPORTES.caja.excel.detalle_movcajaexcel', compact('dtcajas','registrando'));

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
            'A1:H8'    => [
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
            'A' => 8, 'B' => 24, 'C' => 30, 'D' => 20, 'E' => 20, 'F' => 20, 'G' => 20, 'H' => 20
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
        $drawing->setHeight(85);
        $drawing->setOffsetX(-30);
        $drawing->setOffsetY(60);
        $drawing->setCoordinates('B2');

        return $drawing;
    }
    
}
