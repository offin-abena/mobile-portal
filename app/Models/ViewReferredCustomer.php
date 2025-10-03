<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewReferredCustomer extends Model
{
        protected $table = 'view_referred_customers';
        protected $primaryKey = 'uuid';
        public $incrementing = false;
        protected $keyType = 'string';
}
