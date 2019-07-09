<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group extends Model {
    protected $fillable = [
        'name',
        'order',
    ];

    public function Items(){
        return $this->hasMany('App\item');
    }
}
