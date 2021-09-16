<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{

    public function index() {
        return view('users', [
            'users' => User::query()->with('role:id,name')->paginate(10),
            'roles' => Role::query()->get()
        ]);
    }

}