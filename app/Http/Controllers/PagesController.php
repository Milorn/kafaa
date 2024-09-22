<?php

namespace App\Http\Controllers;

use App\Enums\EquipmentStatus;
use App\Enums\LabelStatus;
use App\Enums\LabelType;
use App\Enums\PostType;
use App\Models\Equipment;
use App\Models\Expert;
use App\Models\Post;
use App\Models\Wilaya;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $wilayas = Wilaya::query()
            ->pluck('name', 'id');

        return view('pages/home')
            ->with('wilayas', $wilayas);
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
            ->simplePaginate(8);

        return view('pages/equipments')->with('equipments', $equipments);
    }

    public function singleEquipment($slug)
    {
        $equipment = Equipment::query()
            ->with('provider')
            ->where('slug', $slug)
            ->where('status', EquipmentStatus::Compliant)
            ->firstOrFail();

        $others = Equipment::query()
            ->where('id', '!=', $equipment->id)
            ->where('status', EquipmentStatus::Compliant)
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return view('pages/equipment-single')
            ->with('equipment', $equipment)
            ->with('others', $others);
    }

    public function experts(Request $request)
    {
        $experts = Expert::query()
            ->with('wilaya')
            ->whereRelation('certificate', 'status', LabelStatus::Accepted)
            ->when($request->query('search'), fn ($query) => $query->where(fn ($query) => $query->whereRaw("LOWER(fname) like '%".strtolower($request->query('search'))."%'")->orWhereRaw("LOWER(lname) like '%".strtolower($request->query('search'))."%'")))
            ->when($request->query('wilaya'), fn ($query) => $query->where('wilaya_id', $request->query('wilaya')))
            ->when($request->query('label') && LabelType::tryFrom($request->query('label')), fn ($query) => $query->where('label', LabelType::from($request->query('label'))))
            ->simplePaginate(18);

        $wilayas = Wilaya::query()
            ->pluck('name', 'id');

        return view('pages/experts')
            ->with('experts', $experts)
            ->with('wilayas', $wilayas);
    }
}
