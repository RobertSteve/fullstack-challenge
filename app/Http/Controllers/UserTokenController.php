<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserTokenController extends Controller
{

    public function __invoke(LoginRequest $request): JsonResponse
    {
        /** @var USer $user */
        $user = User::firstWhere('email', $request->email);
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['message' => 'Datos invalidos.']);
        }
        return response()->json([
            'success' => true,
            'message' => 'Se ha logeado correctamente',
            'data' => [
                'token' => $user->createToken($request->device)->plainTextToken,
                $user->token

            ]
        ], 200);
    }
}
