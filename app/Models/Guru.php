<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesUuid;

class Guru extends Model
{
  use UsesUuid;

  protected $table = 'guru';
  protected $primaryKey = 'id';
  protected $guarded = [];
}
