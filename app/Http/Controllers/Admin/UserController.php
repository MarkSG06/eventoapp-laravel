<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    public function __construct(private User $user) {}

    public function index()
    {
        $records = $this->user->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users.index', compact('records'));
    }

    public function create()
    {
        if (request()->ajax()) {
            return response()->json([
                'form' => view('forms.users', [
                    'user' => new User()
                ])->render()
            ]);
        }
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        unset($data['password_confirmation']);

        $this->user->create($data);

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'table' => $this->renderTable(),
            'form'  => $this->renderForm(new User())
        ]);
    }

    public function edit(User $user)
    {
        return response()->json([
            'form' => $this->renderForm($user)
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        unset($data['password_confirmation']);

        if (!$request->filled('password')) {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'table' => $this->renderTable(),
            'form'  => $this->renderForm($user)
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'Usuario eliminado correctamente',
            'table' => $this->renderTable(),
            'form'  => $this->renderForm(new User())
        ]);
    }

    private function renderTable()
    {
        $records = $this->user->orderBy('created_at', 'desc')->paginate(10);

        return view('components.tables.users', compact('records'))->render();
    }

    private function renderForm($user)
    {
        return view('components.forms.users', compact('user'))->render();
    }
}