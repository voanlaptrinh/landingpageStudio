@extends('admin.index')
@section('content')
    <div class="pagetitle">
        <h1>Quản lý Danh mục videos</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item">Danh mục videos</li>
                <li class="breadcrumb-item active">Sửa Danh mục videos</li>
            </ol>
        </nav>
    </div>




    <section class="section">
        <div class="row">


            <div class="col-lg-12">



                <div class="card">
                    <div class="card-body">
                        <div class="col-12 d-sm-flex justify-content-between align-items-center">
                            <h5 class="card-title">Sửa Danh mục videos</h5>

                            <a href="{{ route('admin.category_videos.index') }}" class="btn btn-success">
                                <i class="bi bi-arrow-left-circle-fill"></i>
                                Trở lại danh sách danh mục videos</a>
                        </div>


                        <form action="{{ route('admin.category_videos.update', $category->slug) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')

                            <div class="col-lg-6">
                                <label for="name" class="form-label">Tên danh mục <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $category->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="subtitle" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" name="subtitle" id="subtitle"
                                    class="form-control @error('subtitle') is-invalid @enderror"
                                    value="{{ old('subtitle', $category->subtitle) }}">
                                @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea name="description" id="tyni" rows="4"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                           <div class="text-end">
                            <button type="submit" class="btn btn-success">Cập Nhật</button>
                            <a href="{{ route('admin.category_videos.index') }}" class="btn btn-secondary">Quay lại</a>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
