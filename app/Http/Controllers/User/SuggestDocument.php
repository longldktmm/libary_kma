<?php

namespace App\Http\Controllers\User;

use App\TblStatistics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuggestDocument extends Controller {

    public function getAll() {
        $data['suggestDocument'] = TblStatistics::select(['type', 'department',
                    'author', 'ready', 'document_name'])->orderBy('updated_at', 'DEC')->take(5)->get();
        return view('user/home', $data);
    }

}
