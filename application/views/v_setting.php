<?php
include 'header.php'
?>

<!DOCTYPE html>
<html lang="en">
  <head>
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

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('build/css/custom.min.css'); ?>" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

         <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Pengaturan <small><?php echo $admins[0]->nama_petugas; 	?></small></h3>
              </div>
            </div>

            <div class="clearfix"></div>
			<?php
			$hidden='hidden';
			$hidden1='hidden';
			if(isset($status)){
			if($status=='gagal'){$hidden = ''; $hidden1='hidden';}
				else if($status=='sukses'){$hidden='hidden'; $hidden1 = '';}
			}
			?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" id="formemail" action="<?php echo site_url().'/setting/email/'.$admins[0]->id; ?>" method="post">
                      <span class="section">Ubah email</span>
					  <div class="<?php echo $hidden; ?>">
						<p class="col-md-2 col-sm-2 col-xs-2"></p>
						<p class="col-md-7 col-sm-7 col-xs-7 btn-danger" align="center">Password salah, email gagal diubah</p>
					  </div>
					  <div class="<?php echo $hidden1; ?>">
						<p class="col-md-2 col-sm-2 col-xs-2"></p>
						<p class="col-md-7 col-sm-7 col-xs-7 btn-success" align="center">Email berhasil diubah</p>
					  </div>
					  <div class="clearfix"></div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="isi form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Konfirmasi Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email2" name="email2" data-validate-linked="email"  class="isi form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" type="password" name="password" class="isi form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-1 col-md-offset-8">
                          <button id="send" type="submit" class="btn btn-default" >Simpan</button>
                        </div>
                      </div>
                    </form>
					<?php
						$hidden2='hidden';
						$hidden3='hidden';
						if(isset($status1)){
						if($status1=='gagal'){$hidden2 = ''; $hidden3='hidden';}
						else if($status1=='sukses'){$hidden2='hidden'; $hidden3 = ''; header("refresh:3;url=".site_url('login/logout')."");}
						}
					?>
                    <form class="form-horizontal form-label-left" id="formpass" action="<?php echo site_url().'/setting/password/'.$admins[0]->id; ?>" method="post">
                      <span class="section">Ubah password</span>
					  <div class="<?php echo $hidden2; ?>">
						<p class="col-md-2 col-sm-2 col-xs-2"></p>
						<p class="col-md-7 col-sm-7 col-xs-7 btn-danger" align="center">Password lama salah, password gagal diubah</p>
					  </div>
					  <div class="<?php echo $hidden3; ?>">
						<p class="col-md-2 col-sm-2 col-xs-2"></p>
						<p class="col-md-7 col-sm-7 col-xs-7 btn-success" align="center">Password berhasil diubah, silahakan login kembali dalam 3 detik</p>
					  </div>
					  <div class="clearfix"></div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password Lama <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pass" type="password" name="pass" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password Baru <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pass1" type="password" name="pass1" minlength=8 maxlength=30 class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Ulangi Password Baru <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="pass2" type="password" name="pass2" data-validate-linked="pass1" class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-1 col-md-offset-8">
                          <button id="send2" type="submit" class="btn btn-default">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
	  </div>
	</div>

    <!-- validator -->
    <script src="<?php echo base_url('vendors/validator/validator.js'); ?>"></script>

	<script>

	function simpanemail(id){
		var pass = document.getElementById('password').value;
		var pass2 = '<?php echo $admins[0]->access_password ?>';
		if (pass == pass2){
		 $.ajax({
			url : '<?php echo site_url('setting/email/');?>'+id,
			type: "POST",
			data: $('#formemail').serialize(),
			dataType: "JSON",
			success: function(response)
			{
			   alert('Berhasil mengubah email');
			   location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Email gagal diubah');
				location.reload();
			}
		});
		}
		else{
			alert('Password salah');
			location.reload();
		}
	}

	function simpanpass(id){
		var pass = document.getElementById('pass').value;
		var pass2 = '<?php echo $admins[0]->access_password ?>';
		if (pass == pass2){
		 $.ajax({
			url : '<?php echo site_url('setting/password/');?>'+id,
			type: "POST",
			data: $('#formpass').serialize(),
			dataType: "JSON",
			success: function(response)
			{
			   alert('Berhasil mengubah password, silahkan login kembali');
			   location.href="<?php echo site_url('login/logout');?>";
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Password gagal diubah');
				location.reload();
			}
		});
		}
		else{
			alert('Password salah');
			location.reload();
		}
	}
	</script>
</body>
<?php
include 'footer.php'
?>
</html>
