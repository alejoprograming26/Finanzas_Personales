<?php

namespace App\Filament\Resources\MovimientoResource\Pages;

use App\Filament\Resources\MovimientoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditMovimiento extends EditRecord
{
    protected static string $resource = MovimientoResource::class;

      protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

   protected function getSavedNotification(): ?Notification
    {
        return null;
    }
    protected function afterSave()
    {
        Notification::make()
            ->title('Movimiento actualizado')
            ->body('El movimiento ha sido actualizado exitosamente.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->title('Categoria eliminada')
                        ->body('La categoria ha sido eliminada exitosamente.')
                        ->success()
                ),
        ];
    }

}
