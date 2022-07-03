<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Auth;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function login(){
        if(!auth()->check()){
            return view('admin.users.login');
        } 
        abort(403);
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->sendLoginErrorResponse($request);
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->sendLoginErrorResponse($request);
        }

        // Return if user is not super_admin or admin ]
        // if ($user->is_admin == 0) {
        //     return $this->sendLoginErrorResponse($request);
        // }
        $remember_token= $request->has('remember_token') ? true : false; 
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']], $remember_token)) {
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['login' => 'Something went wrong while logging you in.']);
        }
    }

    private function sendLoginErrorResponse(Request $request)
    {
        return redirect()->back()->withErrors(['login' => 'These credentials do not match our records.']);
    }

    public function dashboard(){
        $users_count = User::isnotadmin()->count();
        $news_count = News::count();
        $today_news_count = News::whereDate('created_at', Carbon::today())->count();
        return view('admin.dashboard',compact('users_count','news_count','today_news_count'));
    }
    
    public function customerDashboard(Request $request){
        $news = News::with('user')
        ->when($request->user()->id, function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        })
        ->latest()->get();
        return view('admin.customer-dashboard',compact('news'));
    }

    public function changePassword(){
        return view('admin.change-password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:new_password',
        ]);
        if (Hash::check($request->old_password, auth()->user()->password)) {
            auth()->user()->update(['password' => Hash::make($request->new_password)]);
            return redirect()->back()->with(['success' => 'Password Updated Successfully']);
        } else {
            return redirect()->back()->withErrors(['error' => 'Sorry your old password is incorrect']);
        }
    }

    public function admin__logout()
    {
        if(auth()->user()->is_admin){
            Auth::logout();
            Session::flush();
            return redirect()->route('admin.login');
        } else {
            Auth::logout();
            Session::flush();
            return redirect()->route('customer.login');
        }
    }
}
