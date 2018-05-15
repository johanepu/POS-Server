<?php
include 'header.php'
?>
<?php
  date_default_timezone_set("Asia/Jakarta");
  setlocale(LC_ALL, 'IND');
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <style media="screen">
  .modal-open {
    padding-right: 0px !important;
    overflow-y: auto !important;
  }
  table.tabel{
    width: 70%;
    margin-left: auto;
    margin-right: auto;
  }

  </style>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('vendors/nprogress/nprogress.css'); ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('vendors/iCheck/skins/flat/green.css'); ?>" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css'); ?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('vendors/jqvmap/dist/jqvmap.min.css'); ?>" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('vendors/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">

    <!-- Datatables -->
      <link href="<?php echo base_url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('build/css/custom.min.css'); ?>" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

         <!-- page content -->
        <div class="right_col" style="min-height: 676px;" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Profile <small><?php echo $admins[0]->nama_petugas;?></small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
					<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="<?php echo base_url('build/images/user.png'); ?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3 class="col-md-2 col-md-offset-1"><?php echo $admins[0]->nama_petugas;?></h3>
                    </div>
						<div class="col-md-9 col-sm-9 col-xs-12">
						  <div class="profile_title">
							<div class="col-md-6">
							  <h2>Detail profile</h2>
							</div>
							<div class="col-md-6">
							  <div class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px;">
								<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
								<span><?php
                        $dt = new DateTime();
                        echo $dt->format('Y-m-d H:i:s');
                        ?></span>
							  </div>
							</div>
						  </div>
						  </br>
              <div class="clearfix"></div>
              <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username"><h4>Username : </h4><span></span>
                 </label>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                   <input disabled value="<?php echo $admins[0]->user;?>" class="isi form-control col-md-6 col-xs-12">
                 </div>
                 </div>
               </br>
               <div class="clearfix"></div>
						  <div class="item form-group " >
							  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><h4>Email : </h4><span></span>
  							</label>
  							<div class="col-md-6 col-sm-6 col-xs-12">
  							  <input disabled value="<?php echo $admins[0]->email;?>" class="isi form-control col-md-6 col-xs-12">
  							</div>
  						  </div>

						  <div class="clearfix"></div>
							<div class="form-group">
								<div class="col-md-1 col-md-offset-3">
								  <a class="btn btn-default " href="<?php echo site_url('setting');?>"> <i class="fa fa-cog"></i> Pengaturan</a>
								</div>
							</div>



                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
	  </div>
	</div>


    <!-- Datatables -->
    <script src="<?php echo base_url('vendors/datatables.net/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-buttons/js/dataTables.buttons.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-buttons/js/buttons.flash.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-buttons/js/buttons.html5.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-buttons/js/buttons.print.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js');?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-scroller/js/dataTables.scroller.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/jszip/dist/jszip.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/pdfmake/build/pdfmake.min.js');?>"></script>
    <script src="<?php echo base_url('vendors/pdfmake/build/vfs_fonts.js');?>"></script>
</body>
<?php
include 'footer.php'
?>
</html>
