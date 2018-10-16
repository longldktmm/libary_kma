@extends('layouts.admin')
@section('style')
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        QUẢN LÝ
        <small> Tài liệu</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Tài liệu</a></li>
        <li class="active"> Thêm tài liệu</li>
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
            <h3 class="box-title">Thêm tài liệu</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" enctype="multipart/form-data"  role="form" method="post">
                {{csrf_field()}}
                <div class="form-group uppercase">
                    <label>Mã tài liệu</label>
                    <input id = "input_document_code" name = "input_document_code" value="{{ old('input_document_code') }}" type="text" class="form-control" placeholder="Nhập ...">
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Tên tài liệu</label>
                    <input id = "input_document_name" name = "input_document_name" value="{{ old('input_document_name') }}" type="text" class="form-control" placeholder="Nhập ...">
                </div>
                <div class="form-group">
                    <label>Tác giả</label>
                    <input id = "input_document_name" name = "input_author" type="text" value="{{ old('input_author') }}" class="form-control" placeholder="Nhập ...">
                </div>
                <div class="form-group">
                    <label>Nhà xuất bản</label>
                    <input id = "input_publishing_company" name = "input_publishing_company" type="text" value="{{ old('input_publishing_company') }}" class="form-control" placeholder="Nhập ...">
                </div>
                <!-- select -->
                <div class="form-group">
                    <label>Loại</label>
                    <select id = "input_type" name = "input_type" value="{{ old('input_type') }}" class="form-control">
                        <option value="{{ old('input_type') }}">Chọn một</option>
                        @foreach($type as $row)
                        <option value="{{$row['type_name']}}">{{$row['type_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select id = "input_status" name = "input_status" class="form-control" value="{{ old('input_status') }}" >
                        <option value="{{ old('input_status') }}">Chọn một</option>
                        @foreach($status as $row)
                        <option value="{{$row['status_name']}}">{{$row['status_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- select -->
                <div class="form-group">
                    <label>Khoa</label>
                    <select id = "input_role" name = "input_department" class="form-control" value="{{ old('input_department') }}">
                        <option value="{{ old('input_department') }}">Chọn một khoa</option>
                        @foreach($department as $row)
                        <option value="{{$row['department_name']}}">{{$row['department_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Giới thiệu</label>
                    <textarea  id = "input_review" name = "input_review" class="form-control" rows="3" placeholder="Nhập ...">{{ old('input_review') }}</textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" value="submit"> Thêm</button>
                    <button type="reset" class="btn btn-primary"> Làm lại</button>
                    <a href="{{url('admin/document/all')}}"><button type="button" class="btn btn-primary"> Trở về</button></a>
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