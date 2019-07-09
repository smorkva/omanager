<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model {
    protected $fillable = [
        'name',
        'price',
        'group_id'
    ];
}
