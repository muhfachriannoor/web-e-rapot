<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class Siswa extends Model
{
  use UsesUuid;

  protected $table = 'siswa';
  protected $primaryKey = 'id';
  protected $guarded = [];
}
