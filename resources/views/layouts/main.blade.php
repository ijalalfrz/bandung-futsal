<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Bandoeng Futsal</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('main/css/style.css') }} ">
  <link rel="stylesheet" href="{{ asset('main/css/owl.carousel.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/mine.css') }} ">

  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <!--[if IE 9]>
    <script src="js/media.match.min.js"></script>
  <![endif]-->
  {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous"> --}}
</head>

<body>
<div id="main-wrapper">


  <!-- Start Header -->
  <header id="header" class="second-version" style="top: 0">
    <div class="container">
      <div class="header-logo">
        <a href="index.html"><img src="{{ asset('main/img/logo.png') }}" alt=""></a>
        <div class="triangle-left"></div>
        <div class="triangle-right"></div>
      </div>
    </div>
    <div class="header-toolbar">
      <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <div class="header-user pull-right">
            <ul class="custom-list">
              <li>
               <!--  <div class="header-user-forms">
                  <div class="header-login">
                    <a href="#" class="">Login</a>
                    <div>
                      <form action="#" class="default-form">
                        <p class="form-row">
                          <input type="text" class="form-control" placeholder="Username">
                        </p>
                        <p class="form-row">
                          <input type="password" class="form-control" placeholder="Password">
                        </p>
                        <p class="form-row">
                          <input type="submit" class="btn full-width" value="Login">
                        </p>
                        <a href="#" class="btn btn-link">Forgot Password?</a>
                      </form>
                    </div>
                  </div>
                  <div class="header-register">
                    <a href="#" class="">Register</a>
                    <div>
                      <form action="#" class="default-form">
                        <p class="form-row">
                          <input type="text" class="form-control" placeholder="Username">
                        </p>
                        <p class="form-row">
                          <input type="email" class="form-control" placeholder="Email">
                        </p>
                        <p class="form-row">
                          <input type="password" class="form-control" placeholder="Password">
                        </p>
                        <input type="submit" class="btn full-width" value="Register">
                      </form>
                    </div>
                  </div>
                </div> -->
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="header-navbar">
      <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <nav class="navigation">
            <ul class="list-inline text-center custom-list">
          <!--     <li class="has-submenu">
                <a href="#">Home</a>
                <ul class="sub-menu custom-list">
                  <li class="active"><a href="index.html">Home Default</a></li>
                  <li><a href="home2.html">Home Variation 2 (teams)</a></li>
                  <li><a href="home3.html">Home Variation 3 (newsletter block)</a></li>
                  <li><a href="home4.html">Home Variation 4 (timeline & gallery block a)</a></li>
                  <li><a href="home5.html">Home Variation 5 (video & trophies)</a></li>
                  <li><a href="home6.html">Home Variation 6 (video & social)</a></li>
                  <li><a href="home7.html">Home Variation 7 (video & widgets)</a></li>
                  <li><a href="home8.html">Home Variation 8 (contact form block)</a></li>
                </ul>
              </li> -->
              <li class="{{ Request::path()=='/'?'active-nav':'' }}"><a href="{{ url('/') }}">Home</a></li>
              <li class="{{ Request::path()=='lapang'?'active-nav':'' }}"><a href="{{ url('/lapang') }}">Jadwal Lapangan</a></li>
              @if(Auth::check())
              <li class="{{ Request::path()=='booking'?'active-nav':'' }}"><a href="{{ url('/booking') }}">Booking</a></li>
              <li class="{{ Request::path()=='profile'?'active-nav':'' }}"><a href="{{ url('/profile') }}">Profile</a></li>
              <li >
                <form method="POST" action="{{ url('/logout') }}">
                  @csrf
                  <button class="mn" type="submit" >Logout</button>
                </form>
              </li>
              @endif
            </ul>
          </nav>

          {{-- <div class="dd-user">
            {{ Auth::user()->name }}
          </div> --}}
     {{--      <ul class="social list-inline">
            <li><a href="">Profile</a></li>

            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
          </ul> --}}
          <button class="navbar-toggle">
            <i class="fa fa-list"></i>
          </button>
        </div>
      </div>
    </div>
  </header>
  <!-- End Header -->


  @yield('content')

  <!-- Start Footer -->
  <footer id="footer">
    <div class="container">

      <!-- Start Footer-Top -->
      <div class="footer-top clearfix">
        <div class="widget col-lg-4 col-md-4 col-sm-6">
          <h5 class="widget-title">Bandoeng FC</h5>
          <ul class="contact-info custom-list">
            <li><i class="fa fa-map-marker"></i><span>Jl. Gegerkalong No 16</span></li>
            <li><i class="fa fa-phone"></i><span>+62 8567283332</span></li>
            <li><i class="fa fa-envelope"></i><span><a href="mailto:bandoengfutsal@gmail.com">bandoengfutsal@gmail.com</a></span></li>
          </ul>
        </div>
        <div class="widget col-lg-4 col-md-4 col-sm-6">
          <h5 class="widget-title">Information</h5>
          <ul class="custom-list">
            <li><a href="#">Home</a></li>
            <li><a href="#">Booking</a></li>
            <li><a href="#">Jadwal Lapang</a></li>
          </ul>
        </div>
        <div class="widget col-lg-4 col-md-4 col-sm-6">
          <h5 class="widget-title">Gallery</h5>
<!--           <ul class="gallery custom-list row">
            <li><a href="#"><img src="img/gallery_footer.jpg" alt=""></a></li>
            <li><a href="#"><img src="img/gallery_footer2.jpg" alt=""></a></li>
            <li><a href="#"><img src="img/gallery_footer3.jpg" alt=""></a></li>
            <li><a href="#"><img src="img/gallery_footer4.jpg" alt=""></a></li>
            <li><a href="#"><img src="img/gallery_footer5.jpg" alt=""></a></li>
            <li><a href="#"><img src="img/gallery_footer6.jpg" alt=""></a></li>
          </ul> -->
        </div>
      </div>
      <!-- End Footer-Top -->
    </div>

    <!-- Start Copyrights -->
    <div class="copyrights clearfix text-center">
      <p class="col-lg-12">© Copyright 2018 Bandoeng Futsal. All Rights Reserved</p>
    </div>
    <!-- End Copyrights -->

  </footer>
  <!-- End Footer -->

  <!-- Start Back-to-Top -->
  <a href="#" id="back-to-top">
    <i class="fa fa-angle-up"></i>
  </a>
  <!-- End Back-to-Top -->

</div>
<!-- end #main-wrapper -->

<!-- Scripts -->
<script src="{{ asset('main/js/jquery.min.js') }}"></script>
<script src="{{ asset('main/js/scripts.js') }}"></script>
<script src="{{ asset('main/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('main/js/jquery.ba-outside-events.min.js') }}"></script>
<script src="{{ asset('main/js/tab.js') }}"></script>
<script src='{{ asset('main/js/bootstrap-datepicker.js') }}'></script>
<script src="{{ asset('main/js/jquery.vide.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>

<script type="text/javascript">
  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $(input).prev().attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
  function notifyMe(data) {
    if (Notification.permission !== "granted")
      Notification.requestPermission();
    else {
      var notification = new Notification('Notification title', {
        title: data.title,
        icon: data.image,
        body: data.message,
      });

      notification.onclick = function () {
        window.location.href = data.href;
      };

    }

  }
  $(function(){


    setInterval(function()
    {
        $.ajax({
            type: "get",
            url: "{{ url('/api/check-booking') }}",
            success:function(data)
            {
                //console.log the response
                // console.log(data);
            }
        });
    }, 60000);


    $('.overlay').click(function(){
      $('.overlay-wrap').removeClass('show');
      $('.overlay-wrap').fadeOut();
    });

    $('.showModal').click(function(){
      $($(this).data('modal'))
        .css("display", "flex")
        .hide()
        .fadeIn();
    });

    $(".file-hidden").change(function() {
      readURL(this);
    });

    $(".img-prev").click(function(){
      $(this).next().click();
    });

    $(".date-picker").on("change", function() {
      this.setAttribute(
          "data-date",
          moment(this.value, "YYYY-MM-DD")
          .format( this.getAttribute("data-date-format") )
      )
    }).trigger("change");

    $('.msg').delay(2000).fadeOut();

    //NOTIF
    if (!Notification) {
      alert('Desktop notifications not available in your browser. Try Chromium.');
      return;
    }

    if (Notification.permission !== "granted"){
      Notification.requestPermission();
    }

    Pusher.logToConsole = true;

     // Initiate the Pusher JS library
    var pusher = new Pusher('67b689f1b7f71c36e781', {
      cluster: 'ap1',
      encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('new-order');


    channel.bind('order-status-change', function(data) {

      var obj = {
        message : data.message,
        image : '{{ url('main/img/logo-notif.jpg') }}',
        href: '{{ url('/admin/booking') }}'
      }
      if(data.status == 'canceled'){
        obj.title = 'Order anda ditolak oleh admin.';
      }else{
        obj.title = 'Order anda diverifikasi.';
      }
      var user = {{\Auth::check()?\Auth::check():'0'}};

      if(data.user_id == user){
        notifyMe(obj);
        $.get('{{ url('/api/booking/'.\Auth::id())}}', function(data){
        }).done(function(data,err){
          $('.riwayat').empty();

          data.forEach(function(el,i){
            var lapang = el.detail[0].lapang;
            var first = el.detail[0];
            var waktu='';
            el.detail.forEach(function(detail,i){

              waktu += `<b> (${detail.waktu_awal} - ${detail.waktu_akhir})</b>`;
            });
            var pesan='';

            if(el.status== 'canceled'){
              if(!el.cancel_message) el.cancel_message = "";
              pesan = `<p class="red-color"><b>Pesan: ${el.cancel_message}</b></p>`;
            }else if(el.status== 'booking_paid'){
              pesan = `<p class="red-color"><b>Pesan: sudah dibayar</b></p>`;
            }

            var status='';
            if(el.status == 'new') status = 'Belum dibayar';
            if(el.status == 'verified') status = 'Sudah diverifikasi';
            if(el.status == 'booking_paid') status = 'menunggu verifikasi';
            if(el.status == 'canceled') status = 'Ditolak';

            var btn ='';
            if(el.status == 'new'){
              btn = `<a href="javascript:void(0);" data-json='${JSON.stringify(el)}' data-modal='#booking-confirm' class="btnBayar showModal button blue button-max-120">BAYAR</a>
              <a href="{{ url('/booking/cancel/') }}${el.id}" class="button m-10 button-max-120">BATAL</a>`;
            }



            $('.riwayat').append(`
              <li>
              <div class="row" >
                <div class="col-md-4">
                  <img src="{{ asset('uploads/') }}/${lapang.foto}" class="img-thumbnail">
                </div>
                <div class="col-md-3">
                  <h3>${lapang.nama}</h3>
                  <h5>WAKTU BOOKING:</h5>
                  ${el.created_at}
                  <h5>TANGGAL MAIN:</h5>
                  ${first.tanggal_main}
                  <h5>JAM MAIN :</h5>
                  <p>${waktu}</p>
                  <p class="red-color">Total Biaya : Rp. ${(el.total_harga/1000).toFixed(3)}</p>
                  ${pesan}
                </div>
                <div class="col-md-3">
                  <h3>STATUS</h3>
                  <span class="statusUpdate status ${el.status}">
                    ${status}
                  </span>
                </div>
                <div class="col-md-2">
                  <h3 class="text-center">AKSI</h3>
                  ${btn}
                </div>
              </div>
            </li>

            `);
          });
        }).fail(function(data){

        });

      }
    });

  });
</script>
@yield('script')
</body>
</html>
