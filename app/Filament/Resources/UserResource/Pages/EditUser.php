<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Author;
use App\Models\User;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $this->syncAuthorProfileIfWriter();
    }

    private function syncAuthorProfileIfWriter(): void
    {
        $user = $this->record;
        $user->load('roles');

        if ($user->hasRole('writer') && !$user->author()->exists()) {
            Author::create([
                'user_id'   => $user->id,
                'name'      => $user->name,
                'email'     => $user->email,
                'photo'     => 'images/default.png',
                'is_active' => false,
            ]);
        }
    }
}
