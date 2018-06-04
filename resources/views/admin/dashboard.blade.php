@extends('layouts.new-admin')
@section('content')
<div class="page-head">
  <h2 class="page-head-title">Dashboard</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Admin</a></li>
    <li class="active">Dashboard</li>
  </ol>
</div>
<div class="main-content container-fluid">
   <div class="row">
    <div class="col-xs-12 col-md-6 col-lg-3">
      <div class="widget widget-tile">
        <div id="spark1" class="chart sparkline"></div>
        <div class="data-info">
          <div class="desc">Pengguna</div>
          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="113" class="number">{{$user}}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
      <div class="widget widget-tile">
        <div id="spark2" class="chart sparkline"></div>
        <div class="data-info">
          <div class="desc">Booking Bulan Ini</div>
          <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="80" data-suffix="%" class="number">{{$bulanini}}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
      <div class="widget widget-tile">
        <div id="spark3" class="chart sparkline"></div>
        <div class="data-info">
          <div class="desc">Booking Total</div>
          <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="532" class="number">{{$total}}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
      <div class="widget widget-tile">
        <div id="spark4" class="chart sparkline"></div>
        <div class="data-info">
          <div class="desc">Booking Gagal</div>
          <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-down"></span><span data-toggle="counter" data-end="113" class="number">{{$gagal}}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
