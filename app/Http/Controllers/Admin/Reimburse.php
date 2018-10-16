<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\TblReimburse;
use App\TblDocument;
use App\TblBorrow;
use App\TblLog;
use App\TblStatus;
use Validator;
use Webpatser\Uuid\Uuid;
use DB;
use App\TblStatistics;
class Reimburse extends Controller {

    public function postAdd($username, Request $request) {
        $rules = [
            'input_commit' => ' max: 500',
            'input_document_code' => 'required| max: 255',
            'input_document_status' => 'required',
        ];
        $messages = [
            'input_expiry.max' => 'Chú thích quá dài',
            'input_document_code.required' => 'Mã sách không được để trống',
            'input_document_code.max' => 'Mã sách quá dài',
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
            if (is_null($document->borrow_by))
                return redirect()->back()->withErrors("Tài liệu chưa được ai mượn hoặc đã được trả")->withInput();
            $borrow = TblBorrow::find($document->borrow_by);
            if ($borrow == "")
                return redirect()->back()->withErrors("Phiếu mượn không tồn tại")->withInput();
            if ($borrow->username != $username)
                return redirect()->back()->withErrors("Không được trả sách hộ")->withInput();
//Xóa phiếu mượn
            $borrow->delete();

//Tao phieu trả
            $reimburse = new TblReimburse();
            $reimburse->id = Uuid::generate(4);
            $reimburse->document_code = $request->input_document_code;
            $reimburse->username = $username;
            $reimburse->commit = $request->input_commit;
            $reimburse->document_status = $request->input_document_status;
            $reimburse->created_by = Auth::user()->username;
            $reimburse->save();
//Update tai lieu
            $document->borrow_by = null;
            $document->save();
            //Update so luong
            $documentStatistics = TblStatistics::where('document_name', $document->document_name)
                    ->where('author', $document->author)
                    ->where('type', $document->type)
                    ->where('department', $document->department)
                    ->first();
            if ($documentStatistics != null) {
                $documentStatistics->ready++;
                $documentStatistics->save();
            }
            //Tao Log
            $log = new TblLog();
            $log->message = "Đã trả một quyển sách " . $document->id;
            $log->created_by = Auth::user()->username;
            $log->save();
            return redirect()->back()->with('success', 'Trả thành công')->withInput();
        }
    }

    public function getAdd($username) {
        $data['user'] = User::where('username', $username)->first();
        $data['status'] = TblStatus::all();
//        $data['borrow'] = TblBorrow::where('username', $username)->get();
        $data['borrow'] = DB::table('borrow')->where('username', $username)->join('document', 'borrow.document_code', '=', 'document.id')->get();
        return view('admin/reimburse/reimburse', $data);
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
            return redirect()->route('userProfileReimburse', [$request->input_username]);
        }
    }

    public function delete($id) {
        $reimburse = TblReimburse::where('document_code', $id)->first();
        if ($reimburse == "")
            return redirect()->back()->withErrors("Phiếu trả không tồn tại")->withInput();
        $reimburse->delete();
        //Tao Log
        $log = new TblLog();
        $log->message = "Đã xóa một phiếu trả " . $reimburse->id;
        $log->created_by = Auth::user()->username;
        $log->save();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function getAll() {
        $data['reimburse'] = DB::table('reimburse')->join('document', 'reimburse.document_code', '=', 'document.id')->get();
        return view('admin/reimburse/all', $data);
    }

}
