@extends('layouts.main')


@section('content')
<div style="position: relative;min-height: 600px; overflow: hidden;margin-bottom: 50px;">
  <div style="margin-top: 150px;" class="container text-center">
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

    <h4>PROFILE</h4>

    <form style="width: 500px;margin:auto" class="form-wrap" method="POST" action="{{ url('/profile/'.$profile->id.'/edit') }}">
      @csrf
      <input type="hidden" name="_method" value="PUT">
      <input type="text" name="name" placeholder="Nama" value="{{$profile->name}}" required>
      <input type="text" name="alamat" placeholder="Alamat" value="{{$profile->alamat}}" required>
      <input type="text" name="no_telpon" placeholder="No Telepon" value="{{$profile->no_telpon}}" required>
      <button class="button" type="submit">Simpan Perubahan</button>
    </form>
  </div>
</div>
@endsection
