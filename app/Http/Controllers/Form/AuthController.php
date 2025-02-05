<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

   public function register(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        "email"=> "required|email|unique:users",
        'password' => 'required|min:6',
    ]);
    if( $validator->fails() ){
        return $this->data(403, $validator->errors()->first(), null);
    }
    $role = 'user';
    if(User::all()->count() == 0){
        $role = 'admin';
    }
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role'=> $role,
    ]);
    $data =  [
        'token' => $user->createToken('auth_token')->plainTextToken,
        'user' => UserResource::make( $user ),
    ];
    return $this->data(200,'success', $data);
   }

   public function login(Request $request){
    $validator = Validator::make($request->all(), [
        "email"=> "required|email",
        'password' => 'required|min:6',
    ]);
    if( $validator->fails() ){
        return $this->data(403, $validator->errors()->first(), null);
    }
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return $this->data(404, 'Email or password is incorrect', null);
    }
    $data =  [
        'token' => $user->createToken('auth_token')->plainTextToken,
        'user' => UserResource::make($user),
    ];
    return $this->data(200,'success', $data);
   }
}
