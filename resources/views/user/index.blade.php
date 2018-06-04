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
        <div class="panel-heading">Data User
        </div>
        <div class="panel-body">
          <table id="table1" class="table table-striped table-hover table-fw-widget table-responsive">
            <thead>
              <tr>
                <th>No</th>
                <th>Email</th>
                <th>Nama</th>
                <th>No Telpon</th>
                <th>Alamat</th>
                <th>Status</th>
                <th></th>
              </tr>

            </thead>
            <tbody>
              @php
                $i = 0;
              @endphp
              @foreach($user as $detail)
              @php
                $i++;
              @endphp
              <tr>
                <td>{{$i}}</td>
                <td>{{$detail['email']}}</td>
                <td>{{$detail['name']}}</td>
                <td>{{$detail['no_telpon']}}</td>
                <td>{{$detail['alamat']}}</td>
                <td><span class="btn btn-xs btn-{{ $detail['status']=='banned'?'danger':'success' }}"> {{$detail['status']}}</span></td>
                <td>
                  <div class="pull-right">
                    @php
                      $text = "Ban";
                      $url = url('admin/user/'.$detail['id'].'/ban');
                      if($detail['status']=='banned'){
                        $url = url('admin/user/'.$detail['id'].'/unbanned');
                        $text = "Activate";
                      }
                    @endphp
                    <form method="POST" action="{{ $url }}">
                      @csrf
                      <input name="_method" type="hidden" value="PUT">

                      <button type="submit" class="btn btn-{{ $detail['status']=='banned'?'success':'danger' }}">{{$text}}</button>

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
