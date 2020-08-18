<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examuser;
use DB;
use Response;

class UserController extends Controller
{
    public function create(Request $req){

        if(empty($req->Account) || empty($req->Password)){
            return Response::make([
                "Code" => 0,
                "Message" => "",
                "Result" => [
                    "IsOK" => false
                ]
            ], 200);
        }
        $AccountExist = "";
        $AccountExist = Examuser::select('Account')->where('Account', '=', $req->Account)->get();

        if(!empty($AccountExist[0])){
            // Account not exist
            return Response::make([
                "Code" => 0,
                "Message" => "",
                "Result" => [
                    "IsOK" => false
                ]
            ], 200);
        }
        
        Examuser::create([
            "Account" => $req->Account,
            "Password" => $req->Password 
        ]);

        return Response::make([
            "Code" => 0,
            "Message" => "",
            "Result" => [
                "IsOK" => true
            ]
        ], 200);
    }

    public function delete(Request $req){

        $user = DB::table('examusers')->where('Account', $req->Account)->first();
        
        if(empty($user)){
            return Response::make([
                "Code" => 0,
                "Message" => "",
                "Result" => [
                    "IsOK" => false
                ]
            ], 200);
        }
        
        // delete
        DB::table('examusers')->where('Account', '=', $user->Account)->delete();

        return Response::make([
            "Code" => 0,
            "Message" => "",
            "Result" => [
                "IsOK" => true
            ]
        ], 200);
    }

    public function pwdChange(Request $req){

        $oldUser = DB::table('examusers')->where('Account', $req->Account)->first();

        DB::table('examusers')
            ->where('Account', $req->Account)
            ->update(["Password" => $req->Password]);

        $newUser = DB::table('examusers')->where('Account', $req->Account)->first();

        if($newUser->Password == $oldUser->Password){
            // fail
            return Response::make([
                "Code" => 0,
                "Message" => "",
                "Result" => [
                    "IsOK" => false
                ]
            ], 200);
        }
 
        return Response::make([
            "Code" => 0,
            "Message" => "",
            "Result" => [
                "IsOK" => true
            ]
        ], 200);
    }

    public function login(Request $req){

        $user = DB::table('examusers')->where('Account', $req->Account)->first();

        if(empty($user)){
            // No account
            return Response::make([
                "Code" => 2,
                "Message" => "Login Failed",
                "Result" => null
            ], 400);
        }
        
        if($user->Password == $req->Password){
            // success
            return Response::make([
                "Code" => 0,
                "Message" => "",
                "Result" => null
            ], 200);
        }else{
            return Response::make([
                "Code" => 2,
                "Message" => "Login Failed",
                "Result" => null
            ], 400);
        }
        // 若驗證失敗則回傳 code: 2，message : Login Failed，http code 回傳 400 (StatusBadRequest)

        // Example:
        // {
        //     "Code": 2,
        //     "Message": "Login Failed",
        //     "Result": null
        // }

        // 若驗證成功則回傳 code: 0，message : ""，http code 回傳 200 (StatusOK)

        // Example:
        // {
        //     "Code": 0,
        //     "Message": "",
        //     "Result": null
        // }


    }


}
