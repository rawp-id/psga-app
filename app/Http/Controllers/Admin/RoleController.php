<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:roles',
            'label' => 'nullable|string|max:255',
        ]);

        Role::create($request->only('name', 'label'));

        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil ditambahkan!');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:roles,name,' . $role->id,
            'label' => 'nullable|string|max:255',
        ]);

        $role->update($request->only('name', 'label'));

        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil diperbarui!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil dihapus!');
    }
}
