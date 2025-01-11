<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Resource Management';

    protected static ?string $recordTitleAttribute = 'first_name';

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
               Forms\Components\Section::make('Employee Details')
                  ->description('Put the Contact Name Details in.')
                  ->schema([
                    Forms\Components\TextInput::make('first_name')
                       ->required()
                       ->maxLength(255)
                       ->default(null),
                    Forms\Components\TextInput::make('last_name')
                       ->required()
                       ->maxLength(255)
                       ->default(null),
                    Forms\Components\DatePicker::make('dob')
                        ->required()
                        ->default(null),
                    Forms\Components\Select::make('gender')
                    ->options([
                        'Male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                        ])
                    ->required()
                    ->default(null),
                    ])->columns(3),
                Forms\Components\Section::make('Contact Details')
                  ->description('Put the Contact Details in.')
                  ->schema([
                      Forms\Components\TextInput::make('email')
                        ->required()
                        ->email()
                        ->maxLength(255)
                        ->default(null),
                      Forms\Components\TextInput::make('phone')
                        ->required()
                        ->tel()
                        ->maxLength(255)
                        ->default(null),
                      Forms\Components\TextInput::make('address')
                        ->required()
                        ->maxLength(255)
                        ->default(null),
                      Forms\Components\TextInput::make('city')
                        ->required()
                        ->maxLength(255)
                        ->default(null),
                      ])->columns(3),
                Forms\Components\Section::make('Other Details')
                  ->description('Put the Other Details in.')
                  ->schema([
                      Forms\Components\DatePicker::make('start_date')
                        ->required()
                        ->default(null),
                      Forms\Components\TextInput::make('position')
                        ->required()
                        ->maxLength(255)
                        ->default(null),
                      ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('position')
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
                           ->title('Customer Deleted.')
                           ->body('Customer has been deleted successfully.')
                      )
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
