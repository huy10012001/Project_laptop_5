<!-- lưu tại /resources/views/product/create.blade.php -->
@extends('layout.layout')
@section('title', 'Tạo thương hiệu')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tạo thương hiệu</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- xử lý hiện thông báo lỗi -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (\Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @endif
                    <!-- form start -->
                        <form role="form" action="{{ url('admin/category/postCreate') }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                              
                                <div class="form-group">
                                    <label for="txt-name">Tên thương hiệu</label>
                                    <input type="text" class="form-control" id="txt-name" name="name"
                                           placeholder="Nhập tên thương hiệu">
                                </div>
                              
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script-section')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

   
@endsection
