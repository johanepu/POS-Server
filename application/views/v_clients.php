
<?php include 'header.php'  ?>
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
                 <h3>Database <small>Barang Cabang</small></h3>
               </div>

             </div>
 			<div class="clearfix"></div>

 			<div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="x_panel">
             <div class="x_title">
               <h2>Silahkan Pilih Cabang :</h2>
                 <a class="btn btn-default btn-sm  disabled tom" id="tombol"><span class="fa fa-plus"></span> Tambah Barang</a>
                 					<div class="col-md-8 col-sm-8 col-xs-6">
                 					<select id="cab" class="form-control input-sm pil" onchange="javascript:lihatbarang(this.value)">
                 						<option value="0" selected>--Pilih--</option>
                 						<?php foreach($cabang as $c){?>
                 						<option value="<?php echo $c->id_cabang?>"><?php echo $c->nama_cabang?></option>
                 						<?php }?>
                 					</select>
                      </div>

                             <div class="clearfix"></div>
                           </div>
                           <div class="x_content">
                             <table id="barang_client" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                               <thead>
                                 <tr>
                                   <th>No. </th>
                                   <th>ID Barang</th>
                                   <th>Nama Barang</th>
                                   <th>Harga</th>
                                   <th>Stok</th>
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




      <!-- Bootstrap modal -->
        <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"></h3>
            </div>
            <form action="#" id="form" class="form-horizontal">
              <div class="modal-body form">
                <input type="hidden" value="" name="id_cabang" id="id_cabang"/>
                <div class="form-body" id="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3">Deskripsi</label>
                    <div class="col-md-9">
                      <input name="desk" id="" placeholder="Keterangan transaksi" class="form-control" type="text" maxlength="50" autocomplete="off">
                    </div>
                  </div>
                  <div class="input" id="1000">
                    <div class="form-group">
                      <label class="control-label col-md-3">Nama Barang</label>
                      <div class="col-md-7">
                        <select name="pil[]" class="form-control pilbarang" onchange="" required>
                          <option value="" selected>--Pilih--</option>
                          <?php foreach($barang as $d){?>
                          <option value="<?php echo $d->id_barang?>"><?php echo $d->nama_barang?></option>
                          <?php }?>
                        </select>
                        <input type="hidden" name="nama[]" value="" class="nama">
                      </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Jumlah</label>
                        <div class="col-md-3">
                          <input name="jml[]" id="jml" placeholder="Jumlah produk" class="form-control" type="text"  title="Hanya angka diperbolehkan" pattern="^[1-9][0-9]{0,11}$" maxlength="11" autocomplete="off" required>
                        </div>
                        <label class="control-label col-md-1" style="padding-left:3px">Harga</label>
                        <div class="col-md-3 colharga">
                          <input name="harga_barang[]" id="harga_barang" placeholder="Harga barang" class="form-control harga" type="text" disabled>
                        </div>
                        <div class="col-md-1">
                          <a class="btn btn-primary btn-sm plus" id="2000" onclick=""><i class="fa fa-plus"></i></a>
                        </div>
                      </div>
                  </div>
                </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" id="btnSave" class="btn btn-default" value="Simpan">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
              </form>
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

