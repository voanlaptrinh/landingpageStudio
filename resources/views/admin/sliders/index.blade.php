@extends('admin.index')
@section('content')
    <div class="pagetitle">
        <h1>Quản lý Slider</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item">Slider</li>
                <li class="breadcrumb-item active">Quản lý Slider</li>
            </ol>
        </nav>
    </div>




    <section class="section">
        <div class="row">


            <div class="col-lg-12">



                <div class="card">
                    <div class="card-body">
                        <div class="col-12 d-sm-flex justify-content-between align-items-center">
                            <h5 class="card-title">Quản lý Slider</h5>

                            <a href="{{ route('admin.sliders.create') }}" class="btn btn-success">
                                <i class="bi bi-arrow-left-circle-fill"></i>
                                Thêm mới Slider</a>
                        </div>



                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table ">
                                <thead>
                                    <tr>

                                        <th>Tên silder</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>

                                        <th colspan="3">Thao tác</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sliders as $slider)
                                        <tr>
                                            <td>{{ $slider->title ?? 'Không có tên' }}</td>
                                            <td>@if ($slider->is_active == 1)
                                                    <span class="badge bg-success">Hoạt động</span>
                                                @else
                                                    <span> <span class="badge bg-danger">Không hoạt động</span></span>
                                                @endif
                                            </td>
                                            <td>{{ $slider->created_at->diffForHumans() }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#showModal{{ $slider->id }}">
                                                    <i class="bi bi-eye"></i> Xem
                                                </button>
                                                <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil"></i> Sửa
                                                </a>
                            
                                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                        <i class="bi bi-trash"></i> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="showModal{{ $slider->id }}" tabindex="-1" aria-labelledby="showModalLabel{{ $slider->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="showModalLabel{{ $slider->id }}">Chi tiết Slider</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                </div>
                                                <div class="modal-body">
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                      <strong>Tiêu đề:</strong> {{ $slider->title ?? 'Không có' }}<br>
                                                      <strong>Phụ đề:</strong> {{ $slider->subtitle ?? 'Không có' }}<br>
                                                      <strong>Link:</strong> 
                                                      @if ($slider->link)
                                                        <a href="{{ $slider->link }}" target="_blank">{{ $slider->link }}</a>
                                                      @else
                                                        Không có
                                                      @endif
                                                      <br>
                                                      <strong>Trạng thái:</strong> {{ $slider->is_active ? 'Hiển thị' : 'Ẩn' }}<br>
                                                      <strong>Ngày tạo:</strong> {{ $slider->created_at->format('d/m/Y H:i') }}
                                                    </div>
                                                    <div class="col-md-6 text-center">
                                                      @if ($slider->image)
                                                        <img src="{{ asset($slider->image) }}" alt="Ảnh slider" class="img-fluid rounded-3" style="max-height:300px;">
                                                      @endif
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <div class="alert alert-danger">
                                                        Không có Slider nào trong hệ thống
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->
                                <div class=" p-nav text-end d-flex justify-content-center">
                                    {{ $sliders->appends(request()->query())->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endsection
