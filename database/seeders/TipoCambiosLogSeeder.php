<?php

namespace Database\Seeders;

use App\Models\TipoCambioLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoCambiosLogSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $tipo_cambio_log = new TipoCambioLog();
    $tipo_cambio_log->nombre = "creacion";
    $tipo_cambio_log->save();

    $tipo_cambio_log = new TipoCambioLog();
    $tipo_cambio_log->nombre = "edicion";
    $tipo_cambio_log->save();

    $tipo_cambio_log = new TipoCambioLog();
    $tipo_cambio_log->nombre = "eliminacion";
    $tipo_cambio_log->save();

    $tipo_cambio_log = new TipoCambioLog();
    $tipo_cambio_log->nombre = "otro";
    $tipo_cambio_log->save();
  }
}
