@extends('layouts.main')

@section('content')
<div style="position: relative;min-height: 600px; overflow: hidden;">
  <div style="margin-top: 150px;" class="container">
    <h2>Pilih lapang </h2>
    @php
      $len = count($lapang);
      $i=0;
    @endphp
    @foreach ($lapang as $itm)
    <div class="row">
      <div class="col-md-4">
        <img src="{{asset('uploads/'.$itm->foto)}}" class="img-responsive img-thumbnail">
      </div>
      <div class="col-md-6">
        <h3>{{ $itm->nama }}</h3>
        <h5>{{ ucfirst($itm->jenis) }}</h5>
        <h4 class="red-color">Harga sewa : Rp. {{ number_format($itm->harga_sewa,2) }}</h4>
        <br>
        <a href="{{ url('/lapang/'.$itm->id) }}" class="button">Detail</a>
      </div>
      <div class="col-md-2"></div>
    </div>
    @if($i!=$len-1)
    <hr>
    @else
    <br>
    <br>
    @endif

    @php
      $i++;
    @endphp
    @endforeach
  </div>
</div>
@endsection
