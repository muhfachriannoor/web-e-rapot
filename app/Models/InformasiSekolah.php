<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class InformasiSekolah extends Model
{
  use UsesUuid;

  protected $table = 'informasi_sekolah';
  protected $primaryKey = 'id';
  protected $guarded = [];
}
