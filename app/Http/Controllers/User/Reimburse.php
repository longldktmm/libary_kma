<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
class Reimburse extends Controller {

    public function getAll() {
        $username = Auth::user()->username;
//        $data['borrow'] = TblBorrow::where('username', $username)->get();
        $data['reimburse'] = DB::table('reimburse')->where('username', $username)->join('document', 'reimburse.document_code', '=', 'document.id')->get();
        return view('user/reimburse/all', $data);
    }
}
