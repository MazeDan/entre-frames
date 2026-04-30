<?php

namespace App\Filament\Resources\Watchlists\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;



class WatchlistsTable
{
   public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Visual: O Poster ajuda a identificar o filme instantaneamente
                ImageColumn::make('movie.poster_path')
                    ->label('Frame')
                    ->getStateUsing(fn ($record) => "https://image.tmdb.org/t/p/w92{$record->movie->poster_path}")
                    ->circular(),

                // Identificação: Título e Ano
                TextColumn::make('movie.title')
                    ->label('Filme')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => "Lançado em: " . \Carbon\Carbon::parse($record->movie->release_date)->format('Y'))
                    ->weight('bold'),

                // Status: Cores baseadas no valor
                IconColumn::make('watched')
                    ->label('Visto')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->sortable(),

                // Prioridade: Estilo técnico P-0
                TextColumn::make('priority')
                    ->label('Prioridade')
                    ->formatStateUsing(fn ($state) => "P-{$state}")
                    ->badge() // Transforma em um "chip" visual
                    ->color(fn ($state) => match (true) {
                        $state >= 7 => 'danger',   // Alta prioridade (Vermelho Accent)
                        $state >= 4 => 'warning',  // Média
                        default => 'gray',         // Baixa
                    })
                    ->sortable(),

                // Datas: Formato humano e limpo
                TextColumn::make('added_at')
                    ->label('Adicionado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->color('gray'),

                TextColumn::make('watched_at')
                    ->label('Assistido em')
                    ->dateTime('d/m/Y')
                    ->placeholder('Ainda na fila_')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('priority', 'desc') // Começa pelos mais importantes
            ->filters([
                // Filtro rápido para ver o que falta assistir
                \Filament\Tables\Filters\SelectFilter::make('watched')
                    ->label('Status de Visualização')
                    ->options([
                        '0' => 'Pendente',
                        '1' => 'Assistido',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}