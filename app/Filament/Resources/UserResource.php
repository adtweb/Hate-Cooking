<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
//use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $pluralModelLabel = 'Пользователи';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Пользователи';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Имя')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email(255)
                    ->required(),
                Forms\Components\DatePicker::make('email_verified_at')
                    ->label('Дата активации')
                    ->maxDate(now()),
                Forms\Components\TextInput::make('password')
                    ->label('Пароль')
                    ->password(255)
                    ->revealable()
                    ->autocomplete(false),
                Forms\Components\Select::make('role_id')
                    ->label('Уровень доступа')
                    ->relationship('role', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('role.name')->label('Уровень доступа'),
                Tables\Columns\TextColumn::make('email_verified_at')->label('Дата активации'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role_id')
                    ->options(Role::all()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
