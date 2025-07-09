<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Usuarios', \App\Models\User::count())
                ->color('primary')
                ->icon('heroicon-o-users')
                ->description('Total de usuários registrados')
                ->color('info')
                ->chart([1,2,3,4,5,6,7,8,9,10]),
            Stat::make('Categorias', \App\Models\Categoria::count())
                ->color('primary')
                ->icon('heroicon-o-briefcase')
                ->description('Total de categorias Creada')
                ->chart([1,15,30,45,60]),
            Stat::make('Movimientos', \App\Models\Movimiento::where('tipo','ingreso')->sum('monto') . '$')
                ->color('primary')
                ->icon('heroicon-o-currency-dollar')
                ->description('Total de Ingresos')
                ->color('success')
                ->chart([1,5,3,10,20,6,15,11,3,19]),

        ];
    }
}
