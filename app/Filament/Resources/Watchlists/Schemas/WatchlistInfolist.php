<?php

namespace App\Filament\Resources\Watchlists\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WatchlistInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('movie_id')
                    ->numeric(),
                IconEntry::make('watched')
                    ->boolean(),
                TextEntry::make('priority')
                    ->numeric(),
                TextEntry::make('added_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('watched_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
