<?php

namespace App\Filament\Resources\Reviews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
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

                TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),
           
             
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
