<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $this->authorize('manage', User::class);

        return response()->view('users', [
            'users' => User::query()->with('role:id,name')->paginate(10),
            'roles' => Role::query()->get()
        ]);
    }

    public function destroy(User $user) {
        $this->authorize('manage', User::class);
        $user->delete();

        return response()->redirectToRoute('users.index');
    }
}