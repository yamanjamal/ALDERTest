<?php

namespace App\Http\Controllers\BaseCode\SanctumRegisteration;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SanctumRegister\LoginRequest;
use App\Http\Requests\SanctumRegister\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends BaseController
{

    /**
     * [register description]
     * @param  RegisterRequest $request     [description]
     * @param       [description]
     * @return [type]                       [description]
     */
    public function register(RegisterRequest $request)
    {
        $input=$request->validated();
        
        $user = User::create([
                'name'     => $request->name,
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role_id'    => $request->role_id,
            ]);


        $token['token']=$user->createtoken('task,project')->plainTextToken;
        
        return $this->sendResponse(new UserResource($user),'user regsterd successfully');
    }
    
    /**
     * 
     * @param  LoginRequest $request     [description]
     * @param    [description]
     * @return [type]                    [description]
     */
    public function login(LoginRequest $request ){
       
        $user=User::where('username',$request->username )->first();
        if (!$user) {
            return $this->sendError('thier is no such username');
        }

        if (!Hash::check($request->password ,$user->password)) {
            return $this->sendError('Incorrect password');
        }

        $token['token']=$user->createtoken('alder,project')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token,
        ];
        return $this->sendResponse($response,'you logged in congrats');
    }

    /**
     * [logout description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return ['message'=>'logged out'];
    }
}
