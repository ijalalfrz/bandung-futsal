@extends('layouts.main')

@section('content')
<div id="booking" class="overlay-wrap {{$errors->any()?' show':''}}">
  <div class="overlay"></div>
  <div class="form-panel ">
    @guest
    <div class="text-center">
      <h3>HARAP LOGIN TERLEBIH DAHULU</h3>
      <a href="{{ url('/') }}" class="button">HOME</a>
    </div>
    @else
      <h3>BOOKING LAPANG</h3>
      <br>
      <div class="form-wrap">
        <form method="POST" action="{{ url('booking') }}">
          @csrf
          @php
            $hour = \Carbon\Carbon::now('Asia/Jakarta')->hour;
          @endphp
          @if($errors->any())
            @foreach($errors->all() as $error)
              <p class="red-color err">{{ $error }}</p>
            @endforeach
          @else
            <label class="red-color err"></label>
          @endif
          <br>
          <label class="text-left">Tanggal Main</label>
          <input id="main-date" name="tanggal_main" type="date" data-date="" data-date-format="DD/MM/YYYY" class="date-picker" value="{{ date("Y-m-d") }}">
          <br>
          <label class="text-left">Jam Main</label>
          <div class="waktu">
            @php
              $i=0;
            @endphp
            @foreach ($jadwal as $detail)
              @if($detail->status)
                @if($hour < $detail->jam)
                  <div class="jam">
                    <input type="checkbox" id="jam_{{$i}}" name='jam[]' value="{{$detail->jam}}">
                    <label for="jam_{{$i}}">{{$detail->display}}</label>
                  </div>
                  @php
                    $i++;
                  @endphp
                @endif
              @endif

            @endforeach

            @if($i==0)
              <label class="red-color">Tempat sudah tutup</label>
            @endif

          </div>
          <hr>
          <input type="hidden" name="lapang_id" value="{{$id}}">
          <button {{$i==0?'disabled':''}} type="submit" class="proses-book button w-100">PROSES BOOKING</button>
        </form>
      </div>

    @endguest
  </div>
</div>

<div style="position: relative;min-height: 600px; overflow: hidden;margin-bottom: 50px;">
  <div style="margin-top: 150px;" class="container">
    <h2>Detail Lapang</h2>
    <hr>
    <div class="detail-wrapper">
      <div class="first"><div class="img-overlay"></div> <img src="{{ asset('uploads/'.$lapang->foto) }}"> </div>
      <div class="second">
        <h3>{{$lapang->nama}}</h3>
        <hr>
        <h6>Deskripsi</h6>
        <p>{{$lapang->deskripsi}}</p>
        <br>
        <h6>Jenis Lapang</h6>
        <p>{{ ucfirst($lapang->jenis)}}</p>
        <br>
        <h6>Harga Sewa</h6>
        <h4 class="red-color">Rp. {{ number_format($lapang->harga_sewa,2) }}</h4>
        <br>
        <button type="button" data-modal='#booking' class="showModal button w-100">BOOKING SEKARANG</button>
      </div>
    </div>
    <br>
    <h2>Jadwal Lapang</h2>
    <hr>
    <div class="row">
      <div class="col-md-3">
        <input id="filter-date" type="date" data-date="" data-date-format="DD/MM/YYYY" class="date-picker" value="{{ date("Y-m-d") }}">
      </div>

      <div class="col-md-8">
        <button class="button btn-lihat">Lihat</button>
      </div>
    </div>
    <br>
    <br>
    <div class="custom-scroll" style="width: 100%;overflow-x: scroll; padding: 10px 0px;">
      <table class="table-wrap">
        <thead>
          <tr>
            <th class="red-color">JAM</th>
            @for ($i=7; $i <21 ; $i++)
            <th class="red-color">{{$i}} - {{$i+1}}</th>
            @endfor
          </tr>
          <tr class="tersedia">
            <th>KETERSEDIAAN</th>

            @foreach ($jadwal as $detail)
              @if($detail->status == false)
              <th class="red-color">BOOKED</th>
              @else
              <th>KOSONG</th>
              @endif

            @endforeach
          </tr>
        </thead>
      </table>
    </div>

  </div>
</div>


@endsection


@section('script')
<script type="text/javascript">
  $(function(){
    $('#main-date').change(function(){
      var id = {{$id}};
      var date = $(this).val();
      var dif1 = new Date(date);
      var dif2 = new Date();
      dif1.setHours(0,0,0,0);
      dif2.setHours(0,0,0,0);
      if(dif1<dif2){
        $('.err').html('Tanggal tidak boleh kurang dari hari ini!');

        $(this).val(`${dif2.getFullYear()}-${('0'+(dif2.getMonth() + 1)).slice(-2)}-${('0'+dif2.getDate()).slice(-2)}`);
        $(this).attr('data-date', `${('0'+dif2.getDate()).slice(-2)}/${('0'+(dif2.getMonth() + 1)).slice(-2)}/${dif2.getFullYear()}`);
      }else if(dif2.addDays(14)<dif1){
        $('.err').html('Tanggal tidak boleh lebih dari 2 minggu!');
        $(this).val(`${dif2.getFullYear()}-${('0'+(dif2.getMonth() + 1)).slice(-2)}-${('0'+dif2.getDate()).slice(-2)}`);
        $(this).attr('data-date', `${('0'+dif2.getDate()).slice(-2)}/${('0'+(dif2.getMonth() + 1)).slice(-2)}/${dif2.getFullYear()}`);

      }else{
        $('.err').empty();
        $.get(`/lapang/${id}/${date}`,function(){
        }).done(function(data){
          $('.waktu').empty();
          if(data){
            var hour = new Date();
            hour = hour.getHours();
            var c = 0;
            $(data).each(function(i,el){
              if(el.status){
                if(dif1.getDate() == dif2.getDate() && el.jam>hour){

                  $('.waktu').append(`
                     <div class="jam">
                      <input name='jam[]' type="checkbox" id="jam_${i}" value="${el.jam}">
                      <label for="jam_${i}">${el.display}</label>
                    </div>
                    `);
                  c++;
                }else if(dif1.getDate()!=dif2.getDate()){
                  $('.waktu').append(`
                     <div class="jam">
                      <input name='jam[]' type="checkbox" id="jam_${i}" value="${el.jam}">
                      <label for="jam_${i}">${el.display}</label>
                    </div>
                    `);
                  c++;
                }
              }

            });

            if(c==0){
              $('.proses-book').attr('disabled',true);
              $('.waktu').append("<label class='red-color'>Tempat sudah tutup </label> ")
            }else{
              $('.proses-book').attr('disabled',false);

            }
          }
        });

      }
    });
    $('.btn-lihat').click(function(){
      $(this).html('loading...');
      var id = {{$id}};
      var date = $('#filter-date').val();
      $.get(`/lapang/${id}/${date}`,function(){
        $('.btn-lihat').html('lihat');

      }).done(function(data){
        $('.tersedia').empty();
        $('.tersedia').append('<th>KETERSEDIAAN</th>');
        if(data){

          $(data).each(function(i,el){
            if(el.status){
              $('.tersedia').append('<th>KOSONG</th>');

            }else{
              $('.tersedia').append('<th class="red-color">BOOKED</th>');

            }

          });
        }
      });
    });
  });

</script>
@endsection
