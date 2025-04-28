@extends('admin.index')
@section('content')
    <div class="pagetitle">
        <h1>Quản lý Slider</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item">Slider</li>
                <li class="breadcrumb-item active">Sửa sliders</li>
            </ol>
        </nav>
    </div>




    <section class="section">
        <div class="row">


            <div class="col-lg-12">



                <div class="card">
                    <div class="card-body">
                        <div class="col-12 d-sm-flex justify-content-between align-items-center">
                            <h5 class="card-title">Sửa Slider</h5>

                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-success">
                                <i class="bi bi-arrow-left-circle-fill"></i>
                                Trở lại danh sách Slider</a>
                        </div>

                        <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('PUT')

                            <div class="col-lg-6">
                                <label>Tiêu đề *</label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $slider->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Phụ đề (không bắt buộc)</label>
                                <input type="text" name="subtitle"
                                    class="form-control @error('subtitle') is-invalid @enderror"
                                    value="{{ old('subtitle', $slider->subtitle) }}">
                                @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <div
                                    class="d-flex text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                    <div id="preview2" style="{{ $slider->image ? 'display:none;' : '' }}">
                                        <img src="{{ asset('source/images/gallery.png') }}" class="h-50px" alt="">
                                        <div>
                                            <h6 class="my-2">Hãy đưa ảnh của bạn vào đây</h6>
                                            <label style="cursor:pointer;">
                                                <input id="imageInput"
                                                    class="form-control stretched-link @error('image') is-invalid @enderror"
                                                    type="file" name="image" onchange="previewImage(event)">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <img id="preview" src="{{ $slider->image ? asset($slider->image) : '' }}"
                                            alt="Xem trước ảnh" class="img-fluid rounded-3"
                                            style="{{ $slider->image ? 'display:block;' : 'display:none;' }}">
                                        <p class="small mb-0 mt-2" style="{{ $slider->image ? '' : 'display:none;' }}"
                                            id="ghi_chu">
                                            <b>Ghi chú:</b> Bạn có thể ấn vào ảnh để thay ảnh khác
                                        </p>
                                    </div>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label>Link (không bắt buộc)</label>
                                <input type="text" name="link"
                                    class="form-control @error('link') is-invalid @enderror"
                                    value="{{ old('link', $slider->link) }}">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <div class="form-check">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        value="1" {{ old('is_active', $slider->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Trạng thái (Active thì banner mới hiện)
                                    </label>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
