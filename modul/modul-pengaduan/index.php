<?php include('../../config/database.php');
include('../../assets/header.php'); 
@session_start();
include('../../config/database.php');

    if(isset($_SESSION['username'])){
        true;
    }else{
        @header('location:../modul-auth/');
    }

    if(isset($_POST['buat'])){
        $tgl = $_POST['tgl'];
        $nik = $_POST['nik'];
        $pengaduan = $_POST['pengaduan'];
        $foto = $_POST['foto'];

        $q = mysqli_query($con, "INSERT INTO pengaduan (`tgl_pengaduan`, `nik`, `isi_laporan`, `foto`) VALUES ('$tgl', '$nik', '$pengaduan', '$foto')");
    }

    if(isset($_POST['tanggap'])){
        $id_pengaduan = $_POST['id_pengaduan'];
        $tgl_tanggap = $_POST['tgl'];
        $tanggapan = $_POST['tanggapan'];
        $id_petugas = $_POST['idPetugas'];
        $status = $_POST['status'];

        $s = mysqli_query($con, "UPDATE pengaduan SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'");
        $q = mysqli_query($con, "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ('$id_pengaduan', '$tgl_tanggap', '$tanggapan', '$id_petugas')");
    }
?>
<body>
<?php
  include('../../assets/menu.php')
?>

</aside>
<main id="main" class="main">
<div class="card-header">
        <p class="fs-4 fw-bold"><i class="bi bi-layout-text-sidebar-reverse"></i> Pengaduan</p>
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
      <th scope="col">ID pengaduan</th>
      <th scope="col">TGL Pengaduan</th>
      <th scope="col">NIK</th>
      <th scope="col">Laporan</th>
      <th scope="col">Foto</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
        <?php 
        include('../../config/database.php');
        $q = mysqli_query($con, "SELECT * FROM pengaduan ");
        while($m = mysqli_fetch_object($q)){
            ?>
                <tr>
                    <td><?= $m -> id_pengaduan ?></td>
                    <td><?= $m -> tgl_pengaduan ?></td>
                    <td><?= $m -> nik ?></td>
                    <td><?= $m -> isi_laporan ?></td>
                    <td><?= $m -> foto ?></td>
                    <td><?= $m -> status ?></td>
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
                <?php if($_SESSION['level'] == 'masyarakat'){
                ?> 
                    <div class="card-footer">
                    <h5 class="fw-bold mb-5">.: Buat Pengaduan :.</h5>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="tgl" class="form-label">Tanggal Pengaduan</label>
                                <input type="date" class="form-control" id="tgl" name="tgl" required>
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK (terisi otomatis)</label>
                                <input type="text" readonly class="form-control-plaintext" id="nik" name="nik" value="<?= $_SESSION['nik'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="pengaduan" class="form-label">Hal yang ingin Dilaporkan</label>
                                <textarea class="form-control" id="pengaduan" name="pengaduan" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto" placeholder="Gambar yang Berhubungan dengan Hal yang Dilaporkan" >
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn w-100 text-white" name="buat" id="buat" style="background-color: green;">Buat Laporan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
            }else{
                ?> 
                    <div class="card-footer" id="beri-tanggapan">
                        <h5 class="fw-bold mb-5">.: Beri Tanggapan :.</h5>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="id_pengaduan" class="mb-3">Pilih ID Pengaduan yang Ingin ditanggapi</label>
                                <select name="id_pengaduan" class="form-select" aria-label="Default select example">
                                    <?php
                                        include('../../configuration/koneksi.php'); 
                                        $q = mysqli_query($con, "SELECT * FROM pengaduan");
                                        while($o = mysqli_fetch_object($q)){
                                            ?> 
                                                <option value="<?= $o -> id_pengaduan ?>"><?= $o -> id_pengaduan ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tgl" class="form-label">Tanggal Tanggapan</label>
                                <input type="date" class="form-control" id="tgl" name="tgl" required>
                            </div>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-select" aria-label="Default select example">
                                    <option value="proses">Diproses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggapan" class="form-label">Tanggapan</label>
                                <textarea class="form-control" id="tanggapan" name="tanggapan" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="idPetugas" id="idPetugas" value="<?= $_SESSION['id_petugas'] ?>">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="submit" class="btn w-100 text-white" name="tanggap" id="tanggap" style="background-color: green;">Kirim Tanggapan</button>
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