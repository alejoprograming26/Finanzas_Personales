<?php

namespace App\Filament\Resources\MovimientoResource\Pages;

use App\Filament\Resources\MovimientoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateMovimiento extends CreateRecord
{
    protected static string $resource = MovimientoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

      protected function getCreatedNotification(): ?Notification
    {
        return null;
    }

    protected function afterCreate()
    {
        Notification::make()
            ->title('Movimiento creado')
            ->body('El Movimiento ha sido creada exitosamente.')
            ->success()
            ->send();
    }


    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Registrar')
                ->color('success'),
            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('danger'),
        ];
    }
}
