<?php

namespace App\Http\Controllers;

use App\Enums\EquipmentStatus;
use App\Enums\LabelStatus;
use App\Enums\LabelType;
use App\Enums\PostType;
use App\Models\Equipment;
use App\Models\Expert;
use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages/home');
    }

    public function aboutUs()
    {
        return view('pages/about-us');
    }

    public function pro()
    {
        return view('pages/pro');
    }

    public function blog(Request $request)
    {
        $posts = Post::query()
            ->where('type', '!=', PostType::Documents)
            ->when($request->search, fn ($query) => $query->whereRaw("LOWER(title) like '%".strtolower($request->search)."%'"))
            ->simplePaginate(9);

        return view('pages/blog')->with('posts', $posts);
    }

    public function singleBlog($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $relatedPosts = Post::where('slug', '!=', $slug)->latest()->limit(2)->get();

        return view('pages/blog-single')
            ->with('post', $post)
            ->with('relatedPosts', $relatedPosts);
    }

    public function documents(Request $request)
    {
        $documents = Post::query()
            ->where('type', PostType::Documents)
            ->when($request->search, fn ($query) => $query->whereRaw("LOWER(title) like '%".strtolower($request->search)."%'"))
            ->simplePaginate(9);

        return view('pages/documents')->with('documents', $documents);
    }

    public function equipments(Request $request)
    {
        $equipments = Equipment::query()
            ->where('status', EquipmentStatus::Compliant)
            ->when($request->search, fn ($query) => $query->whereRaw("LOWER(name) like '%".strtolower($request->search)."%'"))
            ->simplePaginate(9);

        return view('pages/equipments')->with('equipments', $equipments);
    }

    public function singleEquipment($slug)
    {
        $equipment = Equipment::where('slug', $slug)
            ->with('provider')
            ->firstOrFail();

        return view('pages/equipment-single')
            ->with('equipment', $equipment);
    }

    public function experts(Request $request)
    {
        $equipments = Expert::query()
            ->whereRelation('certificae', 'status', LabelStatus::Accepted)
            ->when($request->search, fn ($query) => $query->whereRaw("LOWER(name) like '%".strtolower($request->search)."%'"))
            ->simplePaginate(9);

        return view('pages/experts')->with('experts', $experts);
    }
}
