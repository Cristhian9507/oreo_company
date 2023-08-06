<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'departamentos';

  public function pais() {
    return $this->belongsTo(Pais::class, "pais_id");
  }
}
