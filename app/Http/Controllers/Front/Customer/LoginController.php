<?php

namespace App\Http\Controllers\Front\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    function form(Request $request)
    {
        // if(auth()->user()->is_admin){
        //     abort(403);

        // }
        if (!auth()->check() || auth()->user()->is_admin) {
            return view('front.customer.login');
        }
        abort(403);
    }

    function submit(Request $request)
    {
        $this->validate($request, [
            'login' => 'sometimes|max:50',
            'password' => 'required|string|max:50',
            'g-recaptcha-response' => 'required',
        ]);

        $user = User::where('email', $request->login)->orWhere('phone_number',$request->login)->first();
        if (!$user) {
            return back()->withErrors(['login' => 'Email And Password Donot Match!']);
        }
        if ($user->is_admin == 1) {
            return back()->withErrors(['login'  => 'UnAuthenticated!']);
        }
        if ($user->active == 0) {
            return back()->withErrors(['login'  => 'Please Verify Your Account First!']);
        }
        $remember_token= $request->has('remember_token') ? true : false;
        if(Auth::attempt(['phone_number' => request('login'), 'password' => request('password')]) ||
        Auth::attempt(['email' => $request->login, 'password' => $request->password, 'is_admin' => 0], $remember_token)) {
            return redirect()->route('customer-dashboard');
        } else {
            return back()->withErrors(['login' => 'Email And Password Donot Match!']);
        }
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->stateless()->user();
        $this->_registerOrLoginUser($user);
        return redirect()->route('customer-dashboard');
        // $user->token
    }

    protected function _registerOrLoginUser($data){
        try{
        $user = User::where('email',$data->email)->first();
        if(!$user){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            // $user->phone_number = $data->phone_number;
            $user->provider_id = $data->id;
            $user->save();
        }
        Auth::login($user);
    } catch (Exception $e) {
        // dd($e->getMessage());
        dd('hi');
    }
    }

}
