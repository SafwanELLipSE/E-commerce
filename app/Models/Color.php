<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    protected $table = 'colors';
}
