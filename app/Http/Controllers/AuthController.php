<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Technicien;  // تأكد من استيراد النموذج بشكل صحيح

class AuthController extends Controller
{
  public function login(Request $request)
  {
      // Validate input
      $request->validate([
          'email' => 'required|email',
          'password' => 'required',
      ]);
  
      Log::info('Login attempt for email: ' . $request->email);
  
      // Check if email exists in the users table
      $user = User::where('email', $request->email)->first();
  
      if ($user) {
          if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
              Log::info('User successfully logged in: ' . $user->email);
  
              $token = $user->createToken('authToken')->plainTextToken;
  
              return response()->json([
                  'token' => $token,
                  'user' => $user,
                  'message' => 'This user is from users table',
                  'role' => $user->role, // Return the user's role
              ]);
          } else {
              Log::warning('Failed login attempt for user in users table: ' . $request->email);
              return response()->json(['message' => 'Invalid credentials'], 401);
          }
      }
  
      // Check if email exists in the techniciens table
      $technicien = Technicien::where('email', $request->email)->first();
  
      if ($technicien) {
          if (password_verify($request->password, $technicien->password)) {
              Log::info('Technicien successfully logged in: ' . $technicien->email);
  
              return response()->json([
                  'user' => $technicien,
                  'message' => 'This user is from techniciens table',
                  'role' => 'technicien', // Fixed role for techniciens
              ]);
          } else {
              Log::warning('Failed login attempt for technicien: ' . $request->email);
              return response()->json(['message' => 'Invalid credentials'], 401);
          }
      }
  
      Log::warning('Email not found in any table: ' . $request->email);
      return response()->json(['message' => 'Email not found'], 404);
  }
  

    public function logout(Request $request)
    {
        // Log logout action
        Log::info('User logged out: ' . $request->user()->email); 

        // Revoke all tokens for the authenticated user
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    /**
     * Retrieve the currently authenticated user.
     */
    public function getUser(Request $request)
    {
        // Log user information retrieval
        Log::info('User details retrieved: ' . $request->user()->email);

        return response()->json($request->user());
    }
    public function show($id)
    {
        $user = User::find($id); // Retrieve the user from the database
        return view('user.show', ['user' => $user]); // Pass user to view
    }
}
