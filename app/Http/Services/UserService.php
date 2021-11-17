<?php

namespace App\Http\Services;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    /**
     * Validate email and password to login
     *
     * @param string $email
     * @param string $password
     * @throws \Exception
     * @return User
     */
    public function credentialCheck(
        string $email,
        string $password,
    ): User
    {
        $user = User::where('email',$email)->first();
        if (!$user) {
            throw ValidationException::withMessages([__('errors.email_or_password_wrong')]);
        }

        if (!Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([__('errors.email_or_password_wrong')]);
        }

        return $user;
    }

    /**
     * Generate a new token
     *
     * @param array $payload
     * @return array
     */
    public function generateToken(array $payload): array
    {
        $key = config('services.jwt.key');
        $expire = config('services.jwt.expire');

        $payload['exp'] = now()->addSecond($expire)->timestamp;

        return [
            'token' => JWT::encode($payload, $key, 'HS256'),
            'expire_in' => $payload['exp'],
        ];
    }

    /**
     * @param User $user
     * @return array
     */
    public function generatePayload(User $user): array
    {
        $payload = [
            'iss' => 'localhost',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
            ],
        ];

        return $payload;
    }
}
