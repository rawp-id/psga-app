<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function updateAdmin(Request $request, User $user)
    {
        $user->is_admin = !$user->is_admin;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function updateKonsultan(Request $request, User $user)
    {
        $user->is_konsultan = !$user->is_konsultan;
        $user->save();

        return redirect()->route('admin.users.index');
    }
}
