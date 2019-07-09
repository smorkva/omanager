<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class buy extends Model { 
    protected $fillable = [
        'order_id',
        'item_id',
        'count',
        'price',
        'summ'
    ];

    public function Item() {
        return $this->belongsTo('App\item');
    }
}
