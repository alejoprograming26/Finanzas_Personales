<?php

namespace App\Filament\Resources\PresupuestoResource\Pages;

use App\Filament\Resources\PresupuestoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditPresupuesto extends EditRecord
{
    protected static string $resource = PresupuestoResource::class;

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
            ->title('Presupuesto actualizado')
            ->body('El Presupuesto ha sido actualizado exitosamente.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->title('Presupuesto eliminado')
                        ->body('El Presupuesto ha sido eliminado exitosamente.')
                        ->success()
                ),
        ];
    }
}
