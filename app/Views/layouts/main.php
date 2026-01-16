<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $this->renderSection('title') ?></title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="<?= base_url("assets") ?>/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="<?= base_url("assets") ?>/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["<?= base_url("assets") ?>/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url("assets") ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url("assets") ?>/css/plugins.min.css" />
    <link rel="stylesheet" href="<?= base_url("assets") ?>/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?= base_url("assets") ?>/css/demo.css" />
    <!-- CSS KU -->
     <style>
      .perbaharui:hover{
        color: #123057ff; 
        transform: scale(1.1); /* tombol sedikit membesar */
        transition: 0.3s; /* langsung efek, tanpa delay */
      }
      .hapus:hover{
        color: #ec3a3aff;
        transform: scale(1.1); /* tombol sedikit membesar */
        transition: 0.3s;
      }
     </style>
     <!-- datatable css -->
      <link href="https://cdn.datatables.net/v/bs5/dt-2.3.5/datatables.min.css" rel="stylesheet" integrity="sha384-49/RW1o98YG2C2zlWgS77FLSrXw99u/R5gTv26HOR4VWXy7jVEt8iS/cfDn6UtHE" crossorigin="anonymous">
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <?= $this->include('layouts/sidebar') ?>
      <!-- End Sidebar -->

      <div class="main-panel">
        <!-- Header -->
        <?= $this->include('layouts/header') ?>
        <!-- end Header -->

        <!-- Content -->
        <?= $this->renderSection('content') ?>
        <!-- end Content -->

        <!-- Footer -->
         <?= $this->include('layouts/footer') ?>
        <!-- end footer -->
      </div>

      <!-- Custom template | don't include it in your project! -->
      <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
          <div class="switcher">
            <div class="switch-block">
              <h4>Logo Header</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="selected changeLogoHeaderColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="blue"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="purple"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="light-blue"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="green"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="orange"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="red"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="white"
                ></button>
                <br />
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="dark2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="blue2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="purple2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="light-blue2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="green2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="orange2"
                ></button>
                <button
                  type="button"
                  class="changeLogoHeaderColor"
                  data-color="red2"
                ></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Navbar Header</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="blue"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="purple"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="light-blue"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="green"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="orange"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="red"
                ></button>
                <button
                  type="button"
                  class="selected changeTopBarColor"
                  data-color="white"
                ></button>
                <br />
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="dark2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="blue2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="purple2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="light-blue2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="green2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="orange2"
                ></button>
                <button
                  type="button"
                  class="changeTopBarColor"
                  data-color="red2"
                ></button>
              </div>
            </div>
            <div class="switch-block">
              <h4>Sidebar</h4>
              <div class="btnSwitch">
                <button
                  type="button"
                  class="changeSideBarColor"
                  data-color="white"
                ></button>
                <button
                  type="button"
                  class="selected changeSideBarColor"
                  data-color="dark"
                ></button>
                <button
                  type="button"
                  class="changeSideBarColor"
                  data-color="dark2"
                ></button>
              </div>
            </div>
          </div>
        </div>
        <div class="custom-toggle">
          <i class="icon-settings"></i>
        </div>
      </div>
      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url("assets") ?>/js/core/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url("assets") ?>/js/core/popper.min.js"></script>
    <script src="<?= base_url("assets") ?>/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= base_url("assets") ?>/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="<?= base_url("assets") ?>/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?= base_url("assets") ?>/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?= base_url("assets") ?>/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <!-- <script src="<?= base_url("assets") ?>/js/plugin/datatables/datatables.min.js"></script> -->
    <script src="https://cdn.datatables.net/v/bs5/dt-2.3.5/datatables.min.js" integrity="sha384-0y3De3Rxhdkd4JPUzXfzK6J+7DyDlhLosIUV2OnIgn3Lh1i86pheXHOYUHK85Vwz" crossorigin="anonymous"></script>
    
    <!-- Bootstrap Notify -->
    <script src="<?= base_url("assets") ?>/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="<?= base_url("assets") ?>/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="<?= base_url("assets") ?>/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <!-- <script src="<?= base_url("assets") ?>/js/plugin/sweetalert/sweetalert.min.js"></script> -->

    <!-- Kaiadmin JS -->
    <script src="<?= base_url("assets") ?>/js/kaiadmin.min.js"></script>

    <!-- Custom JS -->
    <script src="<?= base_url('pages-js/global.js') ?>"></script>
    <?= $this->renderSection('script') ?>
    <!-- end Custom JS -->
  </body>
</html>
