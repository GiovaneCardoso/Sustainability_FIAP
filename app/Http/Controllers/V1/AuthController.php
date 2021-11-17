<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginCreateRequest;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Try attempt login
     *
     * @param LoginRequest $request
     * @param UserService $service
     * @throws Exception
     * @return JsonResponse
     */
    public function login(LoginRequest $request, UserService $service): JsonResponse
    {
        $user = $service->credentialCheck(
            $request->get('email'),
            $request->get('password'),
        );

        $payload = $service->generatePayload($user);
        $token = $service->generateToken($payload);

        return response()->json($token, Response::HTTP_CREATED);
    }

    public function create(LoginCreateRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => Hash::make($request->get('password')),
        ]);

        return response()->json($user, Response::HTTP_CREATED);
    }
}
