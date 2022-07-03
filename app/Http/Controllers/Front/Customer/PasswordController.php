<?php

namespace App\Http\Controllers\Front\Customer;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\User;
use App\Rules\Password;
use Illuminate\Http\Request;
use DB,Mail;
use Illuminate\Support\Facades\Hash; 

class PasswordController extends Controller
{
    function forgetPassword(){
        return view('front.customer.forgot-password');
    }

    function resetLink(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        try {
            $details = User::where('email', $request->email)->first();
            $resetHash = sha1(time());
            $password = DB::insert("insert into password_resets (email,token) values(?,?)", [$request->email, $resetHash]);
            $data = ['email' => $request->email, 'token' => $resetHash];
            Mail::to($data['email'])->send(new ResetPassword($data['token'],$details));
            return redirect('/customer/login')->with('success', 'Reset link sent to your email');
        } catch (\Exception $e) {
            return redirect('/customer/login')->with('error', 'Something went wrong! Please try later');
        }
    }

    function resetPassword($hash){
        $exists = DB::table('password_resets')->where('token', $hash)->latest()->first();
        if (!$exists) {
            return redirect('/customer/login')->with('error', 'Not Found');
        }
        return view('front.customer.reset-password', ['email' => $exists->email, 'token' => $exists->token]);
    }

    function savePassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:password_resets,email',
            'token' => 'required|string',
            // 'password' => 'required|string|min:6|max:50|confirmed',
            'password' => ['required', 'string', 'confirmed', new Password()],
        ]);
        $exists = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first();
        if (!$exists) {
            return redirect('/customer/login')->with('error', 'Not Found');
        }
        try {
            $customer = User::where('email', $request->email)->first();
            $customer->password = Hash::make($request->password);
            $customer->save();
            DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->delete();
            return redirect('customer/login')->with('success', 'Password reset successfully');
        } catch (\Exception $e) {
            return redirect('customer/login')->with('error', 'Something went wrong!');
        }
    }
}
