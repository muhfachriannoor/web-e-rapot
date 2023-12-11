<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class TingkatKelas extends Model
{
  use UsesUuid;

  protected $table = 'tingkat_kelas';
  protected $primaryKey = 'id';
  protected $guarded = [];
}
