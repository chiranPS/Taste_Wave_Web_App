<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Filament\Resources\BranchResource\RelationManagers;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Service Management';

    protected static ?string $recordTitleAttribute = 'service_name';

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
                Forms\Components\Section::make('Branch Details')
                ->description('Put the Branch Details in.')
                ->schema([
                    Forms\Components\TextInput::make('branch_location')
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                    Forms\Components\TextInput::make('branch_tel_no')
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                    Forms\Components\TextInput::make('City')
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                    Forms\Components\TextInput::make('Road')
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                ])->columns(3),               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branch_location')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('branch_tel_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('City')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Road')
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
                       ->title('Branch Deleted.')
                       ->body('Branch has been deleted successfully.')
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
            'index' => Pages\ListBranch::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'view' => Pages\ViewBranches::route('/{record}'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
