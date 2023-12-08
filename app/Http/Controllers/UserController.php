<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();

        if ($request->expectsJson()) {
            // Se a requisição espera uma resposta JSON (API)
            return response()->json(['users' => $users], 200);
        }

        // Caso contrário, renderize a view para exibir os usuários na interface web
        return view('users.index', compact('users'));
    }


    public function create(): View
    {
        return view('users.create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        return response()->json(['user' => $user]);
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        $validatedData = $request->validated();

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        return response()->json(['message' => 'Usuário editado com sucesso!']);
    }
    public function destroy(User $user): JsonResponse
    {
        try {
            $user->delete();

            return response()->json(['message' => 'Usuário excluído com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao excluir usuário: ' . $e->getMessage());
            return response()->json(['message' => 'Ocorreu um erro ao excluir o usuário!']);
        }
    }
}
