<?php

namespace App\Filament\Resources\Watchlists\Pages;

use App\Filament\Resources\Watchlists\WatchlistResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWatchlist extends EditRecord
{
    protected static string $resource = WatchlistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
