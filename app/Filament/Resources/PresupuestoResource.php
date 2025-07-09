<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PresupuestoResource\Pages;
use App\Filament\Resources\PresupuestoResource\RelationManagers;
use App\Models\Presupuesto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Card;

class PresupuestoResource extends Resource
{
    protected static ?string $model = Presupuesto::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Usuario')
                            ->required()
                            ->options(
                                \App\Models\User::all()->pluck('name', 'id')
                            ),
                        Forms\Components\Select::make('categoria_id')
                            ->label('Categoria')
                            ->required()
                            ->options(
                                \App\Models\Categoria::all()->pluck('nombre', 'id')
                            ),
                        Forms\Components\TextInput::make('monto_asigando')
                            ->label('Monto Asignado')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('monto_utilizado')
                            ->required()
                            ->numeric()
                            ->default(0.00)
                            ->disabled(),
                        Forms\Components\TextInput::make('mes')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('anio')
                            ->label('Año')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->Label('Nr')
                    ->rowIndex(),
                   Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->sortable()
                    ->searchable(),
                 Tables\Columns\TextColumn::make('categoria.nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('monto_asigando')
                    ->label('Monto Asignado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('monto_utilizado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mes')
                    ->searchable(),
                Tables\Columns\TextColumn::make('anio')
                    ->label('Año')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                selectfilter::make('categoria_id')
                    ->options(
                        \App\Models\Categoria::all()->pluck('nombre', 'id')
                    )
                    ->placeholder('Filtrar por categoria')
                    ->label('Categoria'),
            ])
              ->actions([
                Tables\Actions\EditAction::make()
                ->button()
                ->icon('heroicon-o-pencil-square')
                ->label('Editar')
                ->color('success'),
                Tables\Actions\DeleteAction::make()
                ->button()
                ->icon('heroicon-o-trash')
               ->label('Eliminar')
               ->color('danger')
              ->successNotification(
                 Notification::make()
                    ->title('Presupuesto eliminado')
                    ->body('El Presupuesto ha sido eliminado exitosamente.')
                    ->success()
            ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPresupuestos::route('/'),
            'create' => Pages\CreatePresupuesto::route('/create'),
            'edit' => Pages\EditPresupuesto::route('/{record}/edit'),
        ];
    }
}
