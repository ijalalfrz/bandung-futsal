<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Login Admin - Bandung Futsal">
        <meta name="author" content="Rizal Alfarizi">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('img/logo-fav.png') }}">
        <title>{{ config('app.name', 'Login Admin') }}</title>

        <link href="{{ asset('lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/material-design-icons/css/material-design-iconic-font.min.css') }}" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="{{ asset('lib/datatables/css/dataTables.bootstrap.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>

        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/mine.css') }}" rel="stylesheet">
    </head>
    <body>

        <div class="be-wrapper">
          <nav class="navbar navbar-default navbar-fixed-top be-top-header">
            <div class="container-fluid">
              <div class="navbar-header"><a href="" class="navbar-brand"></a></div>
              <div class="be-right-navbar">
                <ul class="nav navbar-nav navbar-right be-user-nav">
                  <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="{{ asset('img/avatar.png') }}" alt="Avatar"><span class="user-name">Túpac Amaru</span></a>
                    <ul role="menu" class="dropdown-menu">
                      <li>
                        <div class="user-info">
                          <div class="user-name">{{ Auth::guard('admin')->user()->name }}</div>
                          <div class="user-position online">Available</div>
                        </div>
                      </li>
                      <li><a href="#"><span class="icon mdi mdi-face"></span> Account</a></li>
                      <li><a href="#"><span class="icon mdi mdi-settings"></span> Settings</a></li>
                      <li>
                        <a href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <span class="icon mdi mdi-power"></span> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      </li>
                    </ul>
                  </li>
                </ul>
                <div class="page-title"><span>Bandoeng Futsal CMS</span></div>
               {{--  <ul class="nav navbar-nav navbar-right be-icons-nav">
                  <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
                    <ul class="dropdown-menu be-notifications">
                      <li>
                        <div class="title">Notifications<span class="badge">3</span></div>
                        <div class="list">
                          <div class="be-scroller">
                            <div class="content">
                              <ul>
                                <li class="notification notification-unread"><a href="#">
                                    <div class="image"><img src="{{ asset('img/avatar2.png') }}" alt="Avatar"></div>
                                    <div class="notification-info">
                                      <div class="text"><span class="user-name">Jessica Caruso</span> accepted your invitation to join the team.</div><span class="date">2 min ago</span>
                                    </div></a></li>
                                <li class="notification"><a href="#">
                                    <div class="image"><img src="{{ asset('img/avatar3.png') }}" alt="Avatar"></div>
                                    <div class="notification-info">
                                      <div class="text"><span class="user-name">Joel King</span> is now following you</div><span class="date">2 days ago</span>
                                    </div></a></li>
                                <li class="notification"><a href="#">
                                    <div class="image"><img src="{{ asset('img/avatar4.png') }}" alt="Avatar"></div>
                                    <div class="notification-info">
                                      <div class="text"><span class="user-name">John Doe</span> is watching your main repository</div><span class="date">2 days ago</span>
                                    </div></a></li>
                                <li class="notification"><a href="#">
                                    <div class="image"><img src="{{ asset('img/avatar5.png') }}" alt="Avatar"></div>
                                    <div class="notification-info"><span class="text"><span class="user-name">Emily Carter</span> is now following you</span><span class="date">5 days ago</span></div></a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="footer"> <a href="#">View all notifications</a></div>
                      </li>
                    </ul>
                  </li>
                </ul> --}}
              </div>
            </div>
          </nav>
          <div class="be-left-sidebar">
            <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Blank Page</a>
              <div class="left-sidebar-spacer">
                <div class="left-sidebar-scroll">
                  <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                      <li class="divider">Menu</li>
                      <li class="{{Request::is('admin/dashboard')?'active':'' }}" ><a href="{{url('admin/dashboard')}}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a></li>
                      <li class="{{Request::is('admin/lapang')?'active':'' }}" ><a href="{{url('admin/lapang')}}"><i class="icon mdi mdi-map"></i><span>Lapang</span></a></li>
                      <li class="{{Request::is('admin/user')?'active':'' }}" ><a href="{{url('admin/user')}}"><i class="icon mdi mdi-account"></i><span>User</span></a></li>
                      <li class="{{Request::is('admin/booking')?'active':'' }}" ><a href="{{url('admin/booking')}}"><i class="icon mdi mdi-money-box"></i><span>Booking</span></a></li>
                      <li class="{{Request::is('admin/laporan')?'active':'' }}" ><a href="{{url('admin/laporan')}}"><i class="icon mdi mdi-file-text"></i><span>Laporan</span></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="be-content">

              @yield('content')
          </div>
        </div>

        <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>
        <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
        @yield('script')

        <script type="text/javascript">
          var t;
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
          $(document).ready(function(){
            //initialize the javascript


            $(".file-hidden").change(function() {
              readURL(this);
            });

            $(".img-prev").click(function(){
              $(this).next().click();
            })


            Pusher.logToConsole = true;

            // Initiate the Pusher JS library
            var pusher = new Pusher('67b689f1b7f71c36e781', {
              cluster: 'ap1',
              encrypted: true
            });

            // Subscribe to the channel we specified in our Laravel Event
            var channel = pusher.subscribe('new-order');

            // Bind a function to a Event (the full Laravel class)
            channel.bind('new-order-notif', function(data) {
              console.log(data);
              var obj = {
                title: 'Booking Baru',
                message : data.message,
                image : '{{ url('main/img/logo-notif.jpg') }}',
                href: '{{ url('/admin/booking') }}'
              }
              notifyMe(obj);
              if(t){
                t.ajax.reload();
              }

                // this is called when the event notification is received...
            });

            channel.bind('new-order-confirmed', function(data) {
              console.log(data);
              var obj = {
                title: 'Booking Dibayar',
                message : data.message,
                image : '{{ url('main/img/logo-notif.jpg') }}',
                href: '{{ url('/admin/booking') }}'
              }
              notifyMe(obj);
              if(t){
                t.ajax.reload();
                // $('.sid_'+obj.id).trigger('click');
              }
                // this is called when the event notification is received...
            });

            if (!Notification) {
              alert('Desktop notifications not available in your browser. Try Chromium.');
              return;
            }

            if (Notification.permission !== "granted"){
              Notification.requestPermission();
            }

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


            App.init();
            App.formElements();



          });

        </script>

    </body>
</html>
