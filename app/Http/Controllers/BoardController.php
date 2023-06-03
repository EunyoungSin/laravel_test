<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    function list() {
        $result = DB::select("select * from boards where delete_flg = '0'");
        
        return view('list')->with('list', $result);
    }

    function write() {
        return view('write');
    }

    function store(Request $req) {
        $req->validate([
            'title' => 'required'
            ,'content' => 'required'
        ]);
        $date = Carbon::now();
        DB::insert('insert into boards (title, content, created_at, updated_at, write_user_id)
        values (?, ?, ?, ?, ?)', [$req->title, $req->content, $date, $date, 1]); // write_user_id는 원래 세션에 저장되어있으니 해당 값을 넣어야함.
        
        return redirect()->route('board.index');
    }
}
