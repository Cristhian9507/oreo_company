<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = new User();
    $user->identificacion = '111111111';
    $user->nombre = 'Oreo admin';
    $user->celular = 3156547820;
    $user->fecha_nacimiento = '1990-01-01';
    $user->ciudad_id = 1011;
    $user->email = 'cristian.sierra@conectib.com';
    $user->password = Hash::make('ConecTIB1');
    $user->perfil_id = 1;
    $user->save();
  }
}
