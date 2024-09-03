<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Company;
use App\Models\Expert;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FileController extends Controller
{
    public function getFile($id, $path)
    {
        $file = Media::where(['id' => $id, 'file_name' => $path])->get()->first();

        if (! $file) {
            abort(404);
        }

        if ($this->verfiyPermission($file)) {
            return Storage::disk('private')->download("{$id}/{$file->file_name}", $file->name);
        } else {
            abort(403);
        }

        return Storage::disk('private')->download($path, 'test.pdf');
    }

    private function verfiyPermission($file): bool
    {
        $user = Auth::user();
        $userId = $user->id;
        $userableId = $user->userable?->id;

        if ($user->type == UserType::Admin) {
            return true;
        }

        if ($file->model_type == Company::class) {
            if ($user->type == UserType::Company) {
                return $userableId == $file->model_id;
            }
        } elseif ($file->model_type == Provider::class) {
            if ($user->type == UserType::Provider) {
                return $userableId == $file->model_id;
            }
        } elseif ($file->model_type == Expert::class) {
            if ($user->type == UserType::Expert) {
                return $userableId == $file->model_id;
            }
        }

        return false;
    }
}
