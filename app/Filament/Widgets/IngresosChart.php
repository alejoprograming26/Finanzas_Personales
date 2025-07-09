<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class IngresosChart extends ChartWidget
{
    protected static ?string $heading = 'Reportes de Ingresos';


    protected function getData(): array

    {
         $data=\App\Models\Movimiento::where('tipo', 'ingreso')
        ->selectRaw('MONTH(fecha) as mes, SUM(monto) as total')
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();
         $meses=['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
         $totalRenueve= array_fill(0, 12, 0);
            foreach ($data as $item) {
                $totalRenueve[$item->mes - 1] = $item->total;
            }
        return [
            'datasets' => [
                [
                    'label' => 'Ingresos',
                    'data' => $totalRenueve,
                    'borderColor' => '#4CAF50',
                    'backgroundColor' => 'rgba(124, 255, 128, 0.2)',

                ],
            ],
            'labels' => $meses,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
