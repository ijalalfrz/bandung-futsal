<?php

namespace App\Http\Controllers;
use App\Booking;
use App\Lapang;
use App\Detail_Booking;
use Datetime;
use Pusher;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
         $statusArr = [
              'new',
              'canceled',
              'booking_paid',
              'verified'
            ];
        $user_id = Auth::id();
        $req = isset($request)?$request:null;

        if($req){
            $lapang_id = $req->query('lapang');
            $status = $req->query('status');
            if(!in_array($status, $statusArr)) {
                $status = null;
            }else{
                $where[] = ['status','=',$status];
            }
        }
        $where[] = ['user_id', '=', $user_id];
        $data = Booking::where($where)
                ->whereHas('detail', function($q) use ($request, $lapang_id){

                    if(isset($request) && $request->query('lapang') && is_numeric($request->query('lapang'))){
                        $q->where('lapang_id', $lapang_id);
                    }

                })->orderBy('created_at', 'desc')->get();

        $lapang = Lapang::all();
        return view('app.booking-user', ['booking' => $data, 'lapang' => $lapang, 'lapang_id' => $lapang_id , 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $errors = new MessageBag();
        if($request->jam==null || count($request->jam)==0){
            $errors->add('jam','Jam booking kosong!');
            return back()->withErrors($errors);
        }

        $lapang = Lapang::findOrFail($request->lapang_id);
        $isError = false;
        try {
            $booking = new Booking();
            $booking->user_id = Auth::user()->id;
            $total_harga =0;
            foreach ($request->jam as $jam) {
                $total_harga += $lapang->harga_sewa;
            }
            $booking->total_harga = $total_harga;
            if($booking->save()){
                foreach ($request->jam as $jam) {
                    $detail = new Detail_Booking();
                    $detail->booking_id = $booking->id;
                    $detail->lapang_id = $request->lapang_id;
                    $detail->waktu_awal = $jam;
                    $detail->waktu_akhir = $jam+1;
                    $detail->tanggal_main = $request->tanggal_main;
                    if(!$detail->save()){
                        $errors->add('msg','Gagal booking lapang, terjadi kesalah sitem.');
                        $isError = true;
                    }
                }
            }else{
                $isError = true;
                $errors->add('msg','Gagal booking lapang, terjadi kesalah sitem.');

            }
            if($isError){
                return back();
            }else{

                $options = array(
                  'cluster' => \Config::get('pusher.pusher_cluster'),
                  'encrypted' => true
                );
                $pusher = new Pusher\Pusher(
                  \Config::get('pusher.pusher_key'),
                  \Config::get('pusher.pusher_secret'),
                  \Config::get('pusher.pusher_app_id'),
                  $options
                );


                $data['message'] = 'Order baru dari '.Auth::user()->email.' harap cek';
                $pusher->trigger('new-order', 'new-order-notif', $data);

                return redirect('/booking/success/'.$booking->id);
            }

        } catch (\Exception $e) {
            // print_r($e);
            return back()->withErrors($errors);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function success($id)
    {
        //

        $data = Booking::findOrFail($id);
        if($data->user_id != Auth::id()){
            return back();
        }
        return view('app.success-book', ['booking'=>$data]);
    }

    public function confirm(Request $request,$id){

        $foto = "";
        if($request->hasfile('bukti_trf'))
        {
            $file = $request->file('bukti_trf');
            $foto = time().'.'.$file->extension();
            $file->move(public_path().'/uploads/', $foto);
            $foto = "/uploads/".$foto;
        }


        $data = Booking::findOrFail($id);
        $data->status = 'booking_paid';
        $data->nama_pengirim = $request->nama_pengirim;
        $data->bukti_trf = $foto;

        if($data->save()){
            $options = array(
                  'cluster' => \Config::get('pusher.pusher_cluster'),
                  'encrypted' => true
                );
                $pusher = new Pusher\Pusher(
                  \Config::get('pusher.pusher_key'),
                  \Config::get('pusher.pusher_secret'),
                  \Config::get('pusher.pusher_app_id'),
                  $options
                );


            $pdata['message'] = 'Booking '.Auth::user()->email.' sudah dibayar, harap verifikasi';
            $pdata['id'] = $id;
            $pusher->trigger('new-order', 'new-order-confirmed', $pdata);

            $request->session()->flash('msg', "Sukses konfirmasi, tunggu sampai admin memverifikasi pembayaran");
        }else{
            $request->session()->flash('msg', "Gagal konfirmasi, Terjadi kesalahan sistem");

        }
        return back();

    }

    public function cancel($id)
    {
        //

        $data = Booking::findOrFail($id);
        $dateTime = new DateTime($data->created_at);
        $minutesToAdd = 30;
        $now = new Datetime(date("Y-m-d H:i:s"));
        $dueTime = $dateTime->modify("+{$minutesToAdd} minutes");
        if($dueTime > $now){
            \Session::flash("msg", "Berhasil cancel oleh user");
            $data->cancel_message = "Cancel oleh user";
        }else{
            $data->cancel_message = "Cancel oleh sistem";
        }
        $data->status='canceled';

        if(!$data->save()){
            \Session::flash("err", "Gagal cancel");
        }

        return redirect('/booking');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
