<?php

namespace App\Filament\Resources\Watchlists;

use App\Filament\Resources\Watchlists\Pages\CreateWatchlist;
use App\Filament\Resources\Watchlists\Pages\EditWatchlist;
use App\Filament\Resources\Watchlists\Pages\ListWatchlists;
use App\Filament\Resources\Watchlists\Pages\ViewWatchlist;
use App\Filament\Resources\Watchlists\Schemas\WatchlistForm;
use App\Filament\Resources\Watchlists\Schemas\WatchlistInfolist;
use App\Filament\Resources\Watchlists\Tables\WatchlistsTable;
use App\Models\Watchlist;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WatchlistResource extends Resource
{
    protected static ?string $model = Watchlist::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Watchlist';

    public static function form(Schema $schema): Schema
    {
        return WatchlistForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WatchlistInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WatchlistsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWatchlists::route('/'),
            'create' => CreateWatchlist::route('/create'),
            'view' => ViewWatchlist::route('/{record}'),
            'edit' => EditWatchlist::route('/{record}/edit'),
        ];
    }
}
