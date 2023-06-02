<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login() {
        return view('login');
    }

    // Request와 PHP 글로벌 변수 GET, POST와는 성격이 다름. Request는 전부 다 가져옴.
    public function loginpost(Request $req) {
        Log::debug("Login Start", $req->only('email', 'password'));

        Log::debug("Validator Start");
        // 유효성 체크 (vallidate 메소드를 쓰느냐(잘 안 씀), 새로운 vallidate 객체를 만드느냐)
        $validate = Validator::make($req->only('email', 'password'), [
            'email' => 'required|email|max:30'
            ,'password' => 'required|min:8'
        ]);
        Log::debug("Validator end");

        if($validate->fails()) {
            Log::debug("Validator fails Start");

            return redirect()->back()->withErrors($validate);
        }

        // 유저 정보 습득(쿼리빌더)
        $user = DB::select('select id, email, password from users where email = ?', [
            $req->email 
        ]);
        // if(!$user || !Hash::check($req->password === $user[0]->password)) {
            if(!$user || $req->password === $user[0]->password) {
            return redirect()->back()->withErrors(['아이디와 비밀번호를 확인해 주세요.']);
        }
        Log::debug("Select user", $user[0]);

        // 유저인증 작업
        Auth::login($user[0]->id);
        if(!Auth::check()) {
            Log::debug("유저인증 NG");
            return redirect()->back()->withErros('인증처리 에러');
        } else {
            Log::debug("유저인증 OK");
            return redirect('/');
        }
    }
}