<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
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

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

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
               Forms\Components\Section::make('Personal Details')
                  ->description('Put the Contact Name Details in.')
                  ->schema([
                    Forms\Components\TextInput::make('Customer_name')
                       ->required()
                       ->maxLength(255)
                       ->default(null),
                    Forms\Components\TextInput::make('Customer_address')
                       ->required()
                       ->maxLength(255)
                       ->default(null),
                    Forms\Components\TextInput::make('Customer_contact_no')
                       ->required()
                       ->maxLength(255)
                       ->default(null),
                    Forms\Components\TextInput::make('Customer_email')
                       ->required()
                       ->email()
                       ->maxLength(255)
                       ->default(null),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Customer_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Customer_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Customer_contact_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Customer_email')
                    ->searchable(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
