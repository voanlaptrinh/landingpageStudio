<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryVideo;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::with('category');

    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    if ($request->filled('category_video_id')) {
        $query->where('category_video_id', $request->category_video_id);
    }

    $videos = $query->orderBy('created_at', 'desc')->paginate(10);
    $categories = CategoryVideo::all();

    return view('admin.videos.index', compact('videos', 'categories'));
    }

    public function create()
    {
        $categories = CategoryVideo::all();
        return view('admin.videos.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_video_id' => 'required|exists:category_videos,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);
        $ngay = Carbon::now()->format('Ymd');
        $slug = Str::slug($request->title . '-' . $ngay, '-');

        // Xử lý thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('thumbnails'), $filename);
            $thumbnailPath = 'thumbnails/' . $filename;
        }

        Video::create([
            'category_video_id' => $request->category_video_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Thêm video thành công.');
    }

    public function edit($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $categories = CategoryVideo::all();
        return view('admin.videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, $slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();

        $request->validate([
            'category_video_id' => 'required|exists:category_videos,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string',
        ]);

        $ngay = Carbon::now()->format('Ymd');
        $newSlug = Str::slug($request->title . '-' . $ngay, '-');

        // Cập nhật thumbnail nếu có file mới
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $filename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('thumbnails'), $filename);
            $video->thumbnail = 'thumbnails/' . $filename;
        }

        $video->update([
            'category_video_id' => $request->category_video_id,
            'title' => $request->title,
            'slug' => $newSlug,
            'description' => $request->description,
            'video_url' => $request->video_url,
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Cập nhật video thành công.');
    }

    public function destroy($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', 'Xóa video thành công.');
    }
}
