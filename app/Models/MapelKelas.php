<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class MapelKelas extends Model
{
  use UsesUuid;

  protected $table = 'mapel_kelas';
  protected $primaryKey = 'id';
  protected $guarded = [];

  public function tahun_ajaran()
  {
    return $this->belongsTo('App\Models\TahunAjaran', 'tahun_ajaran_id', 'id');
  }

  public function tingkat_kelas()
  {
    return $this->belongsTo('App\Models\TingkatKelas', 'tingkat_kelas_id', 'id');
  }

  public function mata_pelajaran()
  {
    return $this->belongsTo('App\Models\MataPelajaran', 'mapel_id', 'id');
  }
}
