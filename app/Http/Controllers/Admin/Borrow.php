<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\TblStatus;
use App\TblType;
use App\TblDocument;
use Validator;
use DB;
use Webpatser\Uuid\Uuid;

class Borrow extends Controller {

    public function postAdd(Request $request) {
        $rules = [
            'input_username' => 'required| max: 255 | exists:users,username',
            'input_document_code' => 'required| max: 255| exists:document,id',
        ];
        $messages = [
            'input_username.max' => 'Mã người dùng quá dài',
            'input_username.required' => 'Mã người dùng không được để trống',
            'input_username.exists' => 'Mã người dùng không tồn tại',
            'input_document_code.required' => 'Mã sách không được để trống',
            'input_document_code.max' => 'Mã sách quá dài',
            'input_document_code.exists' => 'Mã sách không tồn tại',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
//            $document = new TblDocument();
//            $document->id = $request->input_document_code;
//            $document->document_name = $request->input_document_name;
//            $document->author = $request->input_author;
//            $document->publishing_company = $request->input_publishing_company;
//            $document->type = bcrypt($request->input_type);
//            $document->status = $request->input_status;
//            $document->review = $request->input_review;
//            $document->created_by = Auth::user()->username;
//            $document->save();
            return redirect()->back()->with('success', 'Thêm thành công')->withInput();
        }
    }

    public function getAdd($username) {
        $data['user'] = User::where('username', $username)->first();
        $data['document'] = TblDocument::find(0);
        $data['borrow'] = [];
        return view('admin/borrow/all', $data);
    }

    public function getHome() {
        return view('admin/borrow/home');
    }

    public function postHome(Request $request) {
        $rules = [
            'input_username' => 'required| max: 255 | exists:users,username',
        ];
        $messages = [
            'input_username.max' => 'Mã người dùng quá dài',
            'input_username.required' => 'Mã người dùng không được để trống',
            'input_username.exists' => 'Mã người dùng không tồn tại',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            return redirect();
        }
    }

    public function getAll() {
        $data['document'] = \App\TblDocument::all()->sortByDesc('updated_at');
        return view('admin/document/all', $data);
    }

    public function delete($id) {
        $document = TblDocument::find($id);
        if ($document == "")
            return redirect()->back()->withErrors("Tài liệu không tồn tại")->withInput();
        $document->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function getEdit($id) {
        $data['document'] = TblDocument::find($id);
        $data['type'] = TblType::all();
        $data['status'] = TblStatus::all();
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
            'input_status' => 'required| max: 255',
            'input_review' => 'max: 255',
        ];
        $messages = [
            'input_review.max' => 'Giới thiệu quá dài',
            'input_author.required' => 'Tác giả không được để trống',
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
            $document->author = $request->input_author;
            $document->publishing_company = $request->input_publishing_company;
            $document->type = $request->input_type;
            $document->status = $request->input_status;
            $document->review = $request->input_review;
            $document->updated_by = Auth::user()->username;
            $document->save();
            return redirect(url('admin/document/all'))->with('success', 'Sửa thành công');
        }
    }

    public function getBorrow() {
        $data['document'] = \App\TblDocument::all()->sortByDesc('updated_at');
        return view('admin/document/all', $data);
    }

}
