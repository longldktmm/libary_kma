@extends('layouts.guest')
@section('style')
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        TRANG CHỦ
        <small>kmalibrary.vn</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> kmalibrary.vn</a></li>
        <li class="active"> Trang chủ</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <h1>CHÀO MỪNG ĐẾN VỚI THƯ VIỆN KMA </h1>
    <div class="container">
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Login</title>
            </head>
            <body>
                <div class="col-md-6 col-md-offset-3">
                    <form action="{{url('login')}}" method="POST" role="form">
                        <legend>Login</legend>
                        @if($errors->has('errorlogin'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{$errors->first('errorlogin')}}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="">Tài khoản</label>
                            <input type="text" class="form-control" id="username" placeholder="Tài khoản" name="username" value="{{old('username')}}">
                            @if($errors->has('username'))
                            <p style="color:red">{{$errors->first('username')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" placeholder="Mật khẩu" name="password">
                            @if($errors->has('password'))
                            <p style="color:red">{{$errors->first('password')}}</p>
                            @endif
                        </div>


                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    </form>
                </div>
    </div>
</div>
</form>
</div>

</section>
<!-- /.content -->
@endsection
@section('script')
@endsection