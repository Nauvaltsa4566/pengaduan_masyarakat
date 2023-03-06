  <!-- ======= Header ======= -->
  <?php @session_start(); ?>
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-color : gold">

    <div class="d-flex align-items-center justify-content-between" style="background-color : ">
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block"><i class="bi bi-rainbow"></i>   JEPARI </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar" >

    <ul class="sidebar-nav" id="sidebar-nav" >
        <?php 
            if($_SESSION['level'] == 'masyarakat'){
                ?> 
                    <li class="nav-item" >
                        <a class="nav-link " href="../modul-profile/">
                        <span ><i class="bi bi-person-square"></i>Profile</span>
                        </a>
                    </li><!-- End Dashboard Nav -->
                <?php
            }
        ?>
      <li class="nav-item">
        <a class="nav-link " href="../modul-masyarakat/">
          <span><i class="bi bi-person-fill"></i>Masyarakat</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link " href="../modul-pengaduan/">
          <span><i class="bi bi-layout-text-sidebar-reverse"></i>Pengaduan</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <?php 
      if($_SESSION['level'] == 'masyarakat'){
        true;
      }else{
        ?> 
            <li class="nav-item">
                <a class="nav-link" href="../modul-petugas/">
                    <span><i class="bi bi-shield-fill-exclamation"></i>Petugas</span>
                </a>
            </li><!-- End Dashboard Nav -->
        <?php
      }
      ?>
      
      <li class="nav-item">
        <a class="nav-link " href="../modul-tanggapan/">
          <span><i class="bi bi-safe-fill"></i>Tanggapan</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="../modul-auth/logout.php">
          <span><i class="bi bi-reply-fill"></i>Log Out</span>
        </a>    
      </aside><!-- End Sidebar-->
       </div>
   </section>
</main>