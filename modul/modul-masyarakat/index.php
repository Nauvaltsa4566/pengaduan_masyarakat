<?php include('../../config/database.php');
include('../../assets/header.php'); 
@session_start();

if(isset($_POST['daftar'])){
  @session_start();
  $nik = $_POST['nik'];
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $telp = $_POST['telp'];

  $u = mysqli_query($con, "SELECT * from masyarakat WHERE username='$username'");
  $r = mysqli_num_rows($u);
  if($r == 1){
      ?> 
          <div class="alert alert-danger" role="alert">
              Username Telah Digunakan ! Coba Gunakan Username Lainnya
          </div>
      <?php
  }else{
      $q = mysqli_query($con, "INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`, verif) VALUES ('$nik', '$nama', '$username', '$password', '$telp', 1);");
  ?> 
      <div class="alert alert-success" role="alert">
          Anda Telah Berhasil Mendaftar Mendaftarkan Warga !
      </div>
  <?php
  }
  
}

if(isset($_POST['hapus'])){
  $nik = $_POST['nik'];
  $q = mysqli_query($con, "DELETE FROM masyarakat WHERE nik = '$nik'");
}

if(isset($_POST['perbarui'])){
  $nik = $_POST['nik-update'];
  $nama = $_POST['nama-update'];
  $username = $_POST['username-update'];
  $password = $_POST['password-update'];
  $telp = $_POST['telp-update'];

  $u = mysqli_query($con, "SELECT * from masyarakat WHERE username='$username'");
  $r = mysqli_num_rows($u);
  if($r == 1){
      ?> 
          <div class="alert alert-danger" role="alert">
              Username Telah Digunakan ! Coba Gunakan Username Lainnya
          </div>
      <?php
  }else{
      $q = mysqli_query($con, "UPDATE masyarakat SET nama = '$nama', username = '$username', password = '$password', telp = '$telp' WHERE nik = '$nik'");
  ?> 
      <div class="alert alert-success" role="alert">
          Anda Telah Berhasil Memperbarui Data !
      </div>
  <?php
  }


  


}
?>
<body>
<?php
  include('../../assets/menu.php')
?>

</aside>
<main id="main" class="main">
<div class="card-header">
        <p class="fs-4 fw-bold"><i class="bi bi-layout-text-sidebar-reverse"></i> masyarakat</p>
    </div>
    <div class="card-header">
    <div id="dataTablesNya_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="dt-buttons btn-group flex-wrap">   
                    <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="dataTablesNya" type="button"><span>Excel</span></button> 
                    <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="dataTablesNya" type="button"><span>PDF</span></button> 
                    <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="dataTablesNya" type="button"><span>Print</span></button> 
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div id="dataTablesNya_filter" class="dataTables_filter">
                    <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTablesNya">
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table id="dataTablesNya" class="table table-bordered table-striped dataTable no-footer dtr-inline collapsed" aria-describedby="dataTablesNya_info">
    </table>
</div>
</div>
</div>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">NIK</th>
      <th scope="col">Nama</th>
      <th scope="col">Username</th>
      <th scope="col">Telp</th>
      <th colspan="2">Tindakan</th>
    </tr>
  </thead>
  <tbody>
        <?php 
        include('../../config/database.php');
        $q = mysqli_query($con, "SELECT * FROM masyarakat WHERE verif = '1'");
        while($m = mysqli_fetch_object($q)){
            ?>
                <tr>
                    <td><?= $m -> nik ?></td>
                    <td><?= $m -> nama ?></td>
                    <td><?= $m -> username ?></td>
                    <td><?= $m -> telp ?></td>
                    <?php 
                        if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas'){
                            ?> 
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="nik" value="<?= $m -> nik ?>">
                                        <button name="hapus" id="hapus" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                                <td> 
                                    <form action="" method="POST">
                                        <input type="hidden" name="nik" value="<?= $m -> nik ?>">
                                        <a name="edit" href="#update" id="edit" class="btn btn-success">Edit</a>
                                    </form>
                                </td>
                            <?php
                        }
                    ?>
                    
                </tr> 
            <?php
        }
        ?>
  </tbody>
</table>
      </div>

    </div>
  </div>
</section>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="masyarakat.php">Previous</a></li>
    <li class="page-item"><a class="page-link" href="pengaduan.php">1</a></li>
    <li class="page-item"><a class="page-link" href="petugas.php">2</a></li>
    <li class="page-item"><a class="page-link" href="tanggapan.php">Next</a></li>
  </ul>
</nav>
<?php 
            @session_start();
            if($_SESSION['level'] == 'petugas' || $_SESSION['level'] == 'admin'){
                ?> 
                    <div class="card-footer">
                        <h5 class="fw-bold mb-5">.: Tambahkan Warga :.</h5>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK Berdasarkan KTP" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Berdasarkan KTP" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Pilih Username yang Belum Digunakan" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Pilih Password yang Aman" required>
                            </div>
                            <div class="mb-3">
                                <label for="telp" class="form-label">Nomor Telpon</label>
                                <input type="number" class="form-control" id="telp" name="telp" placeholder="Nomor HP Aktif">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn w-100 text-white" name="daftar" id="daftar" style="background-color: green;">Daftar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <h5 class="fw-bold mb-5" id="update">.: Perbarui Data Warga :.</h5>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nik-update" class="form-label">Pilih data yang ingin dirubah berdasarkan NIK</label>
                                <select name="nik-update" class="form-select" aria-label="Default select example">
                                    <?php
                                        include('../../configuration/koneksi.php'); 
                                        $q = mysqli_query($con, "SELECT * FROM masyarakat WHERE verif = '1'");
                                        while($o = mysqli_fetch_object($q)){
                                            ?> 
                                                <option value="<?= $o -> nik ?>"><?= $o -> nik ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama-update" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama-update" name="nama-update" placeholder="Nama Berdasarkan KTP" required>
                            </div>
                            <div class="mb-3">
                                <label for="username-update" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username-update" name="username-update" placeholder="Pilih Username yang Belum Digunakan" required>
                            </div>
                            <div class="mb-3">
                                <label for="password-update" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password-update" name="password-update" placeholder="Pilih Password yang Aman" required>
                            </div>
                            <div class="mb-3">
                                <label for="telp-update" class="form-label">Nomor Telpon</label>
                                <input type="number" class="form-control" id="telp-update" name="telp-update" placeholder="Nomor HP Aktif">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                  <form action="" method="post">
                                    <button class="btn w-100 text-white" name="perbarui" id="perbarui" style="background-color: green;">Perbarui</button>
                                  </form>
                                  </div>
                            </div>
                        </form>
                    </div>
                <?php
            }
            ?>
</main>

  <footer id="footer" class="footer">
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php 
  include('../../assets/footer.php');
  ?>

</body>

</html>