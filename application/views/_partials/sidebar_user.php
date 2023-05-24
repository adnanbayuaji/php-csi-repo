<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <!-- <a href="<?php echo base_url(); ?>dist/index">Stisla</a> -->
            <a href="<?php echo base_url(); ?>home/admin" class="navbar-brand"><img src="<?php echo base_url(); ?>assets/img/stisla-fill.png" alt="logo" width="50" class="shadow-light rounded-circle"></a>  
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>home/admin"><img src="<?php echo base_url(); ?>assets/img/stisla-fill.png" alt="logo" width="30" class="shadow-light rounded-circle"></a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header d-flex justify-content-center">CSI GA Division</li>
            <li class="<?php echo $this->uri->segment(1) == 'home' || $this->uri->segment(1) == 'Home' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>home/user"><i class="fas fa-chart-pie"></i> <span>Beranda</span></a></li>
            <!-- <li class="menu-header">Reporting</li>
            <li class="<?php echo $this->uri->segment(1) == 'report' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>report"><i class="fas fa-file-contract"></i> <span>Report</span></a></li> -->
          </ul>
          <!-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div> -->
        </aside>
      </div>
