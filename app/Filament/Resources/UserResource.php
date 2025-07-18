<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Spatie\Permission\Models\Role;
use App\Models\Author;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Role';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';
    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';
    protected static ?string $pluralLabel = 'Daftar Role';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->columnSpan('full'),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255)
                ->columnSpan('full'),

            Forms\Components\TextInput::make('password')
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                ->dehydrated(fn($state) => filled($state))
                ->required(fn(string $context) => $context === 'create')
                ->columnSpan('full'),

            Forms\Components\Select::make('roles')
                ->label('Role')
                ->multiple()
                ->relationship('roles', 'name')
                ->preload()
                ->required()
                ->columnSpan('full'),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('⚠️ Informasi ini bersifat rahasia dan tidak untuk disebarluaskan.')
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return implode(', ', $state);
                        }
                        return $state;
                    })
                    ->colors([
                        'Admin' => 'success',
                        'Writer' => 'primary',
                    ])
                    ->sortable(),
                TextColumn::make('author.is_active')
                    ->label('Status Penulis')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn($state) => $state ? 'success' : 'danger'),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn() => auth()->user()->hasRole('admin')),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Hapus yang dipilih')
                    ->visible(fn() => auth()->user()->hasRole('admin'))
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public static function canEdit(?Model $record): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public static function canDelete(?Model $record): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('roles');
    }

    public static function createAuthor(User $user): void
    {
        if ($user->hasRole('writer') && !$user->author()->exists()) {
            Author::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'photo' => 'images/default.png',
                'is_active' => false,
            ]);
        }
    }

    public static function afterCreate(Model $record): void
    {
        self::createAuthor($record);
    }

    public static function afterUpdate(Model $record): void
    {
        self::createAuthor($record); // tetap gunakan fungsi yang sama agar DRY
    }
}
