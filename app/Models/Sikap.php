<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class Sikap extends Model
{
  use UsesUuid;

  protected $table = 'sikap';
  protected $primaryKey = 'id_sikap';
  protected $guarded = [];

  const CREATED_AT = 'created_at_sikap';
  const UPDATED_AT = 'updated_at_sikap';

  public function rapot()
  {
    return $this->belongsTo('App\Models\Rapot', 'rapot_id', 'id_rapot');
  }
}
