<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class GastosChart extends ChartWidget
{
    protected static ?string $heading = 'Reportes de Gastos';

    protected function getData(): array
    {
        $data=\App\Models\Movimiento::where('tipo', 'gasto')
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
                    'label' => 'Gastos',
                    'data' => $totalRenueve,
                    'borderColor' => '#F44336',
                    'backgroundColor' => 'rgba(255, 168, 124, 0.2)',
                    'fill' => false,
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
