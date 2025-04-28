@extends('admin.index')
@section('content')
    <div class="pagetitle">
        <h1>Quản lý Slider</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item">Slider</li>
                <li class="breadcrumb-item active">Thêm mới sliders</li>
            </ol>
        </nav>
    </div>




    <section class="section">
        <div class="row">


            <div class="col-lg-12">



                <div class="card">
                    <div class="card-body">
                        <div class="col-12 d-sm-flex justify-content-between align-items-center">
                            <h5 class="card-title">Tạo mới Slider</h5>

                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-success">
                                <i class="bi bi-arrow-left-circle-fill"></i>
                                Trở lại danh sách Slider</a>
                        </div>
                        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3">
                            @csrf

                            <div class="col-lg-6">
                                <label>Tiêu đề *</label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label>Phụ đề (không bắt buộc)</label>
                                <input type="text" name="subtitle"
                                    class="form-control @error('subtitle') is-invalid @enderror"
                                    value="{{ old('subtitle') }}">
                                @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12">

                                <div
                                    class="d-flex text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">

                                    <div id="preview2">
                                        <img src="{{ asset('source/images/gallery.png') }}" class="h-50px"
                                            alt="">
                                        <div>
                                            <h6 class="my-2">Hãy đưa ảnh của bạn vào đây </h6>
                                            <label style="cursor:pointer;">
                                                <input id="imageInput"
                                                    class="form-control stretched-link @error('image') is-invalid @enderror"
                                                    type="file" name="image" onchange="previewImage(event)">
                                            </label>


                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-center justify-content-center"> <img id="preview" src="" alt="Xem trước ảnh"
                                            style="display: none;" class="img-fluid rounded-3"><br>
                                        <p class="small mb-0 mt-2 " style=" display: none;" id="ghi_chu"><b>Ghi chú:</b>
                                            Bạn có thể ấn vào ảnh để đưa ảnh khác lên</p>
                                    </div>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>





                            <div class="col-lg-12">
                                <label>Link (không bắt buộc)</label>
                                <input type="text" name="link"
                                    class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 checkbox-wrapper-41">
                                <label for="is_active" class="form-label">Trạng thái (Active thì banner mới hiện)</label>
                                <input class="form-control" type="checkbox" id="is_active" name="is_active" checked
                                    {{ old('is_active') ? 'checked' : '' }}>

                            </div>



                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Lưu</button>
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
