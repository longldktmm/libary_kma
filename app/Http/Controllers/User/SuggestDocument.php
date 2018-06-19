<?php
namespace App\Http\Controllers\User;
use App\TblSuggestDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SuggestDocument extends Controller {
    public function getAll() {
        $data['suggestDocument'] = TblSuggestDocument::all()->sortByDesc('created_at');
        return view('user/home', $data);
    }
}
