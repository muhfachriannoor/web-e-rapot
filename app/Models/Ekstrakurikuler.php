<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class Ekstrakurikuler extends Model
{
  use UsesUuid;

  protected $table = 'ekstrakurikuler';
  protected $primaryKey = 'id_ekstrakurikuler';
  protected $guarded = [];

  const CREATED_AT = 'created_at_ekstrakurikuler';
  const UPDATED_AT = 'updated_at_ekstrakurikuler';

  public function rapot()
  {
    return $this->belongsTo('App\Models\Rapot', 'rapot_id', 'id_rapot');
  }
}
