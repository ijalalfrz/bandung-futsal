@extends('layouts.new-admin')
@section('content')
<div class="page-head">
  <h2 class="page-head-title">Lapang</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Lapang</a></li>
    <li class="active">Index</li>
  </ol>
</div>
<div class="main-content container-fluid">
  <div class="row">
    <div class="col-sm-12">
      @if(Session::has('msg'))
        <div role="alert" class="alert alert-contrast alert-success alert-dismissible">
          <div class="icon"><span class="mdi mdi-check"></span></div>
          <div class="message">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
            {{ Session::get('msg') }}
          </div>
        </div>
      @endif
      <div class="panel panel-default panel-table">
        <div class="panel-heading">Data Lapang
          <a href="{{url('admin/lapang/create')}}" class="btn btn-lg btn-success pull-right">Tambah Lapang</a>
        </div>
        <div class="panel-body">
          <table id="table1" class="table table-striped table-hover table-fw-widget table-responsive">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Harga Sewa</th>
                <th></th>
              </tr>

            </thead>
            <tbody>
              @php
                $i = 0;
              @endphp
              @foreach($lapang as $detail)
              @php
                $i++;
              @endphp
              <tr>
                <td>{{$i}}</td>
                <td>{{$detail['nama']}}</td>
                <td>{{$detail['jenis']}}</td>
                <td>Rp {{ number_format($detail['harga_sewa'], 2) }}</td>
                <td>
                  <div class="pull-right">
                    <form method="POST" action="{{url('admin/lapang/'.$detail['id'])}}">
                      @csrf
                      <input name="_method" type="hidden" value="DELETE">

                      <a href="{{url('admin/lapang/'.$detail['id'].'/edit')}}" class="btn btn-default pull-left"><span class="mdi mdi-edit"></span></a>
                      <button type="submit" class="btn btn-default"><span class="mdi mdi-delete"></span></button>

                    </form>

                  </div>

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection

@section('script')
  <script src="{{ asset('lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('lib/datatables/plugins/buttons/js/dataTables.buttons.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/app-tables-datatables.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
    $(function(){
      App.dataTables();
      $('#table1').DataTable();

    })
  </script>
@endsection
