<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class Kelas extends Model
{
  use UsesUuid;

  protected $table = 'kelas';
  protected $primaryKey = 'id';
  protected $guarded = [];

  public function tingkat_kelas()
  {
    return $this->belongsTo('App\Models\TingkatKelas', 'tingkat_kelas_id', 'id');
  }
}
