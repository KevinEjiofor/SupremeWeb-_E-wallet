<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['pin'] = Hash::make($data['pin']);
        
        return User::create($data);
    }

    public function login(array $credentials)
    {
        if (!auth()->attempt($credentials)) {
            return ['error' => 'Invalid login credentials'];
        }

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return ['token' => $token];
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
    }
}
