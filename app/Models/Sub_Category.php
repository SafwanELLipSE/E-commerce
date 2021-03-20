<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_Category extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    protected $table = 'sub_categories';
}
