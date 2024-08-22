<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function mutateFormDataBeforeSave(array $data): array
    {
        $count = 0;
        do {
            $data['slug'] = Str::slug($data['title']['fr']);
            if ($count > 0) {
                $data['slug'] .= '-'.$count;
            }
            $count++;
        } while (Post::where('slug', $data['slug'])->count() > 0);

        return $data;
    }
}
