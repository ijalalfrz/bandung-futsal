@extends('layouts.main')


@section('content')
<div style="position: relative;min-height: 600px; overflow: hidden;margin-bottom: 50px;">
  <div style="margin-top: 150px;" class="container text-center">
      <h2>Booking Berhasil</h2>
      <h5>Silahkan transfer untuk memudahkan verifikasi ke rekening :</h5>
      <h3>04488271892 BNI a.n Bandoeng Futsal</h3>
      <h3>TOTAL BIAYA :</h3>
      <h1 class="red-color">
        Rp. {{ number_format($booking->total_harga,2) }}
      </h1>
      <h2>Dalam waktu : </h2>
      <h1 class="timer"></h1>
      <br>
      <br>
      <h5>Sudah transfer? Segera konfirmasi</h5>
      @php
        $lapang = $booking->detail->first()->lapang;
      @endphp
      <a href="{{ url('/booking/?lapang='.$lapang->id.'&status=new') }}" class="button">Konfirmasi</a>
      <a href="/" class="button">Nanti</a>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

  @php
    $duetime = new DateTime($booking->created_at);
    $duetime->modify('+30 minutes');
    $duetimestr = date_format($duetime, 'Y-m-d H:i:s');
  @endphp
  $(function(){

    var countDownDate = new Date("{{$duetimestr}}").getTime();

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
  });

</script>

@endsection
