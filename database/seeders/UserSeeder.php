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
  
      // if (!Technicien::where('email', 'user2@example.com')->exists()) {
      //     Technicien::create([
      //         'nom' => 'anas',
      //         'prenom' => 'Ali',
      //         'address' => 'casablanca',
      //         'telephone' => '1565784',
      //         'disponible' => true,
      //         'email' => 'user2@example.com',
      //         'password' => Hash::make('password12345'), //method hashing password
      //         'role'=> 'technicien',
      //         'specialite' => 'Menage',
      //     ]);
      // }
      
    //   if (!Technicien::where('email', 'user10@example.com')->exists()) {
    //     Technicien::create([
    //         'nom' => 'anas',
    //         'prenom' => 'ferdoussi',
    //         'address' => 'casablancaa',
    //         'telephone' => '15657842',
    //         'disponible' => true,
    //         'email' => 'user10@example.com',
    //         'password' => Hash::make('password1234567'), //method hashing password
    //         'role'=> 'technicien',
    //         'specialite' => 'elec',
    //     ]);
    // }
    if (!Technicien::where('email', 'user4@example.com')->exists()) {
      Technicien::create([
          'nom' => 'anas',
          'prenom' => 'ferdoussi',
          'address' => 'casablancaa',
          'telephone' => '15657842',
          'disponible' => true,
          'email' => 'user4@example.com',
          'password' => Hash::make('password12345678'), //method hashing password
          'role'=> 'technicien',
          'specialite' => 'elec',
      ]);
  }
  
      
  }
  
}
