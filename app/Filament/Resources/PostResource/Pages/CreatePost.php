<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
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
