<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCambioLog extends Model
{
  use HasFactory, SoftDeletes;
  protected $table = 'tipo_cambios_logs';
  const TIPO_CAMBIO_CREACION_ID = 1;
  const TIPO_CAMBIO_EDICION_ID = 2;
  const TIPO_CAMBIO_ELIMINACION_ID = 3;
  const TIPO_CAMBIO_OTRO_ID = 4;
}
