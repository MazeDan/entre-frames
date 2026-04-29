<?php

namespace App\Filament\Resources\Watchlists\Pages;

use App\Filament\Resources\Watchlists\WatchlistResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWatchlist extends ViewRecord
{
    protected static string $resource = WatchlistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
