<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Actions\Action;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';
    protected static ?string $navigationLabel = 'Penulis';
    protected static ?string $pluralLabel = 'Daftar Pengguna';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')
                    ->default(fn() => auth()->id())
                    ->required(),

                FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->disk('public')
                    ->required()
                    ->columnSpan('full'),

                TextInput::make('name')
                    ->label('Nama Author')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->columnSpan('full'),

                Textarea::make('bio')
                    ->columnSpan('full'),

                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true)
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\Placeholder::make('article_count')
                    ->label('Jumlah Artikel')
                    ->content(fn($record) => $record?->articles()->count() ?? 0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('⚠️ Informasi ini bersifat rahasia dan tidak untuk disebarluaskan | ℹ️ Sebelum mendaftar penulis baru (New author), pastikan email yang digunakan sama dengan di panel pengguna')
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('bio')->label('Bio')->limit(20)->searchable()->tooltip(fn($record) => $record->bio),
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->getStateUsing(fn($record) => $record->photo_url)
                    ->disk('public')
                    ->height('60px')
                    ->width('60px')
                    ->circular(),
                BooleanColumn::make('is_active')
                    ->label('Status')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->headerActions([
                Action::make('editProfile')
                    ->label('Edit Profil Saya')
                    ->icon('heroicon-o-pencil')
                    ->color('primary')
                    ->visible(fn() => auth()->user()->author()->exists())
                    ->url(fn() => AuthorResource::getUrl('edit', ['record' => auth()->user()->author->id])),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->color('info')
                    ->visible(fn() => auth()->user()->hasRole('admin')),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn() => auth()->user()->hasRole('admin')),
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn() => auth()->user()->hasRole('admin')),
            ])
            ->striped();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()->role === 'writer') {
            return $query->where('user_id', auth()->id());
        }

        return $query
            ->orderByRaw('user_id = ? DESC', [auth()->id()])
            ->orderByDesc('created_at');
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->author()->doesntExist();
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->hasRole('admin') || auth()->id() === $record->user_id;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
