<?php
include ("conn.php");
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
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
</head>
<?php
if(isset($_GET['id'])){
    $id_barang = $_GET['id'];

    $query = mysqli_query($conn,"DELETE FROM tbl_barang where id_barang='$id_barang'") or die(mysql_error());
    
    if ($query) {
      echo "<script>alert('Berhasil Hapus Data Barang!'); window.location = 'index.php'</script>";	   
    } else {
      echo "<script>alert('Gagal Hapus Data Barang!'); window.location = 'index.php'</script>";	   
    }
}
?>
<body class="hold-transition layout-fixed">
<div class="content-header">
  <!-- /.login-logo -->
  <h5 class="mb-2 text-center">CRUD Webinar</h5>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Barang</h3> &nbsp <a href="tambah_barang.php" class="btn btn-success btn-sm">Tambah Barang</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Harga Barang</th>
                        <th>Tanggal Input Barang</th>
                        <th>Tools</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $no=0;
                        $q = mysqli_query($conn,"SELECT *FROM tbl_barang ORDER BY id_barang DESC");
                            while($data=mysqli_fetch_array($q))
                        { 
                        $no++;
                    ?>
                    <tr>
                        <td><?= $no ?></td> 
                        <td><?= $data['nama_barang'] ?></td> 
                        <td><?= $data['jumlah_barang'] ?></td> 
                        <td><?=  "Rp." . number_format($data['harga_barang'], 0, "", ".") ?></td> 
                        <td><?= $data['tgl_input'] ?></td> 
                        <td>
                            <a href="edit_barang.php?id=<?= $data['id_barang'] ?>" class="waves-effect waves-light btn"><i class="fa fa-edit text-yellow"></i> Edit</a>
                            <a href="index.php?id=<?= $data['id_barang'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" class="waves-effect waves-light btn"><i class="fa fa-trash text-red"></i> Hapus</a>
                        </td>
                    </tr>  
                    <?php } ?>
                    </tbody>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>


<!-- Page specific script -->
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });
  });
</script>
</body>
</html>
