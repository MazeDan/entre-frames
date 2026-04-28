<?php

namespace App\Filament\Resources\Movies\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MovieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tmdb_id')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                DatePicker::make('release_date'),
                TextInput::make('poster_path'),
                TextInput::make('backdrop_path'),
                TextInput::make('runtime'),
                Textarea::make('overview')
                    ->columnSpanFull(),
            ]);
    }
}
