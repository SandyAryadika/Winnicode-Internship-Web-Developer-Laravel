<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Author;
use App\Models\User;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

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
