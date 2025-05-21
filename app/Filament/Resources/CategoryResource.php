<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationLabel = 'Kategori';
    protected static ?string $navigationGroup = 'Manajemen Berita';
    protected static ?string $navigationIcon = 'heroicon-o-bars-4';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('icon')
                    ->label('Ikon Kategori')
                    ->image()
                    ->required()
                    ->directory('category-icons')
                    ->disk('public')
                    ->visibility('public'),

                Select::make('name')
                    ->label('Nama Kategori')
                    ->required()
                    ->options([
                        'Politik' => 'Politik',
                        'Ekonomi & Bisnis' => 'Ekonomi & Bisnis',
                        'Olahraga' => 'Olahraga',
                        'Hiburan & Selebriti' => 'Hiburan & Selebriti',
                        'Kesehatan & Gaya Hidup' => 'Kesehatan & Gaya Hidup',
                        'Teknologi' => 'Teknologi',
                        'Pendidikan' => 'Pendidikan',
                    ])
                    ->searchable(),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(Category::class, 'slug')
                    ->columnSpan(2)
                    ->hidden(),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->nullable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon')->label('Ikon')->disk('public'),
                TextColumn::make('name')->label('Nama Kategori')->searchable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(30)
                    ->tooltip(fn($record) => $record->description)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->color('info'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
