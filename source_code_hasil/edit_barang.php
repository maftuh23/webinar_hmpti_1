<?php
include ("conn.php");
$id_barang = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Webinar HMPTI | Effective CRUD (Simply your code optimize your time development)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
</head>
<?php
if(isset($_POST['edit'])){
    $nama_barang 		= $_POST['nama_barang'];
    $jumlah_barang 		= $_POST['jumlah_barang'];
    $harga_barang 		= $_POST['harga_barang'];
    $tgl_input 		    = $_POST['tgl_input'];

    $query = mysqli_query($conn,"UPDATE tbl_barang SET nama_barang='$nama_barang', jumlah_barang='$jumlah_barang', harga_barang='$harga_barang', tgl_input='$tgl_input'
								WHERE id_barang='$id_barang'") or die(mysql_error());
    
    if ($query) {
      echo "<script>alert('Data Barang Berhasil diedit!'); window.location = 'index.php'</script>";	   
    } else {
      echo "<script>alert('Data Barang Gagal diedit!'); window.location = 'index.php'</script>";	   
    }
}

$c = mysqli_fetch_array(mysqli_query($conn,"SELECT *FROM tbl_barang WHERE id_barang='$id_barang'"));

?>
<body class="hold-transition layout-fixed">
<div class="content-header">
  <!-- /.login-logo -->
  <h5 class="mb-2 text-center">CRUD Webinar</h5>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Edit Data Barang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="edit_barang.php?id=<?= $_GET['id'] ?>" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?= $c['nama_barang'] ?>" placeholder="Masukkan Nama Barang">
                            </div>
                            <div class="form-group">
                                <label>Harga Barang</label>
                                <input type="number" class="form-control" name="harga_barang" id="harga_barang" value="<?= $c['harga_barang'] ?>" placeholder="Masukkan Jumlah Barang">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah Barang</label>
                                <input type="number" class="form-control" name="jumlah_barang" id="jumlah_barang" value="<?= $c['jumlah_barang'] ?>" placeholder="Masukkan Jumlah Barang">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Input Barang</label>
                                <input type="date" class="form-control" name="tgl_input" id="tgl_input" value="<?= $c['tgl_input'] ?>" placeholder="Masukkan Tanggal Input Barang">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="edit" class="btn btn-success">Update</button>
                  <a href="index.php" class="btn btn-danger">Batal</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>
</html>
