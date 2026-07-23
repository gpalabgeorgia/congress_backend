<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Список всех админов
    public function index()
    {
        $admins = Admin::all();
        return view('admins.index', compact('admins'));
    }

    // Форма создания
    public function create()
    {
        return view('admins.create');
    }

    // Сохранение нового админа
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:191',
            'last_name'  => 'required|string|max:191',
            'country'    => 'required|string|max:191',
            'city'       => 'required|string|max:191',
            'address'    => 'required|string|max:191',
            'phone'      => 'required|string|max:191',
            'email'      => 'required|email|unique:admins,email',
            'password'   => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Admin::create($validated);

        return redirect()->route('admins.index')->with('success', 'Администратор успешно создан!');
    }

    // Редактирование
    public function edit(Admin $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    // Обновление
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:191',
            'last_name'  => 'required|string|max:191',
            'country'    => 'required|string|max:191',
            'city'       => 'required|string|max:191',
            'address'    => 'required|string|max:191',
            'phone'      => 'required|string|max:191',
            'email'      => 'required|email|unique:admins,email,' . $admin->id,
            'password'   => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);

        return redirect()->route('admins.index')->with('success', 'Данные администратора обновлены!');
    }

    // Удаление
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Администратор удален!');
    }
}
