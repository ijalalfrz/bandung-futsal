@extends('layouts.main');


@section('content')

<div id="booking-confirm" class="overlay-wrap {{$errors->any()?' show':''}}">
  <div class="overlay"></div>
  <div class="form-panel ">
    <h2>BATAS WAKTU KONFIRMASI</h2>
    <h2 class="red-color timer"></h2>
    <h2>NAMA PENGIRIM</h2>
    <form class="form-wrap" method="POST"  enctype="multipart/form-data">
      @csrf
      <input type="text" name="nama_pengirim" placeholder="Nama Pengirim" required>
      <h5>BUKTI TRANSFER</h5>
      <div>
        <img src="{{asset('img/add_image.svg')}}" width="250" class="img-prev img-thumbnail">
        <input type="file" name="bukti_trf" class="file-hidden" accept="image/*" required>
      </div>
      <hr>
      <button type="submit" class="button w-100">KONFIRMASI PEMBAYARAN</button>
    </form>

  </div>
</div>

<div style="position: relative;min-height: 600px; overflow: hidden;margin-bottom: 50px;">
  <div style="margin-top: 150px;" class="container">
    @if(\Session::has('msg'))
      <p class="status w-100 success">
        {{\Session::get('msg')}}
      </p>
    @endif

    @if(\Session::has('err'))
      <p class="status w-100 canceled">
        {{\Session::get('err')}}
      </p>
    @endif

    <div class="row">
      <div class="col-md-2">
        <h4>FILTER</h4>
        <form class="form-wrap" method="GET" action="/booking">
          <select name="lapang">
            <option>Pilih Lapang</option>
            @foreach($lapang as $l)
            <option {{(isset($lapang_id) && $lapang_id == $l->id)?'selected':''}} value="{{$l->id}}">{{$l->nama}}</option>
            @endforeach
          </select>
          @php
            $status = [
              'new' => 'Belum dibayar',
              'canceled' => 'Ditolak',
              'booking_paid' => 'Menunggu Verifikasi',
              'verified' => 'Diverifikasi'
            ];
          @endphp
          {{Form::select('status', $status, isset($status)?$status:null, ['placeholder' => 'Pilih Status'])}}
          <hr>
          <button type="submit" class="button w-100">Filter</button>
        </form>
      </div>
      <div class="col-md-10">
        <h4>RIWAYAT BOOKING</h4>

        @if($booking->isEmpty())
        <h5>DATA TIDAK ADA</h5>

        @else
        <ul class="riwayat">
          @foreach($booking as $data)
            @php
              $lapang = $data->detail->first()->lapang;
              $first = $data->detail->first();
            @endphp
            <li>
              <div class="row" >
                <div class="col-md-4">
                  <img src="{{ asset('uploads/'.$lapang->foto) }}" class="img-thumbnail">
                </div>
                <div class="col-md-3">
                  <h3>{{$lapang->nama}}</h3>
                  <h5>WAKTU BOOKING:</h5>
                  {{$data->created_at}}
                  <h5>TANGGAL MAIN:</h5>
                  {{$first->tanggal_main}}
                  <h5>JAM MAIN :</h5>
                  <p>

                    @foreach($data->detail as $detail)
                      <b> ({{$detail->waktu_awal}} - {{$detail->waktu_akhir}})</b>
                    @endforeach
                  </p>
                  <p class="red-color">Total Biaya : Rp. {{number_format($data->total_harga,2)}}</p>
                  @if($data->status== 'canceled')
                    <p class="red-color"><b>Pesan: {{$data->cancel_message}}</b></p>
                  @elseif($data->status== 'booking_paid')
                    <p class="red-color"><b>Pesan: sudah dibayar</b></p>

                  @endif




                </div>
                <div class="col-md-3">
                  <h3>STATUS</h3>
                  <span class="statusUpdate status {{$data->status}}">
                    @if($data->status == 'new')
                      Belum dibayar
                    @endif
                    @if($data->status == 'verified')
                      Sudah diverifikasi
                    @endif
                    @if($data->status == 'booking_paid')
                      menunggu verifikasi
                    @endif
                    @if($data->status == 'canceled')
                      Ditolak
                    @endif
                  </span>
                </div>
                <div class="col-md-2">


                  <h3 class="text-center">AKSI</h3>
                  @if($data->status == 'new')
                    <a href="javascript:void(0);" data-json="{{json_encode($data)}}" data-modal='#booking-confirm' class="btnBayar showModal button blue button-max-120">BAYAR</a>

                    <a href="{{ url('/booking/cancel/'.$data->id) }}" class="button m-10 button-max-120">BATAL</a>
                  @endif


                </div>
              </div>
            </li>
          @endforeach
        </ul>
        @endif
      </div>
    </div>
  </div>

</div>
@endsection

@section('script')
  <script type="text/javascript">
    $(function(){
      $('.btnBayar').click(function(){
        var json = $(this).data('json');
        var dateNow = new Date();
        var dateBook = new Date(json.created_at);
        var dueTime = new Date(dateBook.getTime() + 30*60000);
        // console.log(dueTime);
        cd(dueTime);
        if(dateNow > dueTime){
          $('#booking-confirm form').find('input').attr('disabled','disabled');
          $('#booking-confirm form').find('button').attr('disabled','disabled');
          $('.timer').html("EXPIRED");
        }else{
          $('#booking-confirm form').attr('action',`/booking/confirm/${json.id}`);

        }
      });
    });

    function cd(time){
      var countDownDate = time.getTime();

      x = setInterval(function() {

          // Get todays date and time
          var now = new Date().getTime();

          // Find the distance between now an the count down date
          var distance = countDownDate - now;

          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          // Output the result in an element with id="demo"

          $('.timer').html(minutes + " Menit " + seconds + " Detik ");

          // If the count down is over, write some text
          if (distance < 0) {
              clearInterval(x);
               $('.timer').html('EXPIRED');
          }
      }, 1000);
    }

  </script>
@endsection
