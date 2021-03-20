<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    protected $table = 'categories';
    public static function getStatus($status_id)
    {
        switch ($status_id) {
            case 0:
                return "<span class='text-danger'> Inactive </span>";
            case 1:
                return "<span class='text-success'> Active </span>";
        }
    }
}
