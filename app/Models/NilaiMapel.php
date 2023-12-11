<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class NilaiMapel extends Model
{
  use UsesUuid;

  protected $table = 'nilai_mapel';
  protected $primaryKey = 'id_nilai_mapel';
  protected $guarded = [];

  const CREATED_AT = 'created_at_nilai';
  const UPDATED_AT = 'updated_at_nilai';

  public function rapot()
  {
    return $this->belongsTo('App\Models\Rapot', 'rapot_id', 'id_rapot');
  }

  public function mata_pelajaran()
  {
    return $this->belongsTo('App\Models\MataPelajaran', 'id_mapel', 'id');
  }
}
