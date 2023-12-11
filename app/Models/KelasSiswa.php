<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class KelasSiswa extends Model
{
  use UsesUuid;

  protected $table = 'kelas_siswa';
  protected $primaryKey = 'id_kelas_siswa';
  protected $guarded = [];

  public function wali_kelas()
  {
    return $this->belongsTo('App\Models\WaliKelas', 'wali_kelas_id', 'id');
  }

  public function siswa()
  {
    return $this->belongsTo('App\Models\Siswa', 'siswa_id', 'id');
  }
}
