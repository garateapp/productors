<?php

namespace App\Exports;

use App\Models\Detalle;
use DateTime;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DanostotalExport implements FromCollection, WithCustomStartCell, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{   use Exportable;

    protected $especie;

    public function __construct($especie)
    {
        $this->especie = $especie;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {   if($this->especie){
            return Detalle::whereHas('calidad.recepcion', function ($query) {
                $query->where('temporada', 'actual')->where('n_especie', $this->especie);
            })->get();
        }else{
            return Detalle::whereHas('calidad.recepcion', function ($query) {
                $query->where('temporada', 'actual');
            })->get();
        }
        
    }

    public function startCell(): string
    {
        return 'A1';
    }
    public function headings(): array
    {   
        return[
            'Id',
            'Lote', 
            'especie',
            'Embalaje',
            'Variedad',
            'Tipo Item',
            'Detalle Item',
            'Cantidad',
            '% Muestra',
            'Cantidad Muestra',
            'Fecha'
           
        ];
    }

    public function map($detalle): array
    {   
        if ($detalle->tipo_detalle=='cc') {
            return [
                $detalle->calidad->recepcion->id_g_recepcion,
                $detalle->calidad->recepcion->numero_g_recepcion,
                $detalle->calidad->recepcion->n_especie,
                $detalle->embalaje,
                $detalle->variedad,
                $detalle->tipo_item,
                $detalle->detalle_item,
                $detalle->valor_ss,
                $detalle->porcentaje_muestra,
                $detalle->cantidad,
                date('d M Y', strtotime($detalle->fecha))
            

            ];
        } else {
            return [
                $detalle->calidad->recepcion->id_g_recepcion,
                $detalle->calidad->recepcion->numero_g_recepcion,
                $detalle->embalaje,
                $detalle->temperatura,
                $detalle->tipo_item,
                $detalle->detalle_item,
                $detalle->valor_ss,
                $detalle->porcentaje_muestra,
                $detalle->cantidad,
                date('d M Y', strtotime($detalle->fecha))

            ];
        }
        
           
    }
    public function columnFormats(): array
    {
        return [
            'E'=>'dd/mm/yyyy'
        ];
    }
}
