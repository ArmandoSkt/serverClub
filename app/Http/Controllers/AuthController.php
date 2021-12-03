<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Instructor;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\JWT;

class AuthController extends Controller
{
    public function login($id,$password){
        // $this->validate($req, [
        //     'id'=>'required', 
        //     'pass'=>'required']);

        //$result = Instructor::find($id);
        $result = Instructor::where('usuario', $id)->first();
        //return response()->json(['status'=>$result], 404);
        if($result){
            if (Hash::check($password, $result->password)){
                return response()->json([
                    'auth' => true,
                    'id' => $result,
                    'token' => JWT::create($result, env('JWT_SECRET', 'wGBSdbP8orgkXKRMHnOzC6IeWsG8rdXc'))
                ], 200);
            }else{
                return response()->json(['status'=>'failed'], 404);
            }
        }else{
            return response()->json(['status'=>'failed'], 404);
        }

    
    }
}