<?php

namespace App\Filament\Resources;

use App\Enums\PostType;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Ressource';

    protected static ?string $pluralModelLabel = 'Ressources';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make('type')
                            ->label('Type')
                            ->options(PostType::class)
                            ->live(true)
                            ->required(),
                        SpatieMediaLibraryFileUpload::make('file')
                            ->label('Image')
                            ->disk('public')
                            ->collection('posts_images')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('document')
                            ->label('Document')
                            ->helperText('Pour plusieurs fichiers veuillez télécharger un fichier .rar')
                            ->hint('pdf, images, office, rar')
                            ->disk('public')
                            ->collection('documents')
                            ->downloadable()
                            ->previewable(false)
                            ->maxSize(1024 * 50) // 50mb
                            ->required()
                            ->columnSpanFull()
                            ->visible(fn ($get) => $get('type') == PostType::Documents->value),
                    ]),
                Translate::make()
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre')
                            ->placeholder(fn ($component) => $component->getLabel())
                            ->required(),
                        TextInput::make('subtitle')
                            ->label('Sous titre')
                            ->placeholder(fn ($component) => $component->getLabel()),
                        RichEditor::make('content')
                            ->label('Contenu')
                            ->placeholder(fn ($component) => $component->getLabel())
                            ->required(),
                    ])->locales(['fr', 'ar'])
                    ->columnSpanFull()
                    ->suffixLocaleLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->datetime()
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
