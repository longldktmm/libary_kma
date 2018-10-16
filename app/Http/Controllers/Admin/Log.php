<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\TblLog;
use Validator;
class Log extends Controller {
    public function getAll() {
        $data['log'] = TblLog::all()->sortByDesc('created_at');
        return view('admin/home_admin', $data);
    }
}