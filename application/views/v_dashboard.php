<?php include 'header.php'  ?>
<!DOCTYPE html>
<html lang="en">
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
  <!-- page content -->
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row tile_count">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Petugas</span>
      <div class="count"><?php echo $jml1 ;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Total Jenis Barang</span>
      <div class="count"><?php echo $jml2 ;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Barang Keluar Hari Ini</span>
      <div class="count green"><?php echo $jml3 ;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Cabang</span>
      <div class="count"><?php echo $jml4 ;?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Barang Masuk Hari ini</span>
      <div class="count red"><?php echo $jml5 ;?></div>
    </div>

  </div>
  <!-- /top tiles -->

      </div>
    </div>
  </div>

<!-- /page content -->
</div>
</div>
</body>
</html>
<?php include 'footer.php' ?>
