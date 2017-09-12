<?php include 'header.php'  ?>
<!DOCTYPE html>
<html lang="en">
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
  <!-- page content -->
  <!-- page content -->


  <div class="right_col" role="main">


      <div class="clearfix"></div>

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class = "col-md-2 col-sm-12"> <h2>Barang Masuk </h2> </div>


            <ul class="nav navbar-right panel_toolbox">
              <li> <a class="btn btn-default btn-sm" onclick="tambah()" id="tombol"><span class="fa fa-plus"></span> Tambah Barang</a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <p class="text-muted font-13 m-b-30">
                    Edit bisa dilakukan dengan melakukan double-click pada kolom yang hendak di ubah.
                  </p>

                  <table id="datatable-keytable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nomor</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Tanggal Masuk</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>


                    <tbody>
              <?php
              $no = 1;
              foreach($barang_masuk as $c){
              ?>
                          <tr id='<?php echo $c->id_barang;?>'>
                            <td><?php echo $no++?></td>
                            <td title="Double click to Edit and press Enter to Save"
                    class="edit" id="id_barang"><?php echo $c->id_barang?></td>
                            <td title="Double click to Edit and press Enter to Save"
                    class="edit" id="nama_barang"><?php echo $c->nama_barang?></td>
                            <td title="Double click to Edit and press Enter to Save"
                    class="edit" id="harga_barang"><?php echo $c->harga_barang?></td>
                            <td title="Double click to Edit and press Enter to Save"
                    class="edit" id="jumlah"><?php echo $c->jumlah?></td>
                            <td title="Double click to Edit and press Enter to Save"
                    class="edit" id="tanggal_masuk"><?php echo $c->tanggal_masuk?></td>
                            <td><button class="btn btn-danger btn-xs" onclick="hapus(<?php echo $c->id_barang;?>)">
                  <i class="fa fa-remove"></i></button></td>
                          </tr>
              <?php }?>


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 class="modal-title">Yoman</h3>
  </div>
  <div class="modal-body form">
    <form action="#" id="form" class="form-horizontal">
      <input type="hidden" value="" name="barang_masuk"/>
      <div class="form-body">
        <div class="form-group">
          <label class="control-label col-md-3">Id Barang</label>
          <div class="col-md-9">
            <input name="id_barang" id="1" placeholder="Masukkan id barang" class="form-control" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">Nama Barang</label>
          <div class="col-md-9">
            <input name="nama_barang" id="2" placeholder="Masukkan nama barang" class="form-control" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">Harga</label>
          <div class="col-md-9">
    <input name="harga_barang" id="3" placeholder="Masukkan harga barang" class="form-control" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">Jumlah</label>
          <div class="col-md-9">
    <input name="jumlah" id="4" placeholder="Masukkan jumlah persediaan barang" class="form-control" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">Tanggal Masuk</label>
          <div class="col-md-9">
    <input name="tanggal_masuk" id="5" placeholder="Masukkan tanggal masuk" class="form-control" type="datetime-local">
          </div>
        </div>
      </div>
    </form>
      </div>
      <div class="modal-footer">
        <a type="button" id="btnSave" class="btn btn-default">Tambah</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

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

<script>
  $('#barang_masuk').dataTables({
    responsive:true
  });
  function tambah()
    {
		document.getElementById('btnSave').setAttribute('onclick','simpan()');
		$('#form')[0].reset();
        $('#modal_form').modal('show');

    }

    function simpan()
    {
	 $.ajax({
		url : '<?php echo site_url('Barang_Masuk/simpanbarang');?>',
		type: "POST",
		data: $('#form').serialize(),
		dataType: "JSON",
		success: function(response)
		{
		   $('#modal_form').modal('hide');
		   alert('Berhasil menambahkan data');
		   location.reload();
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Gagal menambahkan data');
		}
	});
    }

	$('.edit').on('dblclick', function() {
  var ok = 0;
  var id = $(this).closest('tr').prop('id');
  var kolom = $(this).attr('id');
  var teks = $(this).html();
  var $this = $(this);
	var $input = $('<input>', {
		value: $this.text(),
		type: 'text',
    blur: function() {
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
				if (confirm('Are you sure you want to save this thing into the database?')){
          ok = 1;
          e.preventDefault();
					var value = $input.val();
					$.ajax({
						type: "POST",
						url:'<?php echo site_url('barang_masuk/editsimpan')?>',
						data: {
							'id':id,
							'isi':value,
              'kolom':kolom,
              'tabel':'barang_masuk'
						},
						success: function(response){
							alert(response);
						},
					});
				}
			}
		}
	}).appendTo( $this.empty() ).focus();
	});

  function hapus(id)
      {
        if(confirm('Apa anda yakin akan menghapus data ini?'))
        {
          // ajax delete data from database
            $.ajax({
              url : "<?php echo site_url('barang_masuk/hapus')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                 alert('Data berhasil dihapus');
                 location.reload();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Gagal menghapus data');
              }
          });

        }
      }

	</script>
</body>
<?php include 'footer.php' ?>
</html>
