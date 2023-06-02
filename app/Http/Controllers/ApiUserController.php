<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    function userget($email) {
        $arr = [
            'code' => '0'
            , 'msg' => ''
        ];

        $user = DB::select('select name, email from users where email = ?', [$email]); // 비밀번호는 가져오면 안되서 빼고 값 가져오기. email값으로 매칭
        
        if($user) {
            $arr['code'] = '0';
            $arr['msg'] = 'Success Get User';
            $arr['data'] = $user[0];
        } else {
            $arr['code'] = 'E01';
            $arr['msg'] = 'No Data';
        }
        return $arr;
    }

    function userpost(Request $req) {
        $arr = [
            'code' => '0'
            , 'msg' => ''
        ];

        $result = DB::insert(
            'INSERT INTO users(NAME, EMAIL, PASSWORD) VALUES(?,?,?)'
            , [
                $req->name
                ,$req->email
                ,Hash::make($req->password)
            ]);

    if($result) {
        $arr['code'] = '0';
        $arr['msg'] = 'Success Registration';
        $arr['data'] = [$req->email];
    } else {
        $arr['code'] = 'E01';
        $arr['msg'] = 'Faild Registration';
    }
    return $arr;
    }

    function userput(Request $req, $email) {
        $arr = [
            'code' => '0'
            , 'msg' => ''
        ];

        $result = DB::insert(
            'UPDATE users SET NAME = ? WHERE email = ?'
            , [
                $req->name
                ,$email
            ]);

    if($result) {
        $arr['code'] = '0';
        $arr['msg'] = 'Success Update';
        $arr['data'] = [$req->email];
    } else {
        $arr['code'] = 'E01';
        $arr['msg'] = 'Faild Update';
    }
    return $arr;

    }

    function userdelete($email) {
        $arr = [
            'code' => '0'
            , 'msg' => ''
        ];
        $date = Carbon::now();
        $result = DB::insert(
            // 'DELETE FROM users WHERE email = '
            'UPDATE users SET deleted_at = ?, delete_flg = ? WHERE email = ?'
            , [
                $date
                ,'1'
                ,$email
            ]);

    if($result) {
        $arr['code'] = '0';
        $arr['msg'] = 'Success Update';
        $arr['data'] = ['deleted_at' => $date, 'email' => $email];
    } else {
        $arr['code'] = 'E01';
        $arr['msg'] = 'Faild Update';
    }
    return $arr;

    }
}