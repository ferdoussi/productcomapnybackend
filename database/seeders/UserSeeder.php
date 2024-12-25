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
      if (!User::where('email', 'user7@example.com')->exists()) {
          User::create([
              'name' => 'anas',
              'email' => 'user7@example.com',
              'password' => Hash::make('password1238'), //method hashing password
              'role'=> 'client'
          ]);
      }
  
      // if (!Technicien::where('email', 'user2@example.com')->exists()) {
      //     Technicien::create([
      //         'nom' => 'Ahmed',
      //         'prenom' => 'Ali',
      //         'address' => 'casablanca',
      //         'telephone' => '1565784',
      //         'disponible' => true,
      //         'email' => 'user2@example.com',
      //         'password' => Hash::make('password1234'), //method hashing password
      //         'role'=> 'technicien',
      //         'specialite' => 'Electricity',
      //     ]);
      // }
  
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
