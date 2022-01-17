<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', Rule::unique('users')],
            'name' => ['required', 'min:3', 'max:32'],
            'role' => ['required', 'numeric'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) return ResponseHelper::buildError('Failed to create new user', $validator->errors()->first(), 400);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ]);

        return ResponseHelper::buildSuccess('User created successfuly', [], 201);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
