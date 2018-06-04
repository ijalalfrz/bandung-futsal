<?php

namespace App\Http\Controllers;
use App\User;
use App\Booking;
use Illuminate\Http\Request;
use Datetime;
class AdminController extends Controller
{
    //

  public function index()
  {
      $first = new Datetime(date("Y-m-01"));
      $last = date("Y-m-t");

      $countUser = User::count();
      $countBulainIni = Booking::where('status','!=','canceled')->whereBetween('created_at',[$first,$last])->count();
      $countTotal = Booking::count();
      $countGagal = Booking::where('status','=','canceled')->count();
      $arr = [
        'user'=>$countUser,
        'bulanini'=>$countBulainIni,
        'total'=>$countTotal,
        'gagal'=>$countGagal
      ];
      return view('admin.dashboard', $arr);
  }

}
