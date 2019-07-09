<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model {
    protected $fillable = [
        'user_id',
        'summ',
    ];

    public function Client() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function Items() {
        return $this->hasMany('App\buy');
    }
}
