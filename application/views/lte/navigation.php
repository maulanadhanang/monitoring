		<!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <!-- <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> -->
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= site_url() ?>" class="brand-link elevation-4">
                <img src="<?php echo base_url();?>dist/img/AdminLTELogo.png"
                alt="<?= $this->config->config['pageTitle'] ?>"
                class="brand-image img-circle elevation-3"
                style="opacity: .8">
                <span class="brand-text font-weight-light"><?= $this->config->config['pageTitle'] ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo base_url();?>dist/img/avatar5.png" class="img-circle elevation-2" alt="<?= user_logged_in()['user_nama'] ?>">
                    </div>
                    <div class="info">
                        <a href="<?= site_url(array('profile')) ?>" class="d-block"><?= user_logged_in()['user_nama'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- <li class="nav-item">
                            <a href="<?= site_url() ?>" class="nav-link <?= ($this->uri->segment('1')=='' || $this->uri->segment('1')=='dashboard')? 'active':'' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li> -->
                        <!-- device -->
                        <li class="nav-item has-treeview <?= ($this->uri->segment('1')=='device' && $this->uri->segment('2')=='iface')? 'menu-open':'' ?>">
                            <a href="#" class="nav-link <?= ($this->uri->segment('1')=='device' && $this->uri->segment('2')=='iface')? 'active':'' ?>">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                Device
                                <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php
                                $devices = alldevice();
                                foreach ($devices as $device) {
                                ?>
                                <li class="nav-item">
                                    <a href="<?= site_url(array('device', 'iface', $device->id)) ?>" class="nav-link <?= ($this->uri->segment('2')=='iface' && $this->uri->segment('3')==$device->id)? 'active':'' ?>">
                                        <i class="far nav-icon"></i>
                                        <p><?= $device->nama ?></p>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <li class="nav-item">
                            <a href="<?= site_url(array('device')) ?>" class="nav-link <?= ($this->uri->segment('1')=='device' && $this->uri->segment('2')=='')? 'active':'' ?>">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Kelola Device
                                </p>
                            </a>
                            </li>
                            <!-- user -->
                          <li class="nav-item">
                              <a href="<?= site_url(array('user')) ?>" class="nav-link <?= ($this->uri->segment('1')=='user')? 'active':'' ?>">
                                  <i class="nav-icon fas fa-user"></i>
                                  <p>
                                      User
                                  </p>
                              </a>
                          </li>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(array('logout')) ?>" class="nav-link">
                                <i class="nav-icon fas fa-lock"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
