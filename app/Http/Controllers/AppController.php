<?php

namespace App\Http\Controllers;
use App\Detail_booking;
use App\Booking;
use App\Lapang;
use Illuminate\Http\Request;

class AppController extends Controller
{
    //

    public function index()
    {
      # code...
      return view('app.index');
    }

    public function lapang()
    {
      $data = Lapang::all();
      return view('app.lapang', ['lapang'=>$data]);
    }

    public function showLapang($id){
      $data = Lapang::findOrFail($id);
      $jadwal = $this->getJadwal($id,date('Y-m-d'));

      return view('app.lapang-detail', ['id'=>$id, 'lapang'=>$data, 'jadwal'=>$jadwal]);
    }

    public function getJadwal($id, $tanggal){
      $dataArr = [];
      for ($i=7; $i <21 ; $i++) {
        $data = Detail_booking::where([['tanggal_main',$tanggal],['waktu_awal', $i],['lapang_id', $id]])->get();
        if($data->count()==0){
          $dataArr[] = (object) array('jam' => $i ,'status'=>true ,'display' => "$i - ".($i+1));
        }else{
          $book = Booking::find($data->first()->booking_id);
          if($book->status == 'canceled'){
            $dataArr[] = (object) array('jam' => $i ,'status'=>true ,'display' => "$i - ".($i+1));
          }else{
            $dataArr[] = (object) array('jam' => $i ,'status'=>false ,'display' => "$i - ".($i+1));
          }
        }
      }
      return $dataArr;
    }
}
