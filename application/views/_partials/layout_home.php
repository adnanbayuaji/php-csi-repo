<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('item'); ?>" ></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
          <div class="search-element">
            <!-- <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <div class="search-backdrop"></div>
            <div class="search-result">
            </div> -->
            
            <?php
              echo form_open('home/admin', 'class="form-horizontal"');
            ?>
            <div class="input-group">
              <?php
                echo form_dropdown('ddl_years', $datas_ddl, ((!empty($_SESSION['years'])) ? $_SESSION['years'] : "" ), array('class' => 'form-control'));
              ?> 
              <button class="btn" type="submit"><i class="fas fa-search"></i></button>
              
              <?php 
                // echo form_submit('submit', 'Cari!', 'id="submit" class="btn btn-secondary"');
              ?>
            </div>
            <?php echo form_close(); ?> 
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo base_url()."gambar/".$this->session->userdata('gambar'); ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?php echo $this->session->userdata('namalengkap'); ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <div class="dropdown-title">Logged in 5 min ago</div> -->
              <a href="<?php echo base_url(); ?>dist/features_profile" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url(); ?>starter/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
