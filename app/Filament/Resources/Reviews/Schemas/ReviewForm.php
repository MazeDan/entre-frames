<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
              Select::make('movie_id')
    ->label('Filme para Review')
    ->relationship('movie', 'title')
    ->searchable()
    ->preload()
    ->required()
    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->title} (" . \Carbon\Carbon::parse($record->release_date)->format('Y') . ")")
    ->allowHtml() // Permite renderizar HTML na lista (se o seu tema suportar)
    ->extraAttributes(['class' => 'font-bold uppercase tracking-tight']),
    
                TextInput::make('rating')
    ->label('Sua Nota')
    ->required()
    ->numeric()
    ->minValue(0)
    ->maxValue(10)
    ->step(0.5) // Permite notas como 8.5
    ->suffix('/ 10'),   
                Textarea::make('body')
                    ->columnSpanFull(),
                DateTimePicker::make('watched_at'),
                Toggle::make('is_rewatch')
                    ->required(),
                Toggle::make('status')
                    ->required(),
            ]);
    }
}
