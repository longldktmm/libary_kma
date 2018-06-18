@extends('layouts.admin')
@section('style')
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        QUẢN LÝ
        <small> Tài khoản</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Tài khoản</a></li>
        <li class="active"> Thêm tài khoản</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Thêm tài khoản</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" enctype="multipart/form-data"  role="form" method="post">
                {{csrf_field()}}
                <div class="form-group uppercase">
                    <label>Mã tài khoản</label>
                    <input id = "input_username" name = "input_username" type="text" class="form-control" value="{{ old('input_username') }}" placeholder="Nhập ...">
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Họ tên</label>
                    <input id = "input_user_name" name = "input_user_name" type="text" class="form-control" value="{{ old('input_user_name') }}" placeholder="Nhập ...">
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Lớp</label>
                    <input  id = "input_classroom" name = "input_classroom" type="text" class="form-control" value="{{ old('input_classroom') }}" placeholder="Nhập ...">
                </div>
                <!-- select -->
                <div class="form-group">
                    <label>Quyền</label>
                    <select id = "input_role" name = "input_role" class="form-control" value="{{ old('input_role') }}">
                        <option value="">Chọn một quyền</option>
                        @foreach($role as $row)
                        <option value="{{$row['role_name']}}">{{$row['role_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- select -->
                <div class="form-group">
                    <label>Khoa</label>
                    <select id = "input_department" name = "input_department" class="form-control" value="{{ old('input_department') }}">
                        <option value="{{ old('input_department') }}">Chọn một khoa</option>
                        @foreach($department as $row)
                        <option value="{{$row['department_name']}}">{{$row['department_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Khóa học</label>
                    <input  id = "input_course" name = "input_course" type="text" class="form-control" placeholder="Nhập ..." value="{{ old('input_course') }}">
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Đường dẫn ảnh đại diện</label>
                    <input  id = "input_avatar" name = "input_avatar" type="text" class="form-control" placeholder="Nhập ..." value="{{ old('input_avatar') }}">
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea  id = "input_address" name = "input_address" class="form-control" rows="3" placeholder="Nhập ..." >{{ old('input_address') }}</textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" value="submit"> Thêm</button>
                    <button type="reset" class="btn btn-primary"> Làm lại</button>
                    <a href="{{url('admin/account/all')}}"><button type="button" class="btn btn-primary"> Trở về</button></a>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>

</section>
<!-- /.content -->
@endsection
@section('script')
@endsection