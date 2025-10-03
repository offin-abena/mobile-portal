<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewFullTransaction extends Model
{
      protected $table = 'view_fulltransaction_view';

      public $incrementing = false;
      protected $keyType = 'string';

      public $timestamps = false;
}
