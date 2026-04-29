<?php

namespace App\Filament\Resources\Watchlists\Pages;

use App\Filament\Resources\Watchlists\WatchlistResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWatchlists extends ListRecords
{
    protected static string $resource = WatchlistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
