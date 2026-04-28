<?php

namespace App\Filament\Resources\Movies;

use App\Filament\Resources\Movies\Pages\CreateMovie;
use App\Filament\Resources\Movies\Pages\EditMovie;
use App\Filament\Resources\Movies\Pages\ListMovies;
use App\Filament\Resources\Movies\Pages\ViewMovie;
use App\Models\Movie;
use App\Services\TmdbService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Actions\Action;

use Filament\Schemas\Schema;

// Componentes de Formulário (Schemas)
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;

use Filament\Schemas\Components\Utilities\Set;




// Componentes de Tabela
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

// Utilitários
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                // Campo de Busca
                TextInput::make('title')
                    ->label('Título do Filme')
                    ->placeholder('Digite o nome do filme e clique na lupa para buscar...')
                    ->live(onBlur: true)
                    ->required()
                    ->suffixAction(
                        Action::make('search_tmdb')
                            ->icon('heroicon-m-magnifying-glass')
                            ->tooltip('Buscar dados no TMDB')
                            ->action(function ($state, Set $set, TmdbService $tmdb) {
                                if (blank($state)) {
                                    Notification::make()
                                        ->title('Atenção')
                                        ->body('Digite o nome de um filme antes de buscar.')
                                        ->warning()
                                        ->send();
                                    return;
                                }

                                try {
                                    $results = $tmdb->findMovie($state);

                                    if (empty($results)) {
                                        Notification::make()
                                            ->title('Não encontrado')
                                            ->body('Nenhum filme foi encontrado.')
                                            ->danger()
                                            ->send();
                                        return;
                                    }

                                    $movie = $results[0];

                                    $set('tmdb_id', $movie['id']);
                                    $set('overview', $movie['overview']);
                                    $set('release_date', $movie['release_date']);
                                    $set('poster_path', $movie['poster_path']);
                                    $set('backdrop_path', $movie['backdrop_path']);

                                    Notification::make()
                                        ->title('Sucesso!')
                                        ->body('Dados importados do TMDB.')
                                        ->success()
                                        ->send();
                                        
                                } catch (\Exception $e) {
                                    Notification::make()
                                        ->title('Erro na API')
                                        ->body('Verifique o token no seu arquivo .env')
                                        ->danger()
                                        ->send();
                                }
                            })
                    ),

                // Preview das Imagens
                Placeholder::make('visual_preview')
                    ->label('Visual do Filme')
                    ->content(fn ($get) => $get('poster_path') 
                        ? new HtmlString("
                            <div class='flex flex-wrap gap-6 items-start mt-2'>
                                <div class='flex flex-col gap-2'>
                                    <span class='text-xs font-bold text-gray-500 uppercase tracking-widest'>Poster</span>
                                    <img src='https://image.tmdb.org/t/p/w342{$get('poster_path')}' 
                                         class='rounded-xl shadow-2xl border border-white/10 w-32 md:w-40 transition-transform hover:scale-105'>
                                </div>
                                " . ($get('backdrop_path') ? "
                                <div class='flex flex-col gap-2 flex-1'>
                                    <span class='text-xs font-bold text-gray-500 uppercase tracking-widest'>Banner</span>
                                    <img src='https://image.tmdb.org/t/p/w780{$get('backdrop_path')}' 
                                         class='rounded-xl shadow-2xl border border-white/10 w-full max-h-60 object-cover'>
                                </div>" : "") . "
                            </div>
                        ")
                        : 'Aguardando busca para exibir posters...'
                    ),

                TextInput::make('tmdb_id')
                    ->hidden()
                    ->dehydrated(),

                Textarea::make('overview')
                    ->label('Sinopse')
                    ->rows(5),

                \Filament\Schemas\Components\Grid::make(2)
                    ->schema([
                        TextInput::make('release_date')
                            ->label('Lançamento'),
                        
                        TextInput::make('poster_path')
                            ->label('Caminho do Poster'),
                        
                        TextInput::make('backdrop_path')
                            ->label('Caminho do Banner')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('poster_path')
                    ->label('Poster')
                    ->getStateUsing(fn ($record) => $record->poster_path 
                        ? "https://image.tmdb.org/t/p/w92{$record->poster_path}" 
                        : null)
                    ->circular(),

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('release_date')
                    ->label('Lançamento')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Adicionado')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMovies::route('/'),
            'create' => CreateMovie::route('/create'),
            'view' => ViewMovie::route('/{record}'),
            'edit' => EditMovie::route('/{record}/edit'),
        ];
    }
}