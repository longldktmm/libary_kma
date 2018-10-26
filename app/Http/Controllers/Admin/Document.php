<?php

namespace App\Http\Controllers\Admin;

use App\TblLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TblStatus;
use App\TblType;
use App\TblDocument;
use App\TblDepartment;
use Validator;
use App\TblBorrow;

class Document extends Controller {

    public function postAdd(Request $request) {
        $rules = [
            'input_author' => 'required| max: 255',
            'input_document_name' => 'required| max: 255',
            'input_document_code' => 'required | unique:document,id| max: 255',
            'input_publishing_company' => 'required| max: 255',
            'input_type' => 'required| max: 255',
            'input_status' => 'required| max: 255',
            'input_review' => 'max: 2000',
            'input_department' => 'required | max: 255',
        ];
        $messages = [
            'input_review.max' => 'Giới thiệu quá dài',
            'input_department.required' => 'Khoa không được để trống',
            'input_author.required' => 'Tác giả không được để trống',
            'input_publishing_company.required' => 'Nhà xuất bản không được để trống',
            'input_type.required' => 'Loại tài liệu không được để trống',
            'input_document_name.required' => 'Tên tài liệu dùng không được để trống',
            'input_status.required' => 'Trạng thái không được để trống',
            'input_document_code.unique' => 'Mã sách bị trùng (so sánh cả viết thường không dấu)',
            'input_document_code.required' => 'Mã sách không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $document = new TblDocument();
            $document->id = $request->input_document_code;
            $document->document_name = $request->input_document_name;
            $document->author = $request->input_author;
            $document->publishing_company = $request->input_publishing_company;
            $document->type = $request->input_type;
            $document->status = $request->input_status;
            $document->review = $request->input_review;
            $document->department = $request->input_department;
            $document->created_by = Auth::user()->username;
            $document->save();
            //Tao Log
            $log = new TblLog();
            $log->message = "Đã sửa một tài liệu " . $document->id;
            $log->created_by = Auth::user()->username;
            $log->save();
            return redirect()->back()->with('success', 'Thêm thành công')->withInput();
        }
    }

    public function getAdd() {
        $data['department'] = TblDepartment::all();
        $data['type'] = TblType::all();
        $data['status'] = TblStatus::all();
        return view('admin/document/add', $data);
    }

    public function getAll() {
        $data['document'] = TblDocument::all()->sortByDesc('updated_at');
        return view('admin/document/all', $data);
    }

    public function delete($id) {
        $document = TblDocument::find($id);
        if ($document == "")
            return redirect()->back()->withErrors("Tài liệu không tồn tại")->withInput();
        $document->delete();
        //Tao Log
        $log = new TblLog();
        $log->message = "Đã xóa một tài liệu" . $document->id;
        $log->created_by = Auth::user()->username;
        $log->save();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function getDetail($id) {
        $data['document'] = TblDocument::find($id);
        if ($data['document'] == "")
            return redirect()->back()->withErrors("Tài liệu không tồn tại")->withInput();
        $data['type'] = TblType::all();
        $data['status'] = TblStatus::all();
        $data['department'] = TblDepartment::all();
        return view('admin/document/edit', $data);
    }

    public function getEdit($id) {
        $data['type'] = TblType::all();
        $data['status'] = TblStatus::all();
        $data['department'] = TblDepartment::all();
        $data['document'] = TblDocument::find($id);
        if ($data['document'] == "")
            return redirect()->back()->withErrors("Tài liệu không tồn tại")->withInput();
        return view('admin/document/edit', $data);
    }

    public function postEdit($id, Request $request) {
        $rules = [
            'input_author' => 'required| max: 255',
            'input_document_name' => 'required| max: 255',
            'input_publishing_company' => 'required| max: 255',
            'input_type' => 'required| max: 255',
            'input_borrow_by' => 'max: 255',
            'input_department' => 'required| max: 255',
            'input_status' => 'required| max: 255',
            'input_review' => 'max: 2000',
        ];
        $messages = [
            'input_review.max' => 'Giới thiệu quá dài',
            'input_author.required' => 'Tác giả không được để trống',
            'input_department.required' => 'Khoa không được để trống',
            'input_publishing_company.required' => 'Nhà xuất bản không được để trống',
            'input_type.required' => 'Loại tài liệu không được để trống',
            'input_document_name.required' => 'Tên tài liệu dùng không được để trống',
            'input_status.required' => 'Trạng thái không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $document = TblDocument::find($id);
            if ($document == "")
                return redirect()->back()->withErrors("Tài liệu không tồn tại")->withInput();
            $document->document_name = $request->input_document_name;
            $document->department = $request->input_department;
            $document->author = $request->input_author;
            $document->publishing_company = $request->input_publishing_company;
            $document->type = $request->input_type;
            $document->status = $request->input_status;
            $document->review = $request->input_review;
            if ($request->input_borrow_by == "") {
                $document->borrow_by = null;
            } else {
                $borrow = TblDocument::find($request->input_borrow_by);
                if ($borrow == "") {
                    return redirect()->back()->withErrors("Phiếu mượn khôgn tồn tại")->withInput();
                } else {
                    $document->borrow_by = $request->input_borrow_by;
                }
            }
            $document->updated_by = Auth::user()->username;
            $document->save();
            //Tao Log
            $log = new TblLog();
            $log->message = "Đã sửa một tài liệu " . $document->id;
            $log->created_by = Auth::user()->username;
            $log->save();
            return redirect(url('admin/document/all'))->with('success', 'Sửa thành công');
        }
    }

}
