<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimientoResource\Pages;
use App\Filament\Resources\MovimientoResource\RelationManagers;
use App\Models\Movimiento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Filament\Tables\Actions;
use Filament\Tables\Actions\BulkActionGroup;
use filament\Tables\Actions\ModelAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Card;


class MovimientoResource extends Resource
{
    protected static ?string $model = Movimiento::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
        Card::make('Llene los campos del formulario')
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
                Forms\Components\Select::make('tipo')
                    ->required()
                    ->options([
                        'ingreso' => 'Ingreso',
                        'gasto' => 'Gasto',
                    ]),
                Forms\Components\TextInput::make('monto')
                    ->required()
                    ->numeric(),
                Forms\Components\RichEditor::make('descripcion')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('fecha')
                    ->required(),
            ])->columns(2),
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
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('monto')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('fecha')
                    ->date()
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
                        'gasto' => 'Gastos',
                    ])
                    ->placeholder('Filtrar por tipo')
                    ->label('Tipo'),
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
                    ->title('Movimiento eliminada')
                    ->body('El Movimiento ha sido eliminada exitosamente.')
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
            'index' => Pages\ListMovimientos::route('/'),
            'create' => Pages\CreateMovimiento::route('/create'),
            'edit' => Pages\EditMovimiento::route('/{record}/edit'),
        ];
    }
}
