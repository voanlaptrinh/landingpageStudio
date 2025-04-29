@extends('admin.index')
@section('content')
    <div class="pagetitle">
        <h1>Quản lý danh mục video</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item">Danh mục video</li>
                <li class="breadcrumb-item active">Quản lý danh mục video</li>
            </ol>
        </nav>
    </div>




    <section class="section">
        <div class="row">


            <div class="col-lg-12">



                <div class="card">
                    <div class="card-body">
                        <div class="col-12 d-sm-flex justify-content-between align-items-center">
                            <h5 class="card-title">Quản lý danh mục Video</h5>

                            <a href="{{ route('admin.category_videos.create') }}" class="btn btn-success">
                                <i class="bi bi-arrow-left-circle-fill"></i>
                                Thêm mới Danh mục video</a>
                        </div>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table ">
                                <thead>
                                    <tr>

                                        <th>Tên danh mục</th>
                                        <th>Tiêu đề</th>
                                        <th>Ngày tạo</th>

                                        <th colspan="3">Thao tác</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $categorie)
                                        <tr>
                                            <td>{{ $categorie->name ?? 'Không có tên' }}</td>
                                            <td>
                                              {{$categorie->subtitle}}
                                            </td>
                                            <td>{{ $categorie->created_at->diffForHumans() }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
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
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="viewModal{{ $categorie->id }}" tabindex="-1"
                                            aria-labelledby="viewModalLabel{{ $categorie->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewModalLabel{{ $categorie->id }}">Nội
                                                            dung yêu cầu: {{ $categorie->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Đóng"></button>
                                                    </div>
                                                    <div class="modal-body content-chitiet">
                                                        {!! $categorie->description !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Đóng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                {{ $categories->appends(request()->query())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
