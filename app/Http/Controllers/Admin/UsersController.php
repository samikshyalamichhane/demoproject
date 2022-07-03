<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        $this->authorize('users-list');
        $users = User::isnotadmin()->get();
        return view('admin.users.list',compact('users'));
    }
}
