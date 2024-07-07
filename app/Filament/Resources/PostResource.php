<?php

namespace App\Filament\Resources;

use App\Enums\PostType;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

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
                            ->required(),
                        FileUpload::make('thumbnail')
                            ->label('Image')
                            ->disk('public')
                            ->directory('posts/images')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull(),
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
                //
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
