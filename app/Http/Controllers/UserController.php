<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginemail' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['email' => $incomingFields['loginemail'],'password'=> $incomingFields['loginpassword']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' =>['required', 'min:3', 'max:15'],
            'email' =>['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:200'],   
        ]);

        $incomingFields['password'] = Hash::make($incomingFields['password']);
        // $user = User::create($incomingFields);
        // auth()->login($user);

        // return redirect('/');

        // Assign a default role (you can customize this logic based on your needs)
        $defaultRole = Role::where('name', 'User')->first();

        // Check if the default role exists
        if ($defaultRole) {
            // Add role_id to the incoming fields
            $incomingFields['role_id'] = $defaultRole->id;

            // Create the user with the assigned role
            $user = User::create($incomingFields);

            // Log in the user
            auth()->login($user);

            return redirect('/');
        } else {
            // Handle the case where the default role is not found
            return back()->with('error', 'Default role not found');
        }
    }
}
