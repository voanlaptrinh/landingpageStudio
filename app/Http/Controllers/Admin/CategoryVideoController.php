<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CategoryVideoController extends Controller
{
     // Hiển thị danh sách danh mục video
     public function index()
     {
         $categories = CategoryVideo::orderBy('created_at', 'desc')->paginate(10);
         return view('admin.category_videos.index', compact('categories'));
     }
 
     // Hiển thị form tạo danh mục
     public function create()
     {
         return view('admin.category_videos.create');
     }
 
     // Lưu danh mục mới
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|max:255',
             'subtitle' => 'required|max:255',
         ],[
                'name.required' => 'Tên danh mục không được để trống.',
                'subtitle.required' => 'Tiêu đề phụ không được để trống.',
                'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
                'subtitle.max' => 'Tiêu đề phụ không được vượt quá 255 ký tự.',
         ]);
         $ngay = Carbon::now()->format('Ymd');
         $slug = Str::slug($request->name. '-' . $ngay, '-');
 
        
         CategoryVideo::create([
             'name' => $request->name,
             'subtitle' => $request->subtitle,
             'slug' => $slug,
             'description' => $request->description,
         ]);
 
         return redirect()->route('admin.category_videos.index')->with('success', 'Thêm danh mục thành công.');
     }
 
     // Hiển thị form chỉnh sửa
     public function edit($slug)
     {
         $category = CategoryVideo::where('slug', $slug)->firstOrFail();
         return view('admin.category_videos.edit', compact('category'));
     }
 
     // Cập nhật danh mục
     public function update(Request $request, $slug)
     {
         $category = CategoryVideo::where('slug', $slug)->firstOrFail();
 
         $request->validate([
             'name' => 'required|max:255',
             'subtitle' => 'required|max:255',
         ],[
                'name.required' => 'Tên danh mục không được để trống.',
                'subtitle.required' => 'Tiêu đề phụ không được để trống.',
                'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
                'subtitle.max' => 'Tiêu đề phụ không được vượt quá 255 ký tự.',
         ]);
         $ngay = Carbon::now()->format('Ymd');
         $newSlug = Str::slug($request->name . '-' . $ngay, '-');
 
        
 
         $category->update([
             'name' => $request->name,
             'subtitle' => $request->subtitle,
             'slug' => $newSlug,
             'description' => $request->description,
         ]);
 
         return redirect()->route('admin.category_videos.index')->with('success', 'Cập nhật danh mục thành công.');
     }
 
     // Xóa danh mục
     public function destroy($slug)
     {
         $category = CategoryVideo::where('slug', $slug)->firstOrFail();
         $category->delete();
 
         return redirect()->route('admin.category_videos.index')->with('success', 'Xóa danh mục thành công.');
     }
}
