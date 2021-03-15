<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    protected $table = 'brands';
}
