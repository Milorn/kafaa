<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Company;
use App\Models\Expert;
use App\Models\File;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getFile($path)
    {
        $file = File::where('path', $path)->first();

        if (! $file) {
            abort(404);
        }

        if ($this->verfiyPermission($file)) {
            return Storage::disk('private')->download($file->path, $file->name);
        } else {
            abort(403);
        }
    }

    private function verfiyPermission($file): bool
    {
        $user = Auth::user();

        if ($user->type == UserType::Admin) {
            return true;
        }

        if ($file->fileable_type == Company::class) {
            if ($user->type == UserType::Company) {
                return $user->company->id == $file->fileable_id;
            }
        } elseif ($file->fileable_type == Provider::class) {
            if ($user->type == UserType::Provider) {
                return $user->provider->id == $file->fileable_id;
            }
        } elseif ($file->fileable_type == Expert::class) {
            if ($user->type == UserType::Expert) {
                return $user->expert->id == $file->fileable_id;
            }
        }

        return false;
    }
}
