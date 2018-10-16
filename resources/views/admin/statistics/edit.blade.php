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
        <li class="active"> Sửa tài liệu</li>
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
            <h3 class="box-title">Sửa tài liệu</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" enctype="multipart/form-data"  role="form" method="post">
                {{csrf_field()}}
                <div class="form-group uppercase">
                    <label>Mã tài liệu</label>
                    <input id = "input_document_code" name = "input_document_code" value="{{$document->id}}" type="text" class="form-control" disabled >
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Tên tài liệu</label>
                    <input id = "input_document_name" name = "input_document_name" value="{{$document->document_name}}" type="text" class="form-control"  >
                </div>
                <div class="form-group">
                    <label>Tác giả</label>
                    <input id = "input_author" name = "input_author" type="text" value="{{$document->author}}" class="form-control"  >
                </div>
                <div class="form-group">
                    <label>Nhà xuất bản</label>
                    <input id = "input_publishing_company" name = "input_publishing_company" type="text" value="{{$document->publishing_company}}" class="form-control"  >
                </div>
                <!-- select -->
                <div class="form-group">
                    <label>Loại</label>
                    <select id = "input_type" name = "input_type" class="form-control">
                        <option value="{{$document->type}}" >{{$document->type}}</option>
                        @foreach($type as $row)
                        <option value="{{$row['type_name']}}">{{$row['type_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- select -->
                <div class="form-group">
                    <label>Khoa</label>
                    <select id = "input_department" name = "input_department" class="form-control">
                        <option value="{{$document->department}}" >{{$document->department}}</option>
                        @foreach($department as $row)
                        <option value="{{$row['department_name']}}">{{$row['department_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- select -->
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select id = "input_status" name = "input_status" class="form-control" >
                        <option value="{{$document->status}}">{{$document->status}}</option>
                        @foreach($status as $row)
                        <option value="{{$row['status_name']}}">{{$row['status_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Giới thiệu</label>
                    <textarea  id = "input_review" name = "input_review" class="form-control" rows="3">{{$document ->review}}</textarea>
                </div>
                <div class="form-group">
                    <label>Phiếu mượn</label>
                    <textarea  id = "input_borrow_by" name = "input_borrow_by" class="form-control" rows="3">{{$document ->borrow_by}}</textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" value="submit"> Sửa</button>
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