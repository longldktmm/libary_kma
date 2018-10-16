<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\TblLog;
use App\TblDocument;
use App\TblBorrow;
use Validator;
use Webpatser\Uuid\Uuid;
use DB;

class Violate extends Controller {

    public function postAdd($username, Request $request) {
        $rules = [
            'input_expiry' => 'numeric',
            'input_document_code' => 'required| max: 255| exists:document,id',
        ];
        $messages = [
            'input_expiry.numeric' => 'Số ngày mượn phải là số',
            'input_document_code.required' => 'Mã sách không được để trống',
            'input_document_code.max' => 'Mã sách quá dài',
            'input_document_code.exists' => 'Mã sách không tồn tại',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
//Tim tai lieu
            $document = TblDocument::find($request->input_document_code);
//Kiem tra tai lieu ton tai
            if ($document == "")
                return redirect()->back()->withErrors("Tài liệu không tồn tại")->withInput();
            if ($document->borrow_by != "")
                return redirect()->back()->withErrors("Tài liệu đã được cho mượn")->withInput();
            if ($document->status == "Mất")
                return redirect()->back()->withErrors("Tài liệu đã được báo mất")->withInput();
            if ($document->status == "Hỏng")
                return redirect()->back()->withErrors("Tài liệu đã được báo hỏng")->withInput();
//Check quyen
            $user = User::where('username', $username)->first();
            if ($user == "")
                return redirect()->back()->withErrors("Người dùng không tồn tại")->withInput();
            if ($document->department == "Mật mã" && $user->department != "Mật mã")
                return redirect()->back()->withErrors("Bạn không có quyền mượn quyển này")->withInput();
            if ($document->type == "Giáo án" && $user->role != "Sinh viên")
                return redirect()->back()->withErrors("Bạn không có quyền mượn quyển này")->withInput();
//Tao phieu muon
            $borrow = new TblBorrow();
            $borrow->id = Uuid::generate(4);
            $borrow->document_code = $request->input_document_code;
            $borrow->username = $username;
            $borrow->expiry = $request->input_expiry;
            $borrow->document_status = $document->status;
            $borrow->created_by = Auth::user()->username;
            $borrow->save();
//Update tai lieu
            $document->borrow_by = $borrow->id;
            $document->save();
            
//Tao Log
            $log = new TblLog();
            $log->message = "Đã cho ".$username." mượn một quyển sách";
            $log->created_by = Auth::user()->username;
            $log->save();                
            return redirect()->back()->with('success', 'Thêm thành công')->withInput();
        }
    }

    public function getAdd($username) {
        $data['user'] = User::where('username', $username)->first();
        $data['borrow'] = DB::table('borrow')->where('username', $username)->join('document', 'borrow.document_code', '=', 'document.id')->get();
//        $data['borrow'] = TblBorrow::where('username', $username)->get();
        return view('admin/borrow/borrow', $data);
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
            return redirect()->route('userProfile', [$request->input_username]);
        }
    }

    public function delete($id) {
        $borrow = TblBorrow::where('document_code', $id)->first();
        if ($borrow == "")
            return redirect()->back()->withErrors("Phiếu mượn không tồn tại")->withInput();
        $borrow->delete();
        //Tao Log
            $log = new TblLog();
            $log->message = "Đã xóa ".$id;
            $log->created_by = Auth::user()->username;
            $log->save();      
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function getAll() {
        $data['borrow'] = DB::table('borrow')->join('document', 'borrow.document_code', '=', 'document.id')->get();
//        $data['borrow'] = \App\TblBorrow::all()->sortByDesc('created_at');
        return view('admin/borrow/all', $data);
    }

}
