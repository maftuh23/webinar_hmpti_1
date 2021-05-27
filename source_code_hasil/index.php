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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
} elseif(isset($_POST['simpan'])){
    $nama_barang 		= $_POST['nama_barang'];
    $jumlah_barang 		= $_POST['jumlah_barang'];
    $harga_barang 		= $_POST['harga_barang'];
    $tgl_input 		    = $_POST['tgl_input'];

    $query = mysqli_query($conn,"INSERT INTO tbl_barang (nama_barang ,jumlah_barang, harga_barang, tgl_input) 
                        VALUES ('$nama_barang', '$jumlah_barang', '$harga_barang', '$tgl_input')");
    
    if ($query) {
      echo "<script>alert('Data Barang Berhasil disimpan!'); window.location = 'index.php'</script>";	   
    } else {
      echo "<script>alert('Data Barang Gagal disimpan!'); window.location = 'index.php'</script>";	   
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
                    <h3 class="card-title">Data Barang</h3> &nbsp <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambah_barang">Tambah Barang</button>
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
                        <td><?=  format_rupiah($data['harga_barang']) ?></td> 
                        <td><?= tanggal_indo($data['tgl_input'], FALSE, TRUE) ?></td> 
                        <td>
                            <button class="waves-effect waves-light btn"><i class="fa fa-edit text-yellow" data-toggle="modal" data-target="#edit_barang<?= $data['id_barang'] ?>"></i> Edit</button>
                            <a href="index.php?id=<?= $data['id_barang'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" class="waves-effect waves-light btn"><i class="fa fa-trash text-red"></i> Hapus</a>
                        </td>
                    </tr>  
                    <!-- Modal -->
                    <div id="edit_barang<?= $data['id_barang'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Data barang</h4>
                          </div>
                          <form action="index.php" method="POST">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Nama Barang</label>
                                      <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?= $data['nama_barang'] ?>" placeholder="Masukkan Nama Barang">
                                  </div>
                                  <div class="form-group">
                                      <label>Harga Barang</label>
                                      <input type="number" class="form-control" name="harga_barang" id="harga_barang" placeholder="Masukkan Jumlah Barang">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Jumlah Barang</label>
                                      <input type="number" class="form-control" name="jumlah_barang" id="jumlah_barang" placeholder="Masukkan Jumlah Barang">
                                  </div>
                                  <div class="form-group">
                                      <label>Tanggal Input Barang</label>
                                      <input type="date" class="form-control" name="tgl_input" id="tgl_input" placeholder="Masukkan Tanggal Input Barang">
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                          </div>
                          </form>
                        </div>

                      </div>
                    </div>
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

<!-- Modal -->
<div id="tambah_barang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data barang</h4>
      </div>
      <form action="index.php" method="POST">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label>Nama Barang</label>
                  <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Masukkan Nama Barang">
              </div>
              <div class="form-group">
                  <label>Harga Barang</label>
                  <input type="number" class="form-control" name="harga_barang" id="harga_barang" placeholder="Masukkan Jumlah Barang">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                  <label>Jumlah Barang</label>
                  <input type="number" class="form-control" name="jumlah_barang" id="jumlah_barang" placeholder="Masukkan Jumlah Barang">
              </div>
              <div class="form-group">
                  <label>Tanggal Input Barang</label>
                  <input type="date" class="form-control" name="tgl_input" id="tgl_input" placeholder="Masukkan Tanggal Input Barang">
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>

  </div>
</div>

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
