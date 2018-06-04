@extends('layouts.new-admin')
@section('content')
<div class="page-head">
  <h2 class="page-head-title">Lapang</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Lapang</a></li>
    <li class="active">Create</li>
  </ol>
</div>
<div class="main-content container-fluid">
  <div class="row">
    <div class="col-sm-12">
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul style="padding: 0px 10px;">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <div class="panel panel-default">
        <div class="panel-heading">Create Lapang
        </div>
        <div class="panel-body">
          <form method="POST" action="{{url('admin/lapang/'.$id)}}" enctype="multipart/form-data">
            @csrf

            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group xs-pt-10 {{ $errors->has('nama') ? ' has-error' : '' }}">
              <label>Nama</label>
              <input name="nama" placeholder="Nama lapang" class="form-control" type="text" value="{{$lapang->nama}}">
            </div>

            <div class="form-group xs-pt-10  {{ $errors->has('deskripsi') ? ' has-error' : '' }}">
              <label>Deskripsi</label>
              <input name="deskripsi" placeholder="Deskripsi lapang" class="form-control" type="text" value="{{$lapang->deskripsi}}">
            </div>

            <div class="form-group xs-pt-10 {{ $errors->has('jenis') ? ' has-error' : '' }}">
              <label>Jenis</label>
              @php
                $arr = ['sintetis' => 'Sintetis' , 'karet' => 'Karet'];

              @endphp
              {{ Form::select('jenis', $arr, $lapang->jenis, ['class'=>'form-control']) }}

            </div>

            <div class="form-group xs-pt-10 {{ $errors->has('harga_sewa') ? ' has-error' : '' }}">
              <label>Harga Sewa</label>
              <input min="0" step="1" name="harga_sewa" placeholder="Harga sewa lapang" class="form-control " type="number" value="{{$lapang->harga_sewa}}">
            </div>
            <div class="form-group xs-pt-10">
              <label>Foto <strong>(max 5MB)</strong></label>
            </div>
            <div>
              @if($lapang->foto!=null)
              <img src="{{asset('uploads/'.$lapang->foto)}}" width="250" class="img-prev img-thumbnail">
              @else
              <img src="{{asset('img/add_image.svg')}}" width="250" class="img-prev img-thumbnail">
              @endif
              <input type="file" name="foto" class="file-hidden" accept="image/*">
            </div>
            <br>
            <div class="pull-right">
              <button type="submit" class="btn btn-lg btn-success">Simpan</button>
              <a href="{{url('admin/lapang')}}" class="btn btn-lg btn-info">Kembali</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
