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

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Pengguna';
    protected static ?string $navigationGroup = 'Manajemen Penggua';
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('password')
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                ->dehydrated(fn($state) => filled($state))
                ->required(fn(string $context) => $context === 'create'),

            Forms\Components\Select::make('roles') // pastikan ini sesuai dengan relasi di User model (spatie)
                ->label('Role')
                ->multiple()
                ->relationship('roles', 'name') // ini penting untuk relasi many-to-many dengan Spatie Role
                ->preload()
                ->required(),

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
                            return implode(', ', $state); // gabungkan semua role jadi string
                        }
                        return $state;
                    })
                    ->colors([
                        'Admin' => 'success',
                        'Writer' => 'primary',
                    ])
                    ->sortable(),

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
                Tables\Actions\EditAction::make()
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
        return auth()->user()?->hasRole('admin') && auth()->id() !== $record?->id;
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('roles');
    }
}
