<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    
   
        
    public function register(RegisterRequest $request){

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success'=> true,
            'message'=> 'register avec success ',
            'data'=> [
                'name'=> $user->name,
                'email'=> $user->email,    
            ],
            'token'=> $token,
        ]);
    }


    
    public function login(LoginRequest $request){
         $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if(!$user || !Hash::check($validated['password'], $user->password)){
            return response()->json(['message'=> 'email ou mote de passe incorrect'], 401);
        };
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success'=> true,
            'message'=>'connexion reussie',
            'data'=> [
               'name'=> $user->name,
               'email'=> $user->email
            ],
            'token'=> $token
        ]);
    }

    public function logout(){
        
        $user = Auth::user();
        if(!$user){

        return response()->json([
            'success'=> false,
            'message'=> 'utilsateur non authentiife',
        ], 401);
        }
        $user->currentAccessToken()->delete();

        return response()->json([
            'success'=> true,
            'message'=> 'deconnxion avec succees',
        ]);
    }
}
