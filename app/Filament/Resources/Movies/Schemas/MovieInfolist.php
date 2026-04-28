<?php

namespace App\Filament\Resources\Movies\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MovieInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('tmdb_id'),
                TextEntry::make('title'),
                TextEntry::make('release_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('poster_path')
                    ->placeholder('-'),
                TextEntry::make('backdrop_path')
                    ->placeholder('-'),
                TextEntry::make('runtime')
                    ->placeholder('-'),
                TextEntry::make('overview')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
