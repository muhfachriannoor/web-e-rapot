<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class WaliKelas extends Model
{
  use UsesUuid;

  protected $table = 'wali_kelas';
  protected $primaryKey = 'id';
  protected $guarded = [];

  public function tahun_ajaran()
  {
    return $this->belongsTo('App\Models\TahunAjaran', 'tahun_ajaran_id', 'id');
  }

  public function kelas()
  {
    return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
  }

  public function guru()
  {
    return $this->belongsTo('App\Models\Guru', 'guru_id', 'id');
  }
}
