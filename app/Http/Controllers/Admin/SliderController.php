<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('created_at', 'desc')->paginate(10); // 10 slider mỗi trang
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'link' => 'nullable|string|max:255',
            'is_active' => 'nullable', // Đảm bảo đây là nullable khi không check vào
        ],[
            'image.mimes' => 'Chỉ chấp nhận các định dạng: jpeg, png, jpg, gif.',
            'is_active.boolean' => 'Trạng thái phải là true hoặc false.',
            'is_active.nullable' => 'Trạng thái có thể để trống nếu không chọn.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'subtitle.max' => 'Phụ đề không được vượt quá 255 ký tự.',
            'link.max' => 'Liên kết không được vượt quá 255 ký tự.',
            'title.string' => 'Tiêu đề phải là chuỗi.',
            'subtitle.string' => 'Phụ đề phải là chuỗi.',
            'link.string' => 'Liên kết phải là chuỗi.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.required' => 'Vui lòng chọn một hình ảnh.',
        ]);
        
        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('sliders'), $imageName);
        }

        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => 'sliders/' . $imageName, // lưu path tương đối
            'link' => $request->link,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider thêm thành công.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'link' => 'nullable|string|max:255',
            'is_active' => 'nullable', // Đảm bảo đây là nullable khi không check vào
        ],[
            'image.mimes' => 'Chỉ chấp nhận các định dạng: jpeg, png, jpg, gif.',
            'is_active.boolean' => 'Trạng thái phải là true hoặc false.',
            'is_active.nullable' => 'Trạng thái có thể để trống nếu không chọn.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'subtitle.max' => 'Phụ đề không được vượt quá 255 ký tự.',
            'link.max' => 'Liên kết không được vượt quá 255 ký tự.',
            'title.string' => 'Tiêu đề phải là chuỗi.',
            'subtitle.string' => 'Phụ đề phải là chuỗi.',
            'link.string' => 'Liên kết phải là chuỗi.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.required' => 'Vui lòng chọn một hình ảnh.',
        ]);

        if ($request->hasFile('image')) {


            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('sliders'), $imageName);
            $slider->image = 'sliders/' . $imageName;
        }

        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->link = $request->link;
        $slider->is_active = $request->has('is_active') ? 1 : 0;
        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider cập nhật thành công.');
    }

    public function destroy(Slider $slider)
    {
       
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider đã xóa.');
    }
    
}
