<?php

namespace App\Http\Controllers\Api;
use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datetime;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Booking::with('user')->with(['detail'=>function($q){

            $q->with('lapang');
        }])->orderBy('created_at','desc')->get();

        $arr = [
            'data' => $data
        ];
        return $arr;
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

    public function getByUser($id){

        $data = Booking::with('user')->with(['detail'=>function($q){

            $q->with('lapang');
        }])->where('user_id', $id)->orderBy('created_at','desc')->get();

        // $arr = [
        //     'data' => $data
        // ];

        if($data->count()!=0 && $id == $data->first()->user_id){
            return $data;
        }else{
            return null;
        }
    }

    public function checkVerify(){
        $data = Booking::where('status','new')->get();
        foreach ($data as $itm) {
            $dateTime = new DateTime($itm->created_at);
            $minutesToAdd = 30;
            $now = new Datetime(date("Y-m-d H:i:s"));
            $dueTime = $dateTime->modify("+{$minutesToAdd} minutes");
            if($now>$dueTime){
                $itm->status = 'canceled';
                $itm->cancel_message = 'Cancel oleh sistem';
                $itm->save();
            }
        }
        return "ok";
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
