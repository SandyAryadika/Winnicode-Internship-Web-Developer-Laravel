<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use App\Models\Author;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Enums\VerticalAlignment;

class TopAuthorsWidget extends BaseWidget
{
    protected static ?string $heading = 'Top 5 Kontributor';

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Author::withCount('articles')
            ->orderByDesc('articles_count')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            \Filament\Tables\Columns\ImageColumn::make('photo')
                ->label('Foto')
                ->circular()
                ->size(60)
                ->alignment(Alignment::Start)
                ->verticalAlignment(VerticalAlignment::Start),

            \Filament\Tables\Columns\TextColumn::make('name')
                ->label('Nama Penulis')
                ->alignment(Alignment::Center)
                ->verticalAlignment(VerticalAlignment::Start)
                ->wrapHeader(),

            \Filament\Tables\Columns\TextColumn::make('articles_count')
                ->label('Jumlah Artikel')
                ->alignment(Alignment::Center)
                ->verticalAlignment(VerticalAlignment::Start)
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
