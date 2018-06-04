<?php

namespace App\Http\Controllers\Admin;
use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Pusher;
class ManageBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Booking::orderBy('created_at','desc')->get();

        return view('booking.index', ['booking'=>$data]);
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

    public function verify($id)
    {
        $data = Booking::findOrFail($id);
        $data->status='verified';
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


            $pdata['message'] = 'Booking anda pada tanggal '.date('d-m-Y', strtotime($data->created_at)).' sudah diverifikasi';
            $pdata['id'] = $id;
            $pdata['user_id'] = $data->user_id;
            $pdata['status'] = 'verified';

            $pusher->trigger('new-order', 'order-status-change', $pdata);
            \Session::flash('msg', 'Sukses memverifikasi booking');
        }else{
            \Session::flash('msg', 'Gagal memverifikasi booking');
        }

        return back();

    }

    public function cancel(Request $req, $id)
    {
        //
        $data = Booking::findOrFail($id);
        $data->status='canceled';
        $data->cancel_message = $req->cancel_message;
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


            $pdata['message'] = 'Booking anda pada tanggal '.date('d-m-Y', strtotime($data->created_at)).' dibatalkan admin karena '.$data->cancel_message;
            $pdata['id'] = $id;
            $pdata['user_id'] = $data->user_id;
            $pdata['status'] = 'canceled';

            $pusher->trigger('new-order', 'order-status-change', $pdata);

            \Session::flash('msg', 'Sukses membatalkan booking');
        }else{
            \Session::flash('msg', 'Gagal membatalkan booking');
        }

        return back();
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

    public function laporan(){

        return view('laporan.index');
    }

    public function showLaporan(Request $request){
        if($request->query('from')!=null && $request->query('to')!=null && $request->query('status')!=null){
            $from = $request->query('from');
            $to = $request->query('to');
            $dateFrom = date($from);
            $dateTo = date($to);
            $status = $request->query('status');
            if($dateFrom>$dateTo){
                $request->session()->flash('err', "Tanggal awal tidak boleh lebih besar dari tanggal akhir");
                return back();
            }else{
                $data = Booking::whereBetween('created_at', [$from,$to])->where('status' , $status)->get();

                return view('laporan.show',['booking'=>$data, 'from'=>$from, 'to'=>$to , 'status'=>$status]);
            }


        }else{
            $request->session()->flash('err', "Harap lengkapi form");
            return back();
        }
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
