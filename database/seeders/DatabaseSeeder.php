<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(PaisesSeeder::class);
    $this->call(DepartamentosSeeder::class);
    $this->call(CiudadesSeeder::class);
    $this->call(PerfilesSeeder::class);
    $this->call(UsersSeeder::class);
  }
}
