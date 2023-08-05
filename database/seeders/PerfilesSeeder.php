<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $perfil = new Perfil();
    $perfil->nombre = 'Administrador';
    $perfil->descripcion = 'El administrador principal del sistema';
    $perfil->save();

    $perfil = new Perfil();
    $perfil->nombre = 'Supervidor';
    $perfil->descripcion = 'El supervisor del sistema';
    $perfil->save();

    $perfil = new Perfil();
    $perfil->nombre = 'Cliente';
    $perfil->descripcion = 'El cliente del sistema';
    $perfil->save();
  }
}
