<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            $loginData = $request->validate([
                'email' => ['required', 'email'],
                'password' => 'required',
            ]);

            $user = User::where('email', $loginData['email'])->first();

            if (!$user) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            if (!Hash::check($loginData['password'], $user->password)) {
                return response()->json(['message' => 'Invalid password'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'access_token' => $token,
                'type' => 'Bearer',
            ], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e,]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e,]);
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'face_embedding' => 'required'
        ]);

        $user = $request->user();
        $image = $request->file('image');
        $face_embedding = $request->face_embedding;

        // Cek apakah pengguna memiliki gambar lama dan hapus jika ada
        if ($user->image_url) {
            Storage::delete('public/images/' . $user->image_url);
        }

        // Simpan gambar baru
        $image->storeAs('public/images', $image->hashName());
        $user->image_url = $image->hashName();
        $user->face_embedding = $face_embedding;
        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user,
        ], 200);
    }
}
