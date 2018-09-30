@extends('layouts.user')
@section('style')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        QUẢN LÝ
        <small> Tài khoản</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Tài khoản của tôi</a></li>
        <li class="active"> Xem hoặc chỉnh sửa</li>
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
    <div class="box-body">
        Đổi mật khẩu
        <form action="{{url('myaccount/changepassword')}}" enctype="multipart/form-data"  role="form" method="post" >
            {{csrf_field()}}
            <!-- text input -->
            <div class="form-group">
                <label>Mật khẩu mới</label>
                <input id = "input_new_password" name = "input_new_password" type="text" class="form-control" value="">
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" value="submit"> Thay đổi mật khẩu</button>
                <button type="reset" class="btn btn-primary"> Làm lại</button>
                <a href="{{url('home')}}"><button type="button" class="btn btn-primary"> Trở về</button></a>
            </div>
        </form>
        Thông tin cá nhân
        <form action="" enctype="multipart/form-data"  role="form" method="post" >
            {{csrf_field()}}
            <!-- text input -->
            <div class="form-group">
                <label>Họ tên</label>
                <input id = "input_user_name" name = "input_user_name" type="text" class="form-control" value="{{$account->name}}" disabled>
            </div>
            <!-- text input -->
            <div class="form-group">
                <!-- text input -->
                <div class="form-group">
                    <label>Quyền</label>
                    <input  id = "input_role" name = "input_role" type="text" class="form-control" value="{{$account->role}}" disabled>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Lớp</label>
                    <input  id = "input_classroom" name = "input_classroom" type="text" class="form-control" value="{{$account->classroom}}" disabled>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Khóa học</label>
                    <input  id = "input_course" name = "input_course" type="text" class="form-control" value="{{$account->course}}" disabled>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Khoa</label>
                    <input  id = "input_department" name = "input_department" type="text" class="form-control" value="{{$account->department}}" disabled>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Đường dẫn ảnh đại diện</label>
                    <input  id = "input_avatar" name = "input_avatar" type="text" class="form-control" value="{{$account->avatar}}">
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea  id = "input_address" name = "input_address" class="form-control" rows="3" value="{{$account->address}}" type="text">{{$account->address}}</textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" value="submit"> Sửa</button>
                    <button type="reset" class="btn btn-primary"> Làm lại</button>
                    <a href="{{url('home')}}"><button type="button" class="btn btn-primary"> Trở về</button></a>
                </div>
        </form>
        <
</section>
<!-- /.content -->
@endsection
@section('script')
@endsection