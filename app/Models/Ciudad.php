<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudad extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'ciudades';

  public function departamento() {
    return $this->belongsTo(Departamento::class, "departamento_id");
  }
}
