<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="/" class="logo">
        <img
          src="<?= base_url('assets') ?>/img/kaiadmin/logo_light.svg"
          alt="navbar brand"
          class="navbar-brand"
          height="20"
        />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        
         <li class="nav-item">
          <a href="/">
            <i class="fas fa-th-list"></i>
            <p>Dashboard</p>
            
          </a>
        </li>
        <?php if(role() == 'guru'): ?>
          <li class="nav-item">
            <a href="/guru/nilai">
              <i class="fas fa-th-list"></i>
              <p>Nilai</p>
              
            </a>
          </li>
          <li class="nav-item">
            <a href="/guru/biodata">
              <i class="fas fa-th-list"></i>
              <p>Biodata</p>
              
            </a>
          </li>
        <?php elseif(role() == 'siswa'): ?>
          <li class="nav-item">
            <a href="/siswa/biodata">
              <i class="fas fa-th-list"></i>
              <p>Biodata</p>
              
            </a>
          </li>
          <li class="nav-item">
            <a href="/siswa/nilai">
              <i class="fas fa-th-list"></i>
              <p>Nilai</p>
              
            </a>
          </li>
        <?php else: ?>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#kelas-menu">
            <i class="fas fa-layer-group"></i>
            <p>Kelas</p>
            <span class="caret"></span>
          </a>
          <div class="collapse show" id="kelas-menu">
            <ul class="nav nav-collapse">
              <li class="">
                <a href="/kelas">
                  <span class="sub-item">Kelas</span>
                </a>
              </li>
              <li class="">
                <a href="/kelas/level">
                  <span class="sub-item">Kelas Level</span>
                </a>
              </li>
              <li class="">
                <a href="/kelas/aktif">
                  <span class="sub-item">Kelas Aktif</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a href="/thajaran">
            <i class="fas fa-th-list"></i>
            <p>Th Ajaran</p>
            
          </a>
        </li>
        <li class="nav-item">
          <a href="/pelajaran">
            <i class="fas fa-pen-square"></i>
            <p>Mata Pelajaran</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/siswa">
            <i class="fas fa-table"></i>
            <p>Siswa</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/guru">
            <i class="fas fa-table"></i>
            <p>Guru</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/jadwal">
            <i class="fas fa-table"></i>
            <p>Jadwal</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pengguna">
            <i class="fas fa-table"></i>
            <p>Pengguna</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="/register">
            <i class="fas fa-table"></i>
            <p>Register</p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="/login">
            <i class="fas fa-table"></i>
            <p>Login</p>
          </a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
          <a href="#" id="logout">
            <i class="fas fa-table"></i>
            <p>LogOut</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>