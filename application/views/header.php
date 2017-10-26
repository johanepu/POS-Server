<?php
  date_default_timezone_set("Asia/Jakarta");
  setlocale(LC_ALL, 'IND');
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style media="screen">
      .nav_menu{
        margin : 0 !important;
      }
      i{
        border:0 !important;
        margin:0 !important;
        padding:0 !important;
      }
      a.site_title{
        padding-left:25px;
      }
      .modal-open {
        padding-right: 0px !important;
        overflow-y: auto !important;
      }
      input.invalid, textarea.invalid{
        border: 2px solid red;
      }
      input.valid, textarea.valid{
        border: 2px solid green;
      }
    </style>
    <title><?php echo $judul; ?> </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('vendors/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('vendors/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('vendors/nprogress/nprogress.css" ');?>"rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('vendors/iCheck/skins/flat/green.css');?>"rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css');?>"rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('vendors/jqvmap/dist/jqvmap.min.css');?>"rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.css');?>"rel="stylesheet">

    <!-- Datatables -->
    <link href="<?php echo base_url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('build/css/custom.min.css');?>"rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo site_url('dashboard')?>" class="site_title"><i class="fa fa-shopping-cart"></i> <span>POS Retail</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url('build/images/user.png'); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2><?php echo $this->session->userdata('nama_petugas');?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo site_url('dashboard');?>"><i class="fa fa-home"></i> Beranda </span></a>
                  </li>
                  <li><a href="<?php echo site_url('cabang')?>"><i class="fa fa-sitemap"></i> Data Cabang </a>
                  </li>
                  <li><a href="<?php echo site_url('clients')?>"><i class="fa fa-bar-chart"></i> Data Barang Cabang </a>
                  </li>
                  <li><a href="<?php echo site_url('barang')?>"><i class="fa fa-cubes"></i> Stok Barang </a>
                  </li>
                <li><a href="<?php echo site_url('barang_masuk')?>"><i class="fa fa-cart-plus"></i> Barang Masuk </a>
                </li>
                <li><a href="<?php echo site_url('barang_keluar')?>"><i class="fa fa-truck"></i> Barang Keluar </a>
                </li>
                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Pengaturan" href="<?php echo site_url('setting');?>">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <!-- <a data-toggle="tooltip" data-placement="top" title="FullScreen" onclick="requestFullScreen(body)">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a> -->
              <a data-toggle="tooltip" data-placement="top" title="Profil"  href="<?php echo site_url('profil')?>">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo site_url('login/logout')?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
              <a title="" >
                <span class="glyphicon " ></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url('build/images/user.png'); ?>" alt=""><?php echo $this->session->userdata('nama');?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo site_url('profil')?>"> Profil</a></li>
                    <li>
                      <a href="<?php echo site_url('setting');?>">
                        <span>Pengaturan</span>
                      </a>
                    </li>
                    <li><a href="<?php echo site_url('login/logout')?>"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span id="notif" class=""></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->



      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('vendors/jquery/dist/jquery.min.js');?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('vendors/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('vendors/fastclick/lib/fastclick.js');?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('vendors/nprogress/nprogress.js');?>"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url('vendors/Chart.js/dist/Chart.min.js');?>"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url('vendors/gauge.js/dist/gauge.min.js');?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js');?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('vendors/iCheck/icheck.min.js');?>"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url('vendors/skycons/skycons.js');?>"></script>
    <!-- Flot -->
    <script src="<?php echo base_url('vendors/Flot/jquery.flot.js');?>"></script>
    <script src="<?php echo base_url('vendors/Flot/jquery.flot.pie.js');?>"></script>
    <script src="<?php echo base_url('vendors/Flot/jquery.flot.time.js');?>"></script>
    <script src="<?php echo base_url('vendors/Flot/jquery.flot.stack.js');?>"></script>
    <script src="<?php echo base_url('vendors/Flot/jquery.flot.resize.js');?>"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url('vendors/flot.orderbars/js/jquery.flot.orderBars.js');?>"></script>
    <script src="<?php echo base_url('vendors/flot-spline/js/jquery.flot.spline.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/flot.curvedlines/curvedLines.js');?>"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url('vendors/DateJS/build/date.js');?>"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url('vendors/jqvmap/dist/jquery.vmap.js');?>"></script>
    <script src="<?php echo base_url('vendors/jqvmap/dist/maps/jquery.vmap.world.js');?>"></script>
    <script src="<?php echo base_url('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js');?>"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('vendors/moment/min/moment.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.js');?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('build/js/custom.min.js');?>"></script>
    <script>
    function toggleFullscreen(event) {
      var element = document.body;
      if (event instanceof HTMLElement) {
        element = event;
      }
      var isFullscreen = document.webkitIsFullScreen || document.mozFullScreen || false;
      element.requestFullScreen = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || function () { return false; };
      document.cancelFullScreen = document.cancelFullScreen || document.webkitCancelFullScreen || document.mozCancelFullScreen || function () { return false; };
      isFullscreen ? document.cancelFullScreen() : element.requestFullScreen();
    }

    function requestFullScreen(element) {
    // Supports most browsers and their versions.
    var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;

    if (requestMethod) { // Native full screen.
        requestMethod.call(element);
    } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}

// var elem = document.body; // Make the body go full screen.
// requestFullScreen(elem);

    $(function(){
      $.ajax({
        url:'<?php echo site_url('dashboard/notifikasi') ?>',
        type:'get',
        dataType:'json',
        success:function(data){
          $('#menu1').html(data.isi);
          $('#notif').html(data.notif);
          $('#notif').attr('class',data.bubble);
        }
      });
      $('#notifikasi').click(function(){
        $('#notif').html('');
        $('#notif').attr('class','');
      });
    });
    </script>
    </body>
    </html>
