<form action="{{ route('videos.update', $video->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Danh mục --}}
    <div class="mb-3">
        <label class="form-label">Danh mục video</label>
        <select name="category_video_id" class="form-select @error('category_video_id') is-invalid @enderror">
            <option value="">-- Chọn danh mục --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_video_id', $video->category_video_id) == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        @error('category_video_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Tiêu đề --}}
    <div class="mb-3">
        <label class="form-label">Tiêu đề</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $video->title) }}">
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Mô tả --}}
    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $video->description) }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Video URL --}}
    <div class="mb-3">
        <label class="form-label">Đường dẫn video</label>
        <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror"
               value="{{ old('video_url', $video->video_url) }}">
        @error('video_url')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Thumbnail --}}
    <div class="mb-3">
        <label class="form-label">Ảnh đại diện</label>
        <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
        @if($video->thumbnail)
            <div class="mt-2">
                <img src="{{ asset($video->thumbnail) }}" alt="Thumbnail" height="100">
            </div>
        @endif
        @error('thumbnail')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-success">Cập nhật Video</button>
</form>