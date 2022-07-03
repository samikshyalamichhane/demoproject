<?php

namespace App\Http\Controllers\Front\Customer;

use App\Http\Controllers\Controller;
use App\Mail\AccountVerification;
use App\Models\User;
use App\Rules\Password;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;

class RegisterController extends Controller
{
    public function form()
    {
        if(!auth()->check()) {
            return view('front.customer.register');
        }
        abort(403);
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:10',
            'password' => ['required', 'string', 'confirmed', new Password()],
            'g-recaptcha-response' => 'required',
        ]);
        try {
            $input = $request->except(['password_confirmation']);
            $input['password'] = Hash::make($input['password']);
            $input['verification_hash'] = sha1(time());
            $input['is_admin'] = 0;
            $input['active'] = 1;
            $user = User::create($input);
            Mail::to($request->email)->send(new AccountVerification($user));
            return redirect()->back()->with('success', 'Registered Successfully! Please verify your email');
            // return redirect('/customer/login')->with('success', 'Succesfully Regsitered!! You can Login now!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', 'Something went wrong! Please try later');
        }
    }

    function verify($hash)
    {
        $customer = User::where('verification_hash', $hash)->first();
        if (!$customer) {
            return redirect('/customer/login')->with('error', 'Customer Not Found!');
        } else {
            if ($customer->verified != null) {
                return redirect('/customer/login')->with('success', 'Account already verified');
            }
            $customer->active = 1;
            $customer->verified = Carbon::now();
            $customer->save();
            return redirect('/customer/login')->with('success', 'Thank You For Verification! You Can Login Now!.');
        }
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
