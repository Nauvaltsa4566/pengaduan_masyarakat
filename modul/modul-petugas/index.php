<?php include('../../config/database.php');
include('../../assets/header.php'); 
@session_start();
if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas'){
    true;
}else{
    @header('location:../modul-masyarakat/');
}

if(isset($_POST['hapus'])){
    $nik = $_POST['nik'];
    $q = mysqli_query($con, "DELETE FROM masyarakat WHERE nik = '$nik'");
}

if(isset($_POST['verif'])){
    $nik = $_POST['nik'];
    $q = mysqli_query($con, "UPDATE masyarakat SET verif = '1' WHERE nik = '$nik'");
}
?>
<body>
<?php
  include('../../assets/menu.php')
?>

</aside>
<main id="main" class="main">
<div class="card-header">
        <p class="fs-4 fw-bold"><i class="bi bi-layout-text-sidebar-reverse"></i> petugas</p>
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
        $q = mysqli_query($con, "SELECT * FROM masyarakat WHERE verif = '0'");
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
                                        <button name="verif" class="btn btn-success">Verif</button>
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
</main>

  <footer id="footer" class="footer">
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php 
  include('../../assets/footer.php');
  ?>

</body>

</html>