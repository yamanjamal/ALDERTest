<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Registerationcontroller extends Controller
{
    //
}

<?php

namespace App\Http\BaseCode\SanctumRegisteration;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SanctumRegister\LoginRequest;
use App\Http\Requests\SanctumRegister\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Registerationcontroller extends BaseController
{

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
    public function logout(){
       
        auth()->user()->tokens()->delete();
        return ['message'=>'logged out'];
    }
}
