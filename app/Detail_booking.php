<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_booking extends Model
{
    //

    protected $table = 'detail_bookings';

    public function lapang(){
      return $this->belongsTo('App\Lapang');
    }

    public function booking(){
      return $this->belongsTo('App\Booking');
    }
}
