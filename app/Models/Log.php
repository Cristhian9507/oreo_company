<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log as FacadesLog;

class Log extends Model
{
  use HasFactory;
  protected $table = 'logs';

  public static function registarLog($modulo, $tipo_cambio_log, $descripcion) {
    $log = new Log();
    $log->modulo = $modulo;
    $log->tipo_cambio_id = $tipo_cambio_log;
    $log->descripcion = json_encode($descripcion);
    if($log->save()) {
      FacadesLog::info("Log guardado correctamente");
    } else {
      FacadesLog::info("Ups, sucedió un error tratando de guardar el log");
    }
  }
}
