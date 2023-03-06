<?php include('../../config/database.php');
include('../../assets/header.php');
if(isset($_POST['login'])){
    $pilihan = $_POST['pilihan'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if($pilihan == 'masyarakat'){
        $q = mysqli_query($con, "SELECT * from masyarakat WHERE username='$username' AND password='$password' AND verif = '1'");
        $r = mysqli_num_rows($q);
        if($r == 1){
            $o = mysqli_fetch_object($q);
            @session_start();
            $_SESSION['username'] = $o -> username;
            $_SESSION['password'] = $o -> password;
            $_SESSION['nik'] = $o -> nik;
            $_SESSION['nama'] = $o -> nama;
            $_SESSION['telp'] = $o -> telp;
            $_SESSION['level'] = $o -> level;
            @header('location:../modul-profile/');
        }else{ ?>
            <div class="alert alert-danger" role="alert">
                Data Salah atau belum diverifikasi !
            </div>
            <?php
        }
    }elseif($pilihan == 'petugas'){
        $q = mysqli_query($con, "SELECT * from petugas WHERE username='$username' AND password='$password'");
        $r = mysqli_num_rows($q);
        @session_start();
        if($r == 1){
            $o = mysqli_fetch_object($q);
            @session_start();
            $_SESSION['username'] = $o -> username;
            $_SESSION['password'] = $o -> password;
            $_SESSION['id_petugas'] = $o -> id_petugas;
            $_SESSION['nama_petugas'] = $o -> nama_petugas;
            $_SESSION['telp'] = $o -> telp;
            $_SESSION['level'] = $o -> level;
            @header('location:../modul-petugas/');
        }else{ ?> 
            <div class="alert alert-danger" role="alert">
                Pastikan Data yang Anda Masukan Benar !
            </div>
            <?php
        }
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
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><i class="bi bi-rainbow"></i>PENGADUAN</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">LOGIN JEPARI</h5>
                  </div>

                  <form class="row g-3" method="post">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <select name="pilihan" class="form-select" aria-label="Default select example">
                        <option value="masyarakat">Masyarakat</option>
                       <option value="petugas">Petugas</option>
                       <div class="invalid-feedback">Please enter your password!</div>
                    </select>
                    <div class="col-12">
                    <button class="btn btn-primary" name="login">LOGIN</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Belum Punya Akun? <a href="register.php">Buat Akun</a></p>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


</body>

</html>