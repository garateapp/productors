<?php

namespace App\Exports;

use App\Models\Proceso;
use App\Models\User;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ProcesosExport implements FromCollection, WithCustomStartCell, WithMapping, WithColumnFormatting, WithHeadings
{   use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $user;

    public function __construct($user_id) {
        $this->user = User::find($user_id);
    }

    public function collection()
    {
        return Proceso::where('agricola',$this->user->name)->where('temporada','actual')
                ->latest('n_proceso')->get();
    }

    public function startCell(): string
    {
        return 'A2';
    }
    public function heading(): array
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
            'Merma'
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

        ];
    }
    public function columnFormats(): array
    {
        return [
            'E'=>'dd/mm/yyyy'
        ];
    }
}