var flag =1;
 var pesan;
 //init datatable
  $('#barang_client').dataTable({
    responsive:false
  });

 //tampil barang
	function lihatbarang(id){
		if(id!=0){
			document.getElementById('tombol').setAttribute('class','btn btn-default btn-sm');
		}
		else{
			document.getElementById('tombol').setAttribute('class','btn btn-default btn-sm disabled');
		}
		$.get({
			url : '<?php echo site_url('Clients/tampilbarang/');?>'+id,
			success : function(data){
				$('#barang_client').DataTable().destroy();
				$('#barang_client tbody').html(data);
				$(document).ready(function() {
					$('#barang_client').DataTable({
            responsive:false
          });
				});
			}
		});
	}



 //show modal tambah produk
	 $(function(){
     $('.tom').click( function(){
       var e = $(this).closest('div.x_title').find('select.pil');
       var value = e.children('option').filter(':selected').val();
       var teks = e.children('option').filter(':selected').text();
       document.getElementById('id_cabang').value = value;
       $('#form')[0].reset();
       $('input.harga').removeAttr('value');
       $('input.harga').attr('disabled','disabled');
       $('#modal_form').modal('show');
       $('.modal-title').text('Tambah barang di '+teks);
    });
  });
 //simpan tambah produk
 $('#form').submit(function (e){
   $.ajax({
     url : '<?php echo site_url('clients/simpanbarang/');?>',
     type: "POST",
     data: $('#form').serialize(),
     dataType: "JSON",
     success: function(response){
       $('#modal_form').modal('hide');
       alert(response.pesan);
       location.reload();
     },
     error: function (jqXHR, textStatus, errorThrown){
       alert(textStatus + ' ' + errorThrown);
     }
   });
   e.preventDefault();
 })




  //   //tambah elemen input stok
  // $(document).on('click', 'a.plus' ,function(){
  //     var id = $(this).attr('id');
  //     var ids = parseInt(id);
  //     var idbaru = ids+1;
  //     var idminus = idbaru*2; var idminus2 = idminus-2;
  //     var id2 = parseInt($(this).closest('div.input').prop('id'));
  //     var idsbaru = id2+1;
  //       $("#form-body").append('<div class="input" id="'+idsbaru+'"><div class="form-group hidden hilang"><label class="control-label col-md-3">Id Barang</label>'
  //     +'<div class="col-md-9"><input placeholder="Id barang harus unik" class="form-control inputid" type="text"></div></div>'
  //     +'<div class="form-group"><label class="control-label col-md-3">Nama Barang</label><div class="col-md-9">'
  //     +'<input type="text" name="nama[]" value="" placeholder="Masukkan nama barang" class="form-control barang" autocomplete="on">'
  //     +'<input type="hidden" name="pil[]" value="" class="isiid"><div class="daftarbarang" id="daftarbarang"></div></div></div>'
  //     +'<div class="form-group"><label class="control-label col-md-3" style="padding-left:3px">Harga</label><div class="col-md-9"><input name="harga[]" id="harga" placeholder="Masukkan harga barang" class="form-control" type="text"></div></div>'
  //     +'<div class="form-group"><label class="control-label col-md-3">Jumlah</label><div class="col-md-9"><input name="jml[]" id="jml" placeholder="Masukkan jumlah persediaan barang" class="form-control" type="text"></div></div>'
  //     // +'<div class="form-group"><label class="control-label col-md-3">Tanggal Masuk</label><div class="col-md-5"><input name="tanggal[]" id="tgl" placeholder="Masukkan tanggal masuk" class="form-control" type="datetime-local"></div>'
  //     +'<div class="col-md-1"><a class="btn btn-primary btn-sm plus" id="'+idbaru+'"><i class="fa fa-plus"></i></a></div>'
  //     +'<div class="col-md-1"><a class="btn btn-danger btn-sm minus" id="'+idminus+'"><i class="fa fa-minus"></i></a></div></div></div>');
  //      $('#'+id).attr('class','btn btn-primary btn-sm plus hidden');
  //      $('#'+idminus2).attr('class','btn btn-primary btn-sm minus hidden');
  // });
  //
  // //hapus elemen input tambah stok barang
  // $(document).on('click','a.minus', function(){
  //   var id = $(this).attr('id');
  //   var ids = parseInt(id); ids2 = ids-2;
  //   var idbaru = ids/2; idbaru = idbaru-1;
  //   var id2 = $(this).closest('div.input').prop('id');
  //   $('#'+id2).remove();
  //   $('#'+idbaru).attr('class','btn btn-primary btn-sm plus');
  //   $('#'+ids2).attr('class','btn btn-danger btn-sm minus');
  // });

  //add input elemen tambah produk
    $(document).on('click', 'a.plus' ,function(){
        var id = $(this).attr('id');
        var ids = parseInt(id);
        var idbaru = ids+1;
        var idminus = idbaru*2; var idminus2 = idminus-2;
        var id2 = parseInt($(this).closest('div.input').prop('id'));
        var idsbaru = id2+1;
        $("#form-body").append('<div class="input" id="'+idsbaru+'"><div class="form-group"><label class="control-label col-md-3">Nama Barang</label><div class="col-md-7">'
        +'<select name="pil[]" class="form-control pilbarang" onchange="" required><option value="" selected>--Pilih--</option><?php foreach($barang as $d){?>'
        +'<option value="<?php echo $d->id_barang?>"><?php echo $d->nama_barang?></option><?php }?></select><input type="hidden" name="nama[]" value="" class="nama"></div></div>'
        +'<div class="form-group"><label class="control-label col-md-3">Jumlah</label><div class="col-md-3"><input name="jml[]" id="jml" placeholder="Jumlah produk" class="form-control" type="text" title="Hanya angka diperbolehkan" pattern="^[1-9][0-9]{0,11}$" maxlength="11" autocomplete="off" required></div>'
        +'<label class="control-label col-md-1" style="padding-left:3px">Harga</label><div class="col-md-3 colharga"><input name="harga_barang[]" id="harga_barang" placeholder="Harga barang" class="form-control" type="text" disabled></div>'
        +'<div class="col-md-1"><a class="btn btn-primary btn-sm plus" id="'+idbaru+'"><i class="fa fa-plus"></i></a></div>'
        +'<div class="col-md-1"><a class="btn btn-danger btn-sm minus" id="'+idminus+'"><i class="fa fa-minus"></i></a></div></div></div>');
         $('#'+id).attr('class','btn btn-primary btn-sm plus hidden');
         $('#'+idminus2).attr('class','btn btn-primary btn-sm minus hidden');
    });
    //hapus elemen input tambah stok barang
     $(document).on('click','a.minus', function(){
       var id = $(this).attr('id');
       var ids = parseInt(id); ids2 = ids-2;
       var idbaru = ids/2; idbaru = idbaru-1;
       var id2 = $(this).closest('div.input').prop('id');
       $('#'+id2).remove();
       $('#'+idbaru).attr('class','btn btn-primary btn-sm plus');
       $('#'+ids2).attr('class','btn btn-danger btn-sm minus');
     });



  //show modal tambah stok
      function tambahstok()
      {
        //document.getElementById('btnSave2').setAttribute('class','btn btn-default disabled');
        $('#form')[0].reset();
        $('div.daftarbarang').html('');
        $('div.hilang').attr('class','form-group hidden hilang');
        $('#tambah_barag').modal('show');
        $('.modal-title').text('Tambah Stok Bahan');
      }

    //edit dobel klik
	$(document).on('dblclick', '.edit', function() {
    var ok = 0;
    	var id = $(this).closest('tr').find('td.id_barang').text();
      var where = $(this).closest('tr').find('td.id_barang').prop('id');
      var tabel = $(this).closest('tr').attr('name');
  var kolom = $(this).attr('id');
  var teks = $(this).html();
  var $this = $(this);
  var isian = $this.text();
  var idcabang = $('#cab').children('option').filter(':selected').val();

   isian = isian.replace('Rp. ','');
   var $input = $('<input>', {
     value: isian,
     id: 'input'+kolom,
     type: 'text',
     blur: function() {
       clearSelection();
        if (ok == 1)
        { if(kolom == 'harga_barang'){
         $this.text('Rp. '+this.value);
        }else{
         $this.text(this.value);
        }
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
               url:'<?php echo site_url('clients/editsimpan')?>',
               data: {
                 'id':id,
                 'isi':value,
                 'kolom':kolom,
                 'tabel':tabel,
                 'where':where,
                 'id_cabang':idcabang
               },
               success: function(response){
                 alert(response);
               },
             });
           }
           else{
             alert(pesan);
           }
         }
       }
     }
   }).appendTo( $this.empty() ).focus();
   });

  //search autocomplete
      $(document).ready(function(){
        $(document).on('keyup','.barang', function(){
          var idroot = $(this).closest('div.input').prop('id');
          var barang = $(this).val();
          if(barang != ''){
            $.post({
              url:'<?php echo site_url('Barang/search/') ?>',
              data : {'nama' : barang},
              success:function(data) {
                $('#'+idroot+' div.daftarbarang').fadeIn();
                $('#'+idroot+' div.daftarbarang').html(data);
              }
            });
          }
        });
        $(document).ready(function(){
          $(document).on('click', '#daftarbarang ul li', function(){
          var name = $(this).attr('name');
          var harga_barang = $(this).attr('harga_barang');
          var id = $(this).attr('id');
          var idroot = $(this).closest('div.input').prop('id');
          if(name == 'baru'){
            $('#'+idroot+' input.barang').val(id);
            $('#'+idroot+' div.hilang').attr('class','form-group hilang');
            $('#'+idroot+' input.isiid').removeAttr('name');
            $('#'+idroot+' input.inputid').attr('name','pil[]');
            $('#'+idroot+' div.daftarbarang').fadeOut();
          }else{
            $('#'+idroot+' input.barang').val($(this).text());
            $('#'+idroot+' input.inputid').removeAttr('name');
            $('#'+idroot+' input.isiid').attr('name','pil[]');
            $('#'+idroot+' input.isiid').val(id);
            // $('#'+idroot+' input.hargalama').attr('harga','pil[]');
            // $('#'+idroot+' input.hargalama').val(harga_barang);
            $('#'+idroot+' div.hilang').attr('class','form-group hilang hidden');
            $('#'+idroot+' div.daftarbarang').fadeOut();
          }
          });
        });
      });

      //remove selection
         function clearSelection() {
           if(document.selection && document.selection.empty) {
               document.selection.empty();
           } else if(window.getSelection) {
               var sel = window.getSelection();
               sel.removeAllRanges();
           }
         }
         //hapus data barang
         	$(function() {
             $(document).on('click','.hapus', function(){
               var tabel = $(this).closest('tr').attr('name');
               var id = $(this).attr('name');
               if(confirm('Apa anda yakin akan menghapus data ini?'))
               {
                 // ajax delete data from database
                   $.ajax({
                     url : "<?php echo site_url('Clients/hapus/')?>"+id,
                     type: "POST",
                     data:{
                       'tabel' : tabel
                     },
                     dataType: "JSON",
                     success: function(data)
                     {
                        alert('Data berhasil dihapus');
                        location.reload();
                     },
                     error: function (jqXHR, textStatus, errorThrown)
                     {
                         alert('Gagal menghapus data. Barang masih digunakan di produk');
                     }
                 });
               }
             });
         	});

          //harga otomatis
              $(document).ready(function(){
                $(document).on('change', '.pilbarang', function(){
                  var idroot = $(this).closest('div.input').prop('id');
                  var id = $(this).val();
                  var nama = $(this).children("option").filter(":selected").text();
                  $('#'+idroot+' input.nama').val(nama);
                  $.get({
                    url : '<?php echo site_url('clients/hargabarang/') ?>'+id,
                    dataType:'json',
                    success: function(data){
                      $('#'+idroot+' div.colharga').html(data);
                    }
                  });
                });
              });

         //hapus barang dan produk
         	 $(document).ready(function(){
              $(document).on('click', '.delete', function(){
                var tabel = $(this).closest('td').attr('name');
                var id = $(this).attr('id');
                if(confirm('Apa anda yakin akan menghapus data ini?'))
                {
                  $.ajax({
                    url : "<?php echo site_url('barang/hapus')?>/"+id,
                    type: "POST",
                    data : {'tabel' : tabel},
                    dataType: "JSON",
                    success: function(data)
                    {
                       alert('Data berhasil dihapus');
                       location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Gagal menghapus data. Barang masih digunakan di produk');
                    }
                  });
                }
              });
            });
	</script>
</body>
<?php include 'footer.php' ?>
</html>
