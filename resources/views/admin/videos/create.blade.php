@extends('admin.index')
@section('content')
    <h2>Thêm Video</h2>

    <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" class="row g-2">
        @csrf
        <div class="col-lg-12">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{-- Danh mục --}}
        <div class="col-lg-6">
            <label class="form-label">Danh mục video</label>
            <select name="category_video_id"
                class="form-select select_ted @error('category_video_id') is-invalid @enderror">
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_video_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_video_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-lg-6">
            <label class="form-label">Đường dẫn video</label>
            <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror"
                value="{{ old('video_url') }}">
            @error('video_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>





        <div class="col-lg-12">
            <label class="form-label">Ảnh đại diện</label>
            <div
                class="d-flex text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">

                <div id="preview2">
                    <img src="{{ asset('source/images/gallery.png') }}" class="h-50px" alt="">
                    <div>
                        <h6 class="my-2">Hãy đưa ảnh của bạn vào đây </h6>
                        <label style="cursor:pointer;">
                            <input id="imageInput"
                                class="form-control stretched-link @error('thumbnail') is-invalid @enderror" type="file"
                                name="thumbnail" onchange="previewImage(event)">
                        </label>


                    </div>
                </div>
                <div class="d-flex flex-column align-items-center justify-content-center"> <img id="preview"
                        src="" alt="Xem trước ảnh" style="display: none;" class="img-fluid rounded-3"><br>
                    <p class="small mb-0 mt-2 " style=" display: none;" id="ghi_chu"><b>Ghi chú:</b>
                        Bạn có thể ấn vào ảnh để đưa ảnh khác lên</p>
                </div>
            </div>
            @error('thumbnail')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="mb-3">
        <label class="form-label">Ảnh đại diện</label>
        <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
        @error('thumbnail')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div> --}}
        {{-- Mô tả --}}
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" rows="4" id="tyni"
                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="text-end">
            <button class="btn btn-primary">Thêm Video</button>
        </div>
    </form>
    <script>
        function previewImage(event) {
            var output = document.getElementById('preview');
            var output2 = document.getElementById('preview2');
            var ghi_chu = document.getElementById('ghi_chu');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.style.display = 'block';
            ghi_chu.style.display = 'block';
            output2.style.display = 'none';
        }
        document.getElementById('preview').addEventListener('click', function() {
            document.getElementById('imageInput').click();
        });
    </script>
@endsection
