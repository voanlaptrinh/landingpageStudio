@extends('admin.index')
@section('content')
    <div class="pagetitle">
        <h1>Quản lý Video</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item">Video</li>
                <li class="breadcrumb-item active">Quản lý video</li>
            </ol>
        </nav>
    </div>




    <section class="section">
        <div class="row">


            <div class="col-lg-12">



                <div class="card">
                    <div class="card-body">
                        <div class="col-12 d-sm-flex justify-content-between align-items-center">
                            <h5 class="card-title">Quản lý Video</h5>

                            <a href="{{ route('admin.videos.create') }}" class="btn btn-success">
                                <i class="bi bi-arrow-left-circle-fill"></i>
                                Thêm mới video</a>
                        </div>
                        <form action="{{ route('admin.videos.index') }}" method="GET" class="row g-3 mb-3">
                            <div class="col-md-8">
                                <input type="text" name="title" class="form-control" placeholder="Tìm theo tiêu đề" value="{{ request('title') }}">
                            </div>
                            <div class="col-md-2">
                                <select name="category_video_id" class="form-select">
                                    <option value="">-- Tất cả danh mục --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category_video_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100" type="submit">Tìm kiếm</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table ">
                                <thead>
                                    <tr>

                                        <th>Tên video</th>
                                        <th>Danh mục</th>
                                        <th>Ngày tạo</th>

                                        <th colspan="3">Thao tác</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($videos as $video)
                                        <tr>
                                            <td>{{ $video->title ?? 'Không có tên' }}</td>
                                            <td>
                                              {{$video->category->name}}
                                            </td>
                                            <td>{{ $video->created_at->diffForHumans() }}</td>
                                            <td>
                                                {{-- <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#viewModal{{ $categorie->id }}">
                                                    <i class="bi bi-eye-fill"></i> Xem
                                                </button>
                                                <a href="{{ route('admin.category_videos.edit', $categorie->slug) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil"></i> Sửa
                                                </a>

                                                <form action="{{ route('admin.category_videos.destroy', $categorie->slug) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                        <i class="bi bi-trash"></i> Xóa
                                                    </button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                       
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <div class="alert alert-danger">
                                                    Không có danh mục nào trong hệ thống
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                            <div class=" p-nav text-end d-flex justify-content-center">
                                {{ $videos->appends(request()->query())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
