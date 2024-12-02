<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">

    <title>Woody Auction|Member Panel</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend') }}/assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="{{ asset('backend') }}/assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('backend') }}/dist/css/style.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css') }}/daterangepicker.css">

    <!----===== For Toaster Message =====--->
    {{-- <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css') }}/toastr.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
    .sidebar-nav ul .sidebar-item.selected > .sidebar-link {background: #1F262D;opacity: 1;}
    .active ul li a{background: #090808 !important;}
    table .btn-default {background-color: #f6f9f8;border-color: #28b779;}
    .footer {display: none !important;}
    .form-control:focus {border-color: red;}
@media(max-width: 768px)
{
    .text-end {text-align: left !important;}
}
</style>

</head>

<body onload="startTime();auctionmonitoring();">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">

                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="javascript:void(0)">
                        <!-- Logo icon -->
                        <b class="logo-icon ps-2">
                            
                            <img src="{{ url('/') }}/assets/images/logo-icon.png" alt="Member Panel"
                                class="light-logo" />

                        </b>
                       
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block"><a
                                class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#"
                                id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('backend') }}/assets/images/users/1.jpg" alt="user"
                                    class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{route('member.profile')}}"><i
                                        class="ti-user me-1 ms-1"></i>
                                    Account
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off me-1 ms-1"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                       
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        
            @include('inc.member_master_leftsidebar')


        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->


            @yield('content')


            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Woody-admin. Designed and Developed by <a
                    href="javascript:">Woodyltd</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('backend') }}/assets/libs/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Datepicker -->
    <script src="{{ asset('backend') }}/datepicker/select2.js"></script>
    <script src="{{ asset('backend') }}/datepicker/moment.js"></script>
    {{-- <script src="https://adminlte.io/themes/v3/plugins/inputmask/jquery.inputmask.min.js"></script> --}}
    <script src="{{ asset('js') }}/jquery.inputmask.min.js"></script>
    <script src="{{ asset('backend') }}/datepicker/daterangepicker.js"></script>

    
    <script src="{{ asset('backend') }}/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/extra-libs/sparkline/sparkline.js"></script>

    {{-- <script src="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.js"></script> --}}
    <script src="{{ asset('js') }}/daterangepicker.js"></script>
    {{-- <script src="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> --}}
    <script src="{{ asset('js') }}/tempusdominus-bootstrap-4.min.js"></script>

    <!--Wave Effects -->
    <script src="{{ asset('backend') }}/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('backend') }}/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('backend') }}/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="{{ asset('backend') }}/assets/libs/flot/excanvas.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/flot/jquery.flot.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/flot/jquery.flot.time.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/pages/chart/chart-page-init.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>

    <!----===== For Toaster Message =====--->
    <script src="{{ asset('js') }}/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
        
            var type = "{{Session::get('alert-type','info')}}"
            switch(type)
            {
                case 'info':type
                    toastr.info("{{Session::get('message')}}");
                    break;
                case 'success':type
                    toastr.success("{{Session::get('message')}}");
                    break;
                case 'worning':type
                    toastr.worning("{{Session::get('message')}}");
                    break;
                case 'error':type
                    toastr.error("{{Session::get('message')}}");
                    break;
            }
        @endif
    </script>  


    <script>
        function change_language(lan)
        {
        $.ajax({
                type:'GET',
                url: '/change_language/'+lan,
                dataType:'json',
                success:function(response){
                location.reload();
                }
            })
        }
        
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date and time picker
            $('#datetimepicker1').datetimepicker({ icons: { time: 'far fa-clock' } });
            //Date and time picker
            $('#datetimepicker2').datetimepicker({ icons: { time: 'far fa-clock' } });
            //Date picker
            $('#datepicker1').datetimepicker({ format: 'L' });
            //Date picker
            $('#datepicker2').datetimepicker({ format: 'L' });
       });
      </script>

    <script>
    $(function () {
    
                //Date picker
                $('#datepicker1').datepicker();
           });
    </script>

      <script>
          function memory_clear()
          {
            $.ajax({
                type:'GET',
                url: '/auction/clear_memory',
                dataType:'json',
                success:function(response){
                  alert(response.result);
                }
            })
          }
      </script>  
      
      <script>
        function winner_mail(productid)
          { 
              
          $.ajax({
                  type:'GET',
                  url: '/bid/winner_mail/'+productid,
                  dataType:'json',
                  success:function(response){
                      alert(response);
                      if(response['message'])
                      {
                          alert(response['message']);
                      }
                  }
              })
          }
    </script>

<script>
    function showbidder(bidderid)
    { 
        $.ajax({
            type:'GET',
            url: '/auction/bidderinfo/'+bidderid,
            dataType:'json',
            success:function(data){  //alert(data.result);
                $('#bidderview').val("");
                var tablerow ="";
              $.each(data,function(key,value){
                tablerow += `<tr>
                        <td>${value.usercodeno}</td>
                        <td>${value.company_name}</td>
                        <td>${value.name}</td>
                        <td>${value.person_incharge}</td>
                        <td>${value.country}</td>
                        <td>${value.email1}</td>
                        <td>${value.phone1}</td>
                    </tr>`  
              });
              $('#bidderview').html(tablerow);
              document.getElementById('bidderinfo').style.display='block';
            }
        })
    }
</script>
<script>
    function startTime() {
      const today = new Date();
      let h = today.getHours();
      let m = today.getMinutes();
      let s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
      setTimeout(startTime, 1000);
    }
    
    function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
    }
</script>


<script src="{{ asset('backend') }}/lib/sweetalert/sweetalert.min.js"></script>
<script src="{{ asset('backend') }}/lib/sweetalert/code.js"></script>









</body>

</html>
