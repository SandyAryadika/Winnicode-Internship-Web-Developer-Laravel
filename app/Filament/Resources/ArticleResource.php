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
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Facades\Filament;

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
                ->disk('public')
                ->columnSpan('full'),

            TextInput::make('title')
                ->label('Judul Artikel')
                ->required()
                ->maxLength(255)
                ->columnSpan('full'),

            Textarea::make('content')
                ->label('Konten Artikel')
                ->required()
                ->columnSpan('full'),

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
                ->options(function () {
                    $user = Filament::auth()->user();

                    if ($user->hasRole('admin')) {
                        return Author::all()->pluck('name', 'id');
                    }

                    return Author::where('user_id', $user->id)->pluck('name', 'id');
                })
                ->required()
                ->searchable()
                ->placeholder('Pilih Penulis')
                ->columnSpan('full')
                ->disabled(function () {
                    return Filament::auth()->user()->hasRole('editor');
                }),

            DatePicker::make('published_at')
                ->label('Tanggal Publikasi')
                ->required()
                ->nullable()
                ->columnSpan('full'),

            Toggle::make('is_hot')
                ->label('Berita Hangat')
                ->helperText('Aktifkan jika artikel ini merupakan berita yang sedang tren atau penting.')
                ->default(false)
                ->columnSpan('full'),

            Toggle::make('is_headline')
                ->label('Berita Utama')
                ->helperText('Tandai artikel ini sebagai berita utama.')
                ->default(false)
                ->columnSpan('full'),

            Toggle::make('is_featured')
                ->label('Sorotan Pilihan')
                ->helperText('Tampilkan artikel ini di bagian sorotan pilihan.')
                ->default(false)
                ->columnSpan('full'),

            Toggle::make('is_editor_choice')
                ->label('Pilihan Editor')
                ->helperText('Artikel ini dipilih langsung oleh editor.')
                ->default(false)
                ->columnSpan('full'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('title')
                ->label('Judul Artikel')
                ->searchable()
                ->limit(50)
                ->tooltip(fn($record) => $record->title),

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

            TextColumn::make('author.name')
                ->label('Penulis')
                ->alignCenter(),

            ImageColumn::make('thumbnail')
                ->label('Thumbnail')
                ->disk('public')
                ->alignCenter(),

            TextColumn::make('views')
                ->label('Dilihat')
                ->alignCenter(),

            BooleanColumn::make('is_hot')
                ->label('Berita Hangat')
                ->trueIcon('heroicon-s-fire')
                ->falseIcon('heroicon-s-x-circle')
                ->trueColor('danger')
                ->falseColor('gray')
                ->alignCenter(),

            BooleanColumn::make('is_headline')
                ->label('Berita Utama')
                ->trueIcon('heroicon-s-star')
                ->falseIcon('heroicon-s-x-circle')
                ->trueColor('info')
                ->falseColor('gray')
                ->alignCenter(),

            BooleanColumn::make('is_featured')
                ->label('Sorotan Pilihan')
                ->trueIcon('heroicon-s-light-bulb')
                ->falseIcon('heroicon-s-x-circle')
                ->trueColor('warning')
                ->falseColor('gray')
                ->alignCenter(),

            BooleanColumn::make('is_editor_choice')
                ->label('Pilihan Editor')
                ->trueIcon('heroicon-s-check-badge')
                ->falseIcon('heroicon-s-x-circle')
                ->trueColor('success')
                ->falseColor('gray')
                ->alignCenter(),

            TextColumn::make('created_at')
                ->label('Tanggal Dibuat')
                ->date('d M Y')
                ->alignCenter(),

            TextColumn::make('updated_at')
                ->label('Tanggal Diupdate')
                ->date('d M Y')
                ->alignCenter(),
        ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->color('info')
                    ->visible(
                        fn($record) =>
                        Filament::auth()->user()->hasRole('admin') ||
                            Filament::auth()->user()->id === optional($record->author)->user_id
                    ),

                Tables\Actions\DeleteAction::make()
                    ->visible(
                        fn($record) =>
                        Filament::auth()->user()->hasRole('admin') ||
                            Filament::auth()->user()->id === optional($record->author)->user_id
                    ),
            ])
            ->filters([
                //
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(
                        fn() =>
                        Filament::auth()->user()->hasRole('admin') ||
                            Filament::auth()->user()->hasRole('editor')
                    )

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

    public static function getEloquentQuery(): Builder
    {
        $user = Filament::auth()->user();

        if ($user->hasRole('editor')) {
            return parent::getEloquentQuery()
                ->with('author')
                ->whereHas('author', fn($q) => $q->where('user_id', $user->id));
        }

        return parent::getEloquentQuery()
            ->with('author')
            ->leftJoin('authors', 'articles.author_id', '=', 'authors.id')
            ->orderByRaw('CASE WHEN authors.user_id = ? THEN 0 ELSE 1 END', [$user->id])
            ->orderBy('articles.created_at', 'desc')
            ->select('articles.*', 'articles.id as id');
    }

    public static function resolveRecordRouteBinding($key): \Illuminate\Database\Eloquent\Model
    {
        return static::getEloquentQuery()
            ->where('articles.id', $key)
            ->firstOrFail();
    }

    public static function getRecordQueryKeyName(): ?string
    {
        return 'id';
    }
}
