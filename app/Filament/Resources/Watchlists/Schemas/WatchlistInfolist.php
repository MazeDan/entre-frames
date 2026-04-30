<?php

namespace App\Filament\Resources\Watchlists\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;


use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;

class WatchlistInfolist
{
   public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalhes da Intenção')
                    ->description('Metadados do frame aguardando processamento.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                // Coluna 1: Visual (O Frame)
                                Group::make([
                                    ImageEntry::make('movie.poster_path')
                                        ->label('Poster Oficial')
                                        ->getStateUsing(fn ($record) => "https://image.tmdb.org/t/p/w500{$record->movie->poster_path}")
                                        ->extraImgAttributes(['class' => 'rounded-xl shadow-lg border border-white/10']),
                                ])->columnSpan(1),

                                // Coluna 2: Dados do Filme
                                Group::make([
                                    TextEntry::make('movie.title')
                                        ->label('Título Original')
                                        ->weight('black')
                                        ->size('lg')
                                        ->extraAttributes(['class' => 'uppercase tracking-tighter']),
                                    
                                    TextEntry::make('movie.release_date')
                                        ->label('Ano de Lançamento')
                                        ->date('Y'),

                                    TextEntry::make('movie.overview')
                                        ->label('Sinopse')
                                        ->limit(250)
                                        ->color('gray'),
                                ])->columnSpan(1),

                                // Coluna 3: Status da Watchlist
                                Group::make([
                                    Section::make('Status do Arquivo')
                                        ->schema([
                                            IconEntry::make('watched')
                                                ->label('Visto?')
                                                ->boolean()
                                                ->color(fn ($state) => $state ? 'success' : 'warning'),

                                            TextEntry::make('priority')
                                                ->label('Nível de Prioridade')
                                                ->formatStateUsing(fn ($state) => "P-{$state}")
                                                ->weight('bold')
                                                ->color('primary'),

                                            TextEntry::make('added_at')
                                                ->label('Entrada no Sistema')
                                                ->dateTime('d/m/Y H:i'),

                                            TextEntry::make('watched_at')
                                                ->label('Sessão Realizada')
                                                ->dateTime('d/m/Y H:i')
                                                ->placeholder('PENDING_CAPTURE_')
                                                ->visible(fn ($record) => $record->watched),
                                        ])->compact()
                                ])->columnSpan(1),
                            ]),
                    ]),

                // Metadados do Sistema (Menores e discretos no final)
                Grid::make(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Registro Criado')
                            ->since()
                            ->color('gray'),
                        TextEntry::make('updated_at')
                            ->label('Última Sincronização')
                            ->since()
                            ->color('gray'),
                    ])->extraAttributes(['class' => 'opacity-50 text-xs font-mono']),
            ]);
    }

}
