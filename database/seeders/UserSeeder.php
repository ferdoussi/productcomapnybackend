<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Technicien;
class UserSeeder extends Seeder
{
  public function run()
  {
      // if (!User::where('email', 'user10@example.com')->exists()) {
      //     User::create([
      //         'name' => 'Test User 2',
      //         'email' => 'user10@example.com',
      //         'password' => Hash::make('password123456'), //method hashing password
      //         'role'=> 'client'
      //     ]);
      // }
  
      if (!Technicien::where('email', 'thenicien@example.com')->exists()) {
          Technicien::create([
              'nom' => 'anas',
              'prenom' => 'Ali',
              'address' => 'casablanca',
              'telephone' => '1565784',
              'disponible' => true,
              'email' => 'thenicien@example.com',
              'password' => Hash::make('password1234'), //method hashing password
              'role'=> 'technicien',
              'specialite' => 'Menage',
          ]);
      }
  
      // if (!User::where('email', 'user3@example.com')->exists()) {
      //     User::create([
      //         'name' => 'Test User 3',
      //         'email' => 'user3@example.com',
      //         'password' => Hash::make('password12345'), //method hashing password
      //         'role'=> 'superviseur'
      //     ]);
      // }
  }
  
}
