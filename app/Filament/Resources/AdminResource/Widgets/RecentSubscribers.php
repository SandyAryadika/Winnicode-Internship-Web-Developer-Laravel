<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Subscriber;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;

class RecentSubscribers extends BaseWidget
{
    protected static ?int $sort = 4;
    protected static ?string $heading = 'Subscriber Terbaru';
    protected function getMaxHeight(): string | null
    {
        return '400px'; // sesuaikan dengan kebutuhan
    }

    public function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->query(
                Subscriber::query()
                    ->orderBy('created_at', 'desc')
                    ->limit(4)
            )
            ->columns([
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since()
                    ->sortable(),
            ]);
    }
}
