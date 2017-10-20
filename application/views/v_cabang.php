
<?php
include 'header.php'
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
		 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Data <small>Cabang</small></h3>
              </div>
            </div>
			<div class="clearfix"></div>

			<div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Data Cabang</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Data Petugas</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
            			<div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
            						              <button class="btn btn-default btn-sm" onclick="tambah()"><span class="fa fa-plus"></span> Tambah Cabang</button>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">

                                <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Nama Cabang</th>
                                      <th>Username</th>
                                      <th>Password</th>
                                      <th>IP Address</th>
                                      <th>Telepon</th>
                                      <th>Tanggal Dibuat </th>
                                      <th>Hapus</th>
                                    </tr>
                                  </thead>
                          					  <tbody>
                          					  <?php
                          						$no = 1;
                          						foreach($cabang as $c){
                          					  ?>
                                      <tr id="<?php echo $c->id_cabang?>">
                                      <td><?php echo $no++?></td>
                                      <td title="Double click untuk edit and tekan Enter to menyimpan"
                                      class="edit" id="nama"><?php echo $c->nama_cabang?></td>
                                      <td title="Kolom ini tidak bisa diedit"
                                      class="" id="user"><?php echo $c->user?></td>
                                      <td title="Kolom ini tidak bisa diedit"
                                      class="" id="pass"><?php echo $c->access_password?></td>
                                      <td title="Kolom ini tidak bisa diedit"
                                      class="" id="ip"><?php echo $c->ip_address?></td>
                                      <td title="Double click untuk edit and tekan Enter to menyimpan"
                                      class="edit" id="nama"><?php echo $c->telepon?></td>
                                      <td title="Kolom ini tidak bisa diedit"
                                      class="" id="tanggal"><?php echo strftime("%A, %d/%m/%Y : %T", strtotime($c->dibuat));?></td>
                                      <td name="cabang"><button class="btn btn-danger btn-xs delete" id="<?php echo $c->id_cabang;?>">
                                      <i class="fa fa-remove"></i></button></td>
                                      </tr>
                                      <?php }?>
                                  </tbody>
                                </table>
                            </div>
                          </div>
            			 </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_title">
                        <h2>Silahkan Pilih Cabang :</h2>
              					<div class="col-md-8 col-sm-8 col-xs-6">
              					<select id="pil" class="form-control input-sm" onchange="javascript:lihatpetugas(this.value)">
              						<option value="0" selected>--Pilih--</option>
              						<?php foreach($cabang as $c){?>
              						<option value="<?php echo $c->id_cabang?>"><?php echo $c->nama_cabang?></option>
              						<?php }?>
              					</select></div>
              					<a class="btn btn-default btn-sm disabled" onclick="tambahpetugas()" id="tombol"><span class="fa fa-plus"></span> Tambah Petugas</a>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <table id="myTable1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>No. </th>
                                <th>Nama Petugas</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>Terakhir Login</th>
                                <th>Hapus</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                      </div>
              			 </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		   </div>
     </div>
		</div>
	  </div>
	</div>

	<!-- Bootstrap modal -->
  <div class="modal fade multi-step" id="modal_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Tambah Cabang</h3>
          <h4 class="modal-title step-1" data-step="1">Step 1</h4>
          <h4 class="modal-title step-2" data-step="2">Step 2</h4>
        </div>
        <form action="#" id="form" class="form-horizontal" name="formcabang" method="post">
        <div class="modal-body step step-1 form">
          <div class="form-group">
        	  <label class="control-label col-md-3">Nama Cabang</label>
        	  <div class="col-md-9">
        		<input name="nama_cabang" id="name" placeholder="Masukkan nama cabang" class="form-control" title="Minimal 5 karakter. Hanya huruf, angka dan karakter spesial(petik atas, titik, spasi, strip)" pattern="^[A-Za-z0-9.' -]{5,30}$" type="text" minlength="5" maxlength="30" autocomplete="off" required>
        	  </div>
        	</div>
        	<div class="form-group">
        	  <label class="control-label col-md-3">Email</label>
        	  <div class="col-md-9">
        		<input name="email" id="email2" placeholder="Masukkan email" class="form-control" title="Email harus valid" maxlength="30"  type="email" autocomplete="off" required>

        	  </div>
        	</div>
        	<div class="form-group">
        	  <label class="control-label col-md-3">Telepon</label>
        	  <div class="col-md-9">
        		<input name="telepon" id="telfon" placeholder="Masukkan nomor telp." class="form-control" title="Minimal 10 karakter. Hanya angka." pattern="^[0-9]{10,13}$" type="text" minlength="10" maxlength="13" autocomplete="off" required>

        	  </div>
        	</div>
        	<div class="form-group">
        	  <label class="control-label col-md-3">Alamat Cabang</label>
        	  <div class="col-md-9">
        		<textarea name="alamat" id="alamat" placeholder="Masukkan alamat" class="form-control" autocomplete="off" required></textarea>
        	  </div>
        	</div>
        </div>

        <div class="modal-body step step-2 form">
          <div class="form-group">
          <label class="control-label col-md-3">Username</label>
          <div class="col-md-9">
            <input name="user" id="users" placeholder="Username tidak boleh sama dengan yg lain" class="form-control" title="Minimal 5 karakter. Hanya huruf, angka dan titik" pattern="^[a-zA-Z][a-zA-Z0-9.]{4,15}$" minlength="5" maxlength="15" type="text" autocomplete="off" required>
          </div>
          </div>
          <div class="form-group">
          <label class="control-label col-md-3">Password</label>
          <div class="col-md-9">
          		  <input name="access_password" id="passw" placeholder="Masukkan password" class="form-control" title="Password minimal 8 karakter, minimal 1 Uppercase, dan 1 angka" type="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" minlength="8" maxlength="30" autocomplete="off" required>
          </div>
          </div>
          <div class="form-group">
          <label class="control-label col-md-3">Ip Address</label>
          <div class="col-md-9">
          		  <input name="ip_address" id="ip" placeholder="Format ipv4" title="Format ipv4" class="form-control" type="text" autocomplete="off" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$" required>
          </div>
          </div>
          <div class="form-group">
          <label class="control-label col-md-3">API Key</label>
          <div class="col-md-9">
          		  <input name="api" id="api" placeholder="Klik generate API Key untuk mendapatkan API Key" class="form-control readonly"  type="text" required>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default step step-1 pull-left" data-step="1" onclick="sendEvent()">Selanjutnya</button>
          <button type="button" class="btn btn-default step step-2 pull-left" data-step="2" onclick="sendEvent2()">Sebelumnya</button>
          <a class="btn btn-default btn-sm" onclick="generateAPI()"><span class="fa fa-key"></span> Generate API Key</a>
          <input type="submit" id="btnSave" value="Simpan" class="btn btn-default"/>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!-- End Bootstrap modal -->

  <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_petugas" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 class="modal-title2"></h3>
    </div>
      <form action="#" id="form_petugas" class="form-horizontal">
        <div class="modal-body form">
        <input type="hidden" value="" name="barang"/>
        <div class="form-body" id="form-body">
          <div class="form-group">
            <label class="control-label col-md-3">Nama Petugas</label>
            <div class="col-md-9">
              <input name="nama_petugas" id="namapetugas" placeholder="Nama lengkap petugas" class="form-control" type="text" title="Minimal 3 karakter. Hanya huruf, angka dan karakter spesial (petik atas, titik, spasi, strip)" pattern="^[A-Za-z0-9.' -]{3,30}$" type="text" minlength="3" maxlength="30" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">Username</label>
            <div class="col-md-9">
              <input name="user" id="username" placeholder="Nama lengkap petugas" class="form-control" type="text" title="Minimal 5 karakter. Hanya huruf, angka dan titik" pattern="^[a-zA-Z][a-zA-Z0-9.]{4,15}$" minlength="5" maxlength="15" type="text" autocomplete="off" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">Email</label>
            <div class="col-md-9">
              <input name="email" id="email" placeholder="Email petugas" class="form-control" type="email" maxlength="30" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">Password</label>
            <div class="col-md-9">
              <input name="pass_petugas" id="password" placeholder="Password harus blablabla" class="form-control" type="password" title="Password minimal 8 karakter, minimal 1 Uppercase, dan 1 angka" type="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" minlength="8" maxlength="30" autocomplete="off" required>
            </div>
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" id="id_cabang" name="id_cabang"/>
          <input type="submit" id="btnSave2" value="Simpan" class="btn btn-default"/>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!-- End Bootstrap modal -->

    <!-- jQuery -->
    <script src="<?php echo base_url('vendors/jquery/dist/jquery.step.js'); ?>"></script>
	   <!-- Datatables -->
    <script src="<?php echo base_url('vendors/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/datatables.net-scroller/js/dataTables.scroller.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/jszip/dist/jszip.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/pdfmake/build/pdfmake.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendors/pdfmake/build/vfs_fonts.js'); ?>"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('build/js/custom.min.js'); ?>"></script>
	<script>
  sendEvent = function() {
      $('#modal_form').trigger('next.m.2');
  }
  sendEvent2 = function() {
      $('#modal_form').trigger('next.m.1');
  }
  var flag =1;
	$('#myTable,#myTable1 ').DataTable({
    responsive:false
  });
	$('.edit').on('dblclick', function(){
	var ok = 0;
	var id = $(this).closest('tr').prop('id');
	var kolom = $(this).attr('id');
	var teks = $(this).html();
	var $this = $(this);
	var $input = $('<input>', {
		value: $this.text(),
    id:'input'+kolom,
		type: 'text',
		blur: function() {
      clearSelection();
		   if (ok == 1)
		   {
			$this.text(this.value);
			}
			else{
				$this.text(teks);
				alert('Data belum tersimpan, tekan Enter untuk menyimpan');
			}
		},
		keyup: function(e){
			if((e.keyCode) === 13){
				if (confirm('Apa anda yakin ingin menyimpannya?')){
          if(flag==1){
            ok = 1;
            e.preventDefault();
            var value = $input.val();
            $.ajax({
              type: "POST",
              url:'<?php echo site_url('cabang/editsimpan')?>',
              data: {
                'id':id,
                'isi':value,
                'kolom':kolom,
                'tabel':'cabang'
              },
              success: function(response){
                alert(response);
              },
            });
          }
          else{
            alert('Minimal 5 dan maksimal 30 karakter. \nHanya huruf, angka dan karakter spesial(petik atas, titik, spasi, strip).');
          }
				}
			}
		}
	}).appendTo( $this.empty() ).focus();
	});
  $(document).ready(function() {
    $(document).on('input', 'input#inputnama', function(){
      var value = $(this).val();
      var patt = new RegExp("^[A-Za-z0-9.' -]{5,30}$");
      var valid = patt.test(value);
      if(valid){$(this).removeClass("invalid").addClass("valid"); flag=1;}
	       else{$(this).removeClass("valid").addClass("invalid"); flag=0;}
    });
  });
	 function tambah()
    {
      $(".readonly").keydown(function(e){
        e.preventDefault();
      });
      $('#form')[0].reset();
      $('#modal_form').modal('show');
    }
    function tambahpetugas()
    {
      var e = document.getElementById('pil');
      var value = e.options[e.selectedIndex].value;
      var teks = e.options[e.selectedIndex].innerHTML;
      document.getElementById('id_cabang').value = value;
      $('#form_petugas')[0].reset();
      $('#modal_form_petugas').modal('show');
      $('.modal-title2').text('Tambah petugas di '+teks);
    }
    $('#form').submit(function(e){
      $.ajax({
        url : '<?php echo site_url('cabang/simpancabang');?>',
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(response)
        {
        $('#modal_form').modal('hide');
        alert('Berhasil menambahkan cabang');
        location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        alert('Gagal menambahkan cabang \n'+textStatus+' : '+errorThrown);
        }
      });
      e.preventDefault();
    });
    $('#form_petugas').submit(function(e){
      $.ajax({
        url : '<?php echo site_url('cabang/simpanpetugas')?>',
        type: "POST",
        data: $('#form_petugas').serialize(),
        dataType: "JSON",
        success: function(response)
        {
           $('#modal_form_petugas').modal('hide');
           alert('Berhasil menambahkan petugas');
           location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Gagal menambahkan petugas \n'+textStatus+' : '+errorThrown);
        }
      });
      e.preventDefault();
    });
    $(document).ready(function(){
      $(document).on('click', '.delete', function(){
        var tabel = $(this).closest('td').attr('name');
        var id = $(this).attr('id');
        if(confirm('Apa anda yakin akan menghapus data ini?'))
        {
          $.ajax({
            url : "<?php echo site_url('cabang/hapus')?>/"+id,
            type: "POST",
            data : {'tabel' : tabel},
            dataType: "JSON",
            success: function(data)
            {
               alert(data.pesan);
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal menghapus data'+'\n'+textStatus+' : '+errorThrown);
            }
          });
        }
      });
    });
  function clearSelection() {
    if(document.selection && document.selection.empty) {
        document.selection.empty();
    } else if(window.getSelection) {
        var sel = window.getSelection();
        sel.removeAllRanges();
    }
  }
  function generateAPI()
  {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 16; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));
    document.getElementById('api').value = text;
  }
  function lihatpetugas(id){
    if(id!=0){
      document.getElementById('tombol').setAttribute('class','btn btn-default btn-sm');
    }
    else{
      document.getElementById('tombol').setAttribute('class','btn btn-default btn-sm disabled');
    }
    $.get({
      url : '<?php echo site_url('cabang/tampilpetugas/');?>'+id,
      success : function(data){
        $('#myTable1').DataTable().destroy();
        $('#myTable1 tbody').html(data);
        $(document).ready(function() {
          $('#myTable1').DataTable({
            responsive:false
          });
        } );
      }
    });
  }
	</script>
</body>
<?php
include 'footer.html'
?>
</html>
