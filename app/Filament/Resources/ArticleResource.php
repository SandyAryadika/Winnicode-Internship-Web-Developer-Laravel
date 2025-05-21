<?php

namespace App\Filament\Resources;

use Illuminate\Http\Request;
use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $navigationGroup = 'Manajemen Berita';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 3;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            FileUpload::make('thumbnail')
                ->label('Thumbnail')
                ->image()
                ->required()
                ->disk('public'),

            Textarea::make('content')
                ->label('Konten Artikel')
                ->required(),

            TextInput::make('title')
                ->label('Judul Artikel')
                ->required()
                ->maxLength(255),

            Select::make('category_id')
                ->label('Kategori')
                ->options(Category::all()->pluck('name', 'id'))
                ->required()
                ->placeholder('Pilih Kategori'),

            Select::make('status')
                ->label('Status')
                ->options([
                    'draft' => 'Draft',
                    'pending' => 'Pending',
                    'published' => 'Published',
                ])
                ->default('draft')
                ->required(),

            Select::make('author_id')
                ->label('Penulis')
                ->options(Author::all()->pluck('name', 'id'))
                ->required()
                ->searchable()
                ->placeholder('Pilih Penulis'),

            DateTimePicker::make('published_at')
                ->label('Tanggal Publikasi')
                ->required()
                ->nullable(),

            Toggle::make('is_hot')
                ->label('Berita Hangat')
                ->helperText('Aktifkan jika artikel ini merupakan berita yang sedang tren atau penting.')
                ->default(false),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('title')
                ->label('Judul Artikel')
                ->searchable(),

            TextColumn::make('category.name')
                ->label('Kategori'),

            TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    'draft' => 'secondary',
                    'pending' => 'warning',
                    'published' => 'success',
                    default => 'gray',
                })
                ->formatStateUsing(fn(string $state): string => match ($state) {
                    'draft' => 'Draft',
                    'pending' => 'Pending',
                    'published' => 'Published',
                    default => ucfirst($state),
                }),

            ImageColumn::make('thumbnail')
                ->label('Thumbnail')
                ->disk('public'),

            TextColumn::make('created_at')
                ->label('Tanggal Dibuat')
                ->dateTime(),

            TextColumn::make('author.name')
                ->label('Penulis'),

            TextColumn::make('updated_at')
                ->label('Tanggal Diupdate')
                ->dateTime(),
        ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->color('info'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
