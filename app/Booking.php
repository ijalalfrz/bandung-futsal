<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //

  public function detail()
  {
      return $this->hasMany('App\Detail_booking');
  }


  public function user()
  {
      return $this->belongsTo('App\User');
  }

}
