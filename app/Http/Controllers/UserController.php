<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpKernel\Exception\HttpException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //search by name and pagination


        $users = User::where('name', 'LIKE', '%' . request('name') . '%')->paginate(10);

        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'phone' => 'required|min:5|max:16',
                'role' => 'required',
                'position' => 'nullable',
                'department' => 'nullable',
            ]);

            User::create($request->all());

            return response()->json(['message' => 'User created successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {

            $user = User::findOrFail($id);

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), $e->getCode()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:6',
                'phone' => 'nullable|min:5|max:16',
                'role' => 'required',
                'position' => 'nullable',
                'department' => 'nullable',
            ]);

            // Temukan data user yang akan diupdate
            $user = User::findOrFail($id);

            // Lakukan pembaruan data user
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->phone = $request->phone;
            $user->position = $request->position;
            $user->department = $request->department;
            $user->role = $request->role;
            $user->save();

            // Kirim respon JSON untuk memberitahu bahwa pembaruan berhasil
            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage(), 'errors' => $e->errors()], 422);
        } catch (QueryException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        } catch (HttpException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatusCode());
        } catch (HttpResponseException $e) {
            return response()->json(['message' => 'Terjadi kesalahan dalam respons.'], 500);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Ambil pengguna yang sedang login
            $currentUser = auth()->user();

            // Periksa apakah id yang akan dihapus sama dengan id pengguna yang sedang login
            if ($id == $currentUser->id) {
                throw new \Exception('You cannot delete your own account.');
            }

            User::destroy($id);
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
