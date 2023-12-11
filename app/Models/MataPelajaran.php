<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class MataPelajaran extends Model
{
  use UsesUuid;

  protected $table = 'mata_pelajaran';
  protected $primaryKey = 'id';
  protected $guarded = [];
}
