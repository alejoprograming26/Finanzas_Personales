<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
       return $form
    ->schema([
        Card::make('Llene los campos del formulario')
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->label('Nombre de la Categoria')
                            ->placeholder('Ingrese el nombre de la categoria')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('tipo')
                    ->options([
                        'ingreso' => 'Ingreso',
                        'gastos' => 'Gasto',
                    ])
                    ->label('Tipo de Movimiento')
                            ->required(),
                    ])
            ])
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
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->searchable()
                    ->sortable(),
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
                selectFilter::make('tipo')
                    ->options([
                        'ingreso' => 'Ingreso',
                        'gastos' => 'Gasto',
                    ])
                    ->placeholder('Filtrar por tipo')
                    ->label('Tipo'),
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
                    ->title('Categoria eliminada')
                    ->body('La categoria ha sido eliminada exitosamente.')
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
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }
}
