@extends('layouts.main')

@section('content')
  @if(Session::has('msg'))
    <div class="msg">{{ Session::get('msg') }}</div>
  @endif
   @php
    $class ='';
    if(Session::has('err-login') && Session::get('err-login') == true){
      $class='show';
    }
  @endphp

  <div id="login" class="overlay-wrap {{ $class }}">
    <div class="overlay"></div>
    <div class="form-panel text-center">
      <h3>LOGIN BANDOENG FUTSAL</h3>
      <br>
      <div class="form-wrap">
        <form method="POST" action="{{ url('login') }}">
          @csrf
          @if ($errors->has('sistem'))
              <span class="alert-danger">
                  <strong>{{ $errors->first('sistem') }}</strong>
              </span>
          @endif
          <input type="text" name="email" placeholder="Email" value="">
          @if ($errors->has('email'))
              <span class="alert-danger">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif

          <input type="password" name="password" placeholder="Password" value="">
          @if ($errors->has('password'))
              <span class="alert-danger">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
          <div class="clearfix"></div>
          <button type="submit" class="button"><span>Login</span></button>

        </form>
      </div>
    </div>
  </div>
  @php
    $class ='';
    if($errors->any() && Session::has('err-login') && Session::get('err-login') == false){
      $class='show';
    }
  @endphp

  <div id="register" class="overlay-wrap {{ $class }}">
    <div class="overlay"></div>
    <div class="form-panel text-center">
      <h3>REGISTER BANDOENG FUTSAL</h3>
      <br>

      <div class="form-wrap">
        <form method="POST" action="{{ url('register') }}">
          @csrf
          <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
          @if ($errors->has('email'))
              <span class="alert-danger">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif

          <input type="password" name="password" placeholder="Password">
           @if ($errors->has('password'))
              <span class="alert-danger">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
          <input type="password" name="password_confirmation" placeholder="Konfirmasi Password">

          <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}">
          @if ($errors->has('name'))
              <span class="alert-danger">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
          <input type="text" name="no_telpon" placeholder="No Telpon" value="{{ old('no_telpon') }}">
          @if ($errors->has('no_telpon'))
              <span class="alert-danger">
                  <strong>{{ $errors->first('no_telpon') }}</strong>
              </span>
          @endif
          <input type="text" name="alamat" placeholder="Alamat Lengkap" value="{{ old('alamat') }}">
          @if ($errors->has('alamat'))
              <span class="alert-danger">
                  <strong>{{ $errors->first('alamat') }}</strong>
              </span>
          @endif
          <div class="clearfix"></div>

          <div style="display: block;">
            <button type="submit" class="button"><span>Register</span></button>
          </div>

        </form>
      </div>
    </div>
  </div>


  <!-- Start Intro -->
  <div class="intro">
    <div id="home-slider" class="fixed-nav owl-carousel owl-theme">
      <div class="item">

        <!-- Start Video Background -->
        <div id="video_intro" data-vide-bg="main/video/soccer1" data-vide-options="position: 0% 50%"></div>
        <div class="video_gradient"></div>
        <!-- End Video Background -->

        <div class="slide-content col-lg-6 col-lg-offset-3 col-md-12 col-sm-12 text-center">
          <h1>Bandoeng Futsal</h1>
          <h4 style="color:#fff">Mudah booking futsal hanya di BandoengFutsal.com </h4>
          <br>
          @guest
            <a href="#" data-modal='#login' class="showModal button"><span>Login</span></a> &emsp;
            <a href="#" data-modal='#register' class="showModal button"><span>Register</span></a>
          @else
            <h6 style="color:#fff">Hallo  {{ Auth::user()->name }} , mau booking lapang mana hari ini?</h6>
            <a href="/lapang" class=" button"><span>Booking</span></a>
          @endguest
        </div>
      </div>

    </div>

  </div>
  <!-- End Intro -->

  <!-- Start About -->
  <div id="about" class="about">

    <!-- Start Container -->
    <div class="container">

      <!-- Start Preamble -->
      <div class="preamble text-center col-lg-10 col-lg-offset-1">
        <h4>Tentang</h4>
        <p>
          Bandoeng futsal merupakan tempat dimana anda akan mendapatkan pengalaman terbaik dalam bermain futsal bersama dengan teman - teman, didukung dengan sarana skala internasional dengan harga sewa murah.
          <br>
        </p>
        <h5>
        Jam buka : 07.00 - 21.00

        </h5>
      </div>
      <!-- End Preamble -->

    </div>
    <!-- End Container -->


  </div>
  <!-- End About -->
@endsection
