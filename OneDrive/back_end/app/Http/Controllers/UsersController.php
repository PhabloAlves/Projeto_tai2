<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {

        $users = User::all();
        return response()->json($users);
    }

    public function show_dados()
    {
        $userId = Auth::id(); //teste, lembrar de mudar quando login voltar
        $user = User::find($userId);
        $userFormatado = [];
        $userFormatado = [[
            'name' => $user->name,
            'email' => $user->email,
        ]];

        return response()->json($userFormatado);
    }


    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
