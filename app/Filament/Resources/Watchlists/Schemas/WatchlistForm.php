<?php

namespace App\Filament\Resources\Watchlists\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;



class WatchlistForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Curadoria de Intenções')
                    ->description('Gerencie o que entrará no Entre Frames em breve.')
                    ->schema([
                        // Filme com busca e label amigável
                        Select::make('movie_id')
                            ->label('Filme')
                            ->relationship('movie', 'title')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),

                        Grid::make(3)
                            ->schema([
                                // Prioridade com sufixo técnico
                                TextInput::make('priority')
                                    ->label('Prioridade')
                                    ->numeric()
                                    ->default(0)
                                    ->suffix('LVL')
                                    ->placeholder('0'),

                                // Toggle de status assistido
                                Toggle::make('watched')
                                    ->label('Já Assistido?')
                                    ->live() // Torna o campo reativo
                                    ->required(),

                                // Data de adição automática (opcional, mas útil)
                                DateTimePicker::make('added_at')
                                    ->label('Adicionado em')
                                    ->default(now())
                                    ->displayFormat('d/m/Y H:i'),
                            ]),

                        // Este campo só aparece se 'watched' for verdadeiro
                        DateTimePicker::make('watched_at')
                            ->label('Data da Sessão')
                            ->visible(fn ($get) => $get('watched'))
                            ->required(fn ($get) => $get('watched'))
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}