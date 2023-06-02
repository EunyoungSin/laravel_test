<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiUserController extends Controller
{
    function userget($email) {
        $user = DB::select('select name, email from users where email = ?', [$email]); // 비밀번호는 가져오면 안되서 빼고 값 가져오기. email값으로 매칭
        return $user[0];
    }

    function userpost(Request $req) {

    }

    function userput(Request $req, $email) {

    }

    function userdelete($email) {

    }
}
