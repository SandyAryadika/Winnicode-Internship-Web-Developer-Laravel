<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Facades\Filament;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function authorizeAccess(): void
    {
        $user = Filament::auth()->user();
        $recordAuthorId = $this->record->author?->user_id;

        if ($user->hasRole('editor') && $user->id !== $recordAuthorId) {
            abort(403);
        }
    }

    public function mount($record): void
    {
        parent::mount($record);

        $this->authorizeAccess();
    }

    /**
     * Override this method to avoid 'ambiguous column id' issue
     */
    public static function resolveRecordRouteBinding($key): \Illuminate\Database\Eloquent\Model
    {
        return ArticleResource::getEloquentQuery()
            ->where('articles.id', $key)
            ->firstOrFail();
    }
}
