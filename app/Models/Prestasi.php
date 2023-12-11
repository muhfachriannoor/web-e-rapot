<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class Prestasi extends Model
{
  use UsesUuid;

  protected $table = 'prestasi';
  protected $primaryKey = 'id_prestasi';
  protected $guarded = [];

  const CREATED_AT = 'created_at_prestasi';
  const UPDATED_AT = 'updated_at_prestasi';

  public function rapot()
  {
    return $this->belongsTo('App\Models\Rapot', 'rapot_id', 'id_rapot');
  }
}
