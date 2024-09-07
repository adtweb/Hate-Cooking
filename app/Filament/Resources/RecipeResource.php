<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers;
use App\Models\Recipe;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $pluralModelLabel = 'Рецепты';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Рецепты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('value')
                    ->label('Название')
                    ->minLength(3)
                    ->maxLength(255)
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('Автор')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\CheckboxList::make('categories')
                    ->label('Категории')
                    ->relationship(titleAttribute: 'value')
                    ->columns(2)
                    ->gridDirection('row'),
                Forms\Components\CheckboxList::make('qualities')
                    ->label('Свойства')
                    ->relationship(titleAttribute: 'value')
                    ->columns(2)
                    ->gridDirection('row'),
                Forms\Components\FileUpload::make('photo_url')
                    ->label('Фотография')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('photo_url'),
                Tables\Columns\TextColumn::make('value')->label('Название'),
                Tables\Columns\TextColumn::make('user.email')->label('Автор')->searchable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Дата модификации'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->options(User::all()),
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
            RelationManagers\StepsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
}
