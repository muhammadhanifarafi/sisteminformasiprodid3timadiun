<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                    xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg>
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 <?php if($activePage == 'dashboard') echo 'active'; ?>">
                <a class="nav-link" href="<?= base_url('dashboard')?>">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Pengelolaan Data</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2" id="navbar-nav"> 
              <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">Pemetaan Keterampilan</span>
                <span class="sr-only">(current)</span>
              </a>
              <li class="nav-item dropdown">
              <ul class="collapse list-unstyled pl-3 w-100" id="dashboard" data-parent="#navbar-nav">
                <li class="nav-item <?php if($activePage == 'bidang') echo 'active'; ?>">
                  <a class="nav-link pl-1" href="<?= base_url('bidang')?>">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-1 item-text">Data Bidang</span>
                  </a>
                </li>
                <li class="nav-item <?php if($activePage == 'sub-bidang') echo 'active'; ?>">
                  <a class="nav-link pl-1" href="<?= base_url('sub-bidang')?>">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-1 item-text">Data Sub Bidang</span>
                </a>
                </li>
                <li class="nav-item <?php if($activePage == 'nilai') echo 'active'; ?>">
                  <a class="nav-link pl-1" href="<?= base_url('nilai')?>">
                    <i class="fe fe-database fe-16"></i>
                    <span class="ml-1 item-text">Data Nilai</span>
                </a>
                </li>
                <p class="text-muted nav-heading mt-2 mb-2">
                    <span>Pengelolaan Hasil</span>
                </p>
                <li class="nav-item <?php if($activePage == 'rekomendasi_mahasiswa') echo 'active'; ?>">
                  <a class="nav-link pl-1" href="./dashboard-system.html">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-1 item-text">Rekomendasi Mahasiswa</span>
                </a>
                </li>
                <li class="nav-item <?php if($activePage == 'hasil_pemetaan') echo 'active'; ?>">
                  <a class="nav-link pl-1" href="./dashboard-saas.html">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-1 item-text">Hasil Pemetaan</span>
                </a>
                </li>
              </ul>
            </li>
          </ul>
    </nav>
</aside>