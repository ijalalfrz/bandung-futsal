@extends('layouts.new-admin')
@section('content')
<div class="page-head">
  <h2 class="page-head-title">Laporan</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Admin</a></li>
    <li class="active">Laporan</li>
  </ol>
</div>
<div class="main-content container-fluid">
   @if(Session::has('msg'))
     <div role="alert" class="alert alert-contrast alert-success alert-dismissible">
       <div class="icon"><span class="mdi mdi-check"></span></div>
       <div class="message">
         <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
         {{ Session::get('msg') }}
       </div>
     </div>
   @endif
   @if(Session::has('err'))
     <div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
       <div class="icon"><span class="mdi mdi-close"></span></div>
       <div class="message">
         <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
         {{ Session::get('err') }}
       </div>
     </div>
   @endif
   <div class="panel panel-default panel-border-color panel-border-color-primary">
      <div class="panel-heading panel-heading-divider">Laporan Booking<span class="panel-subtitle">Laporan booking bandoeng futsal</span></div>
      <div class="panel-body">
        <form method="GET" action="{{ url('/admin/show/laporan') }}">
          @csrf
          <div class="row">
            <div class="col-md-3">
              <div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
                <input required size="16" type="text" name="from" value="" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
              </div>
            </div>
            <div class="col-md-3">
              <div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
                <input required size="16" type="text" name="to" value="" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
              </div>
            </div>
            <div class="col-md-3">
              <div style="margin:1px 0px;padding: 4px 0px;">
                <select required class="form-control" name="status">
                  <option>Status</option>
                  <option value="new">New</option>
                  <option value="canceled">Canceled</option>
                  <option value="verified">Verified</option>
                  <option value="booking_paid">Paid</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div style="margin:1px 0px;padding: 4px 0px;">
                <button type="submit" class="btn btn-primary btn-lg" style="line-height: 45px">LIHAT</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('script')

@endsection
