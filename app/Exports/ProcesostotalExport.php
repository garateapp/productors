<?php

namespace App\Exports;

use App\Models\Proceso;
use App\Models\User;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ProcesostotalExport implements FromCollection, WithCustomStartCell, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{   use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return Proceso::where('temporada','actual')
                ->latest('n_proceso')->get();
    }

    public function startCell(): string
    {
        return 'A1';
    }
    public function headings(): array
    {   
        return[
            'Agricola',
            'Nro Proceso', 
            'Especie',
            'Variedad',
            'Fecha',
            'Kg Procesados',
            'Exportación',
            'Comercial',
            'Desecho',
            'Merma',
            'Temporada'
        ];
    }

    public function map($proceso): array
    {   
        return [
            $proceso->agricola,
            $proceso->n_proceso,
            $proceso->especie,
            $proceso->variedad,
            Date::dateTimeToExcel(new DateTime($proceso->fecha)),
            $proceso->kilos_netos,
            round($proceso->exp*100/$proceso->kilos_netos, 1),
            round($proceso->comercial*100/$proceso->kilos_netos, 1),
            round($proceso->desecho*100/$proceso->kilos_netos, 1),
            round(($proceso->kilos_netos-$proceso->exp-$proceso->comercial-$proceso->desecho)*100/$proceso->kilos_netos, 1),
            'Actual',

        ];
    }
    public function columnFormats(): array
    {
        return [
            'E'=>'dd/mm/yyyy'
        ];
    }
}
