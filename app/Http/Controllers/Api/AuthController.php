<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return bool
     */
    public function postLogin(Request $request)
    {
        if(\Auth::once($this -> getCredentials($request))){
            \Auth::user() -> api_token = Str::random(60);
            \Auth::user() -> save();
            return \Auth::user();
        }else{
            return response('Unauthorized.', 401);
        }
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only('name', 'password');
    }
}
