<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class TahunAjaran extends Model
{
  use UsesUuid;

  protected $table = 'tahun_ajaran';
  protected $primaryKey = 'id';
  protected $guarded = [];
}
