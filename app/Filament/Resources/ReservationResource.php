<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Notifications\Notification;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Service Management';

    protected static ?string $recordTitleAttribute = 'customer_id';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Reservation Details')
                  ->description('Put the Reservation Details in.')
                  ->schema([
                       Forms\Components\Select::make('branch_id')
                           ->relationship(name: 'branch', titleAttribute: 'branch_location')
                           ->searchable()
                           ->preload() 
                           ->required(),
                       Forms\Components\TextInput::make('table_no')
                           ->maxLength(255)
                           ->default(null)
                           ->required(),
                        Forms\Components\TextInput::make('customer_contact_no')
                           ->maxLength(255)
                           ->default(null)
                           ->required(),
                        Forms\Components\TextInput::make('customer_name')
                           ->maxLength(255)
                           ->default(null)
                           ->required(),
                        Forms\Components\DatePicker::make('date')
                           ->required(),
                        Forms\Components\TimePicker::make('time')
                           ->required(),
                  ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branch.branch_location')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('table_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_contact_no')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name'),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BooleanColumn::make('is_completed')
                    ->label('Completed')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('is_featured')
                     ->toggle()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                       ->success()
                       ->title('Appointment Deleted.')
                       ->body('Appointment has been deleted successfully.')
                  ),
                Tables\Actions\Action::make('complete')
                    ->label('Complete')
                    ->action(function ($record) {
                        $record->update(['is_completed' => true]);
                        Notification::make()
                            ->success()
                            ->title('Reservation Completed')
                            ->body('The reservation has been marked as completed.')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->color('success')
                    ->icon('heroicon-o-check'),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'view' => Pages\ViewReservations::route('/{record}'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
