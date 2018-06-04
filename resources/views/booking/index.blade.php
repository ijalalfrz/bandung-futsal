@extends('layouts.new-admin')
@section('content')

<div id="detail" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
  <div class="modal-dialog custom-width">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
        <h3 class="modal-title">Detail Booking</h3>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td class="t-nama"></td>
          </tr>
          <tr>
            <td>No Telpon</td>
            <td>:</td>
            <td class="t-telpon"></td>
          </tr>
          <tr>
            <td>Waktu Booking</td>
            <td>:</td>
            <td class="t-created_at"></td>
          </tr>
          <tr>
            <td>Lapang</td>
            <td>:</td>
            <td class="t-lapang"></td>
          </tr>
          <tr>
            <td>Waktu Main</td>
            <td>:</td>
            <td class="t-waktu"></td>
          </tr>
          <tr>
            <td>Status</td>
            <td>:</td>
            <td class="t-status"></td>
          </tr>
          <tr>
            <td>Nama Pengirim</td>
            <td>:</td>
            <td class="t-nama_pengirim"></td>
          </tr>
          <tr>
            <td>Foto bukti transfer</td>
            <td>:</td>
            <td class="t-bukti">

            </td>
          </tr>
          <tr>
            <td>Alasan Cancel</td>
            <td>:</td>
            <td class="t-cancel_message"></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default md-close">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="verif" tabindex="-1" role="dialog" style="" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div class="text-success"><span class="modal-main-icon mdi mdi-check"></span></div>
          <h3>Apakah anda yakin memverifikasi booking ini?</h3>
          <p>Lapang akan resmi disewa oleh pengguna</p>
          <div class="xs-mt-50">
            <form method="POST">
              @csrf
              <input type="hidden" name="_method" value="PUT">
              <button type="submit" class="btn btn-space btn-success">Proses</button>
              <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>

            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<div id="cancel" tabindex="-1" role="dialog" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
              <h3>Perhatian!</h3>
              <p>Apakah anda yakin akan membatalkan booking ini? berikan alasan agar pengguna tidak bingung</p>
              <div class="xs-mt-50">
                <form method="POST">
                  @csrf
                  <input type="hidden" name="_method" value="PUT">

                  <div class="form-group">
                    <input class="form-control" type="text" name="cancel_message" placeholder="Pesan cancel, cth: bukti transfer palsu" required>
                  </div>
                  <button type="submit" class="btn btn-space btn-danger">Proses</button>
                  <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>

                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>

<div class="page-head">
  <h2 class="page-head-title">Booking</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Booking</a></li>
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
        <div class="panel-heading">Data Booking
        </div>
        <div class="panel-body">
          <table id="datatab" class="table table-striped table-hover table-fw-widget table-responsive">
            <thead>
              <tr>
                <th>No</th>
                <th>Email</th>
                <th>Lapang</th>
                <th>Total Harga</th>
                <th>Waktu Booking</th>
                <th>Status</th>
                <th></th>
              </tr>

            </thead>
            <tbody>
            {{--   @php
                $i = 0;
              @endphp
              @foreach($booking as $data)
              @php
                $lapang = $data->detail->first()->lapang;
                $i++;
              @endphp
              <tr>
                <td>{{$i}}</td>
                <td>{{$data->user->email}}</td>
                <td>{{$lapang->nama}}</td>
                <td>Rp. {{ number_format($data->total_harga,2) }}</td>
                <td>{{$data->created_at}}</td>
                <td>
                  @if($data->status == 'new' )
                    <span class="btn btn-xs btn-info">{{$data->status}}</span>
                  @elseif($data->status == 'canceled')
                    <span class="btn btn-xs btn-danger">{{$data->status}}</span>
                  @elseif($data->status == 'verified')
                    <span class="btn btn-xs btn-success">{{$data->status}}</span>
                  @elseif($data->status == 'booking_paid')
                    <span class="btn btn-xs btn-warning">{{$data->status}}</span>
                  @endif

                </td>
                <td>
                    <button class="showDetail btn btn-info" data-json="{{json_encode($data)}}"  data-toggle="modal" data-target="#detail"  title="Detail"><span class="mdi mdi-search"></span></button>
                  @if($data->status=='booking_paid')
                    <button class="showVerif btn btn-success" data-id="{{$data->id}}" data-toggle="modal" data-target="#verif" title="Verifikasi"><span class="mdi mdi-check"></span></button>
                    <button class="showCancel btn btn-danger" data-id="{{$data->id}}" data-toggle="modal" data-target="#cancel" title="Cancel Booking"><span class="mdi mdi-minus-circle-outline"></span></button>
                  @endif
                </td>

              </tr>
              @endforeach --}}
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
      var i=0;
      t = $('#datatab').DataTable({
        ajax:{
          type: 'GET',
          url: '{{ url('/admin/api/booking') }}'
        },
        columns:[
          { data : "id" , render: function(data,row){
            i++;
            return i;
          }},
          { data : "user.email"},
          { data : "detail.0.lapang.nama"},
          { data : "total_harga", render(data){
            var inp = (data/1000).toFixed(3);
            return `Rp. ${inp}`;
          }},
          { data : "created_at"},
          { data : "status", render(data){
            if(data == 'new' )
              return `<span class="btn btn-xs btn-info">${data}</span>`;
            else if(data == 'canceled')
              return `<span class="btn btn-xs btn-danger">${data}</span>`;
            else if(data == 'verified')
              return `<span class="btn btn-xs btn-success">${data}</span>`;
            else if(data == 'booking_paid')
              return `<span class="btn btn-xs btn-warning">${data}</span>`;

          }},
          { data : "id",render(data,t,row){
            var btn = `<button class="sid_${data} showDetail btn btn-info" data-json='${JSON.stringify(row)}'  data-toggle="modal" data-target="#detail"  title="Detail"><span class="mdi mdi-search"></span></button>`;
            if(row.status=='booking_paid')
            btn += `
              <button class="showVerif btn btn-success" data-id="${data}" data-toggle="modal" data-target="#verif" title="Verifikasi"><span class="mdi mdi-check"></span></button>
              <button class="showCancel btn btn-danger" data-id="${data}" data-toggle="modal" data-target="#cancel" title="Cancel Booking"><span class="mdi mdi-minus-circle-outline"></span></button>

            `;
            return btn;
          }},
        ]
      });

      $(document).on('click','.showDetail', function(){
        var json = $(this).data('json');
        console.log(json);
        $('.t-nama').html(json.user.name);
        $('.t-status').html(json.status);
        $('.t-lapang').html(json.detail[0].lapang.nama);
        $('.t-telpon').html(json.user.no_telpon);
        var waktu = `Tanggal : ${json.detail[0].tanggal_main} <br> Jam :`;
        json.detail.forEach(function(el,i){
          waktu += `(${el.waktu_awal} - ${el.waktu_akhir}) `;
        });
        $('.t-waktu').html(waktu);
        $('.t-created_at').html(json.created_at);
        $('.t-cancel_message').html(json.cancel_message);
        if(json.status=='booking_paid' || json.status=='verified'){
          $('.t-nama_pengirim').html(json.nama_pengirim);
          $('.t-bukti').html(`
            <img src='${json.bukti_trf}' width='200'>
          `);
        }
      });


      $(document).on('click','.showVerif',function(){
        var id = $(this).data('id');
        $('#verif form').attr('action', `/admin/booking/${id}/verify`);
      });

      $(document).on('click','.showCancel',function(){
        var id = $(this).data('id');
        $('#cancel form').attr('action', `/admin/booking/${id}/cancel`);
      });
    })
  </script>
@endsection
