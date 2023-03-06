<head>
    <title>.: Tanggapan :.</title>
</head>
<?php include('../../assets/header.php') ?>
<?php include('../../assets/menu.php') ?>
<?php @session_start(); 
    if(isset($_SESSION['username'])){
        true;
    }else{
        @header('location:../modul-auth/');
    }
?>

<body>
<main class="main" id="main">
<div class="card-header">
        <p class="fs-4 fw-bold"><i class="bi bi-layout-text-sidebar-reverse"></i> Tanggaan</p>
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
<div class="container">
        <div class="card">
            <div class="card-header">
                <p class="fs-4 fw-bold">.: Tanggapan :.</p>
            </div>
            <div class="card-body">
                <table class="table table-success table-striped table-hover mt-3">
                    <tr>
                        <th scope="col">ID Tanggapan</th>
                        <th scope="col">ID Pengaduan</th>
                        <th scope="col">Tgl Tanggapan</th>
                        <th scope="col">Tanggapan</th>
                        <th scope="col">ID Petugas</th>
                    </tr>
                    <?php 
                    include('../../config/database.php');
                    $no = 1;
                    $q = mysqli_query($con, "SELECT * FROM tanggapan");
                    while($t = mysqli_fetch_object($q)){
                        ?>  
                            <tr>
                                <td><?= $t -> id_tanggapan ?></td>
                                <td><?= $t -> id_pengaduan ?></td>
                                <td><?= $t -> tgl_tanggapan ?></td>
                                <td><?= $t -> tanggapan ?></td>
                                <td><?= $t -> id_petugas ?></td>
                            </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    </main>
    <?php include('../../assets/footer.php') ?>
</body>