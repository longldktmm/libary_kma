<?php
namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
class Borrow extends Controller {
    public function getAll() {
        $username= Auth::user()->username;
//        $data['borrow'] = TblBorrow::where('username', $username)->get();
         $data['borrow'] = DB::table('borrow')->where('username', $username)->join('document', 'borrow.document_code', '=', 'document.id')->get();
        return view('user/borrow/all', $data);
    }
}
