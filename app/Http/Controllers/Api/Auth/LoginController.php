<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\LoginUserRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiResponses;

    public function __invoke(LoginUserRequest $request): JsonResponse
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error(message: 'Unauthorized');
        }

        $user = User::firstWhere('email', $request->email);

        return $this->ok('Authenticated', data: [
            'token' => $user->createToken(
                name: 'API token for '.$user->email,
                abilities: ['*'],
                expiresAt: now()->addWeek()
            )->plainTextToken
        ],
        );
    }
}
