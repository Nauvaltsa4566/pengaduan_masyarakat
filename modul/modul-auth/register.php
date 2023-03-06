<?php include('../../config/database.php');
include('../../assets/header.php');

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
      $q = mysqli_query($con, "INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`) VALUES ('$nik', '$nama', '$username', '$password', '$telp');");
  ?> 
      <div class="alert alert-success" role="alert">
          Anda Telah Berhasil Mendaftar, Silahkan Tunggu Verifikasi dari Petugas !
      </div>
  <?php
  }
  
}

?>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
              <a href="pages-register.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><i class="bi bi-rainbow"></i>PENGADUAN</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">DAFTAR JEPARI</h5>
                    <p class="text-center small"></p>
                  </div>

                  <form class="row g-3 " method="post">
                    <div class="col-12">
                      <label for="yourName" class="form-label">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Nik</label>
                      <input type="number" name="nik" class="form-control" id="nik" required>
                      <div class="invalid-feedback">Please enter a valid NIK!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">No Telp</label>
                      <input type="Number" name="telp" class="form-control" id="telp" required>
                      <div class="invalid-feedback">Please enter your No Telp!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="daftar">DAFTAR</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Sudah Punya Akun? <a href="index.php">Log in</a></p>
                    </div>
                  </form>
                </div>
               </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>