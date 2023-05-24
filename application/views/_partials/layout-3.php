<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="layout-3">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('item'); ?>" ></div>
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <a href="<?php echo base_url(); ?>" class="navbar-brand"><img src="<?php echo base_url(); ?>assets/img/stisla-fill.png" alt="logo" width="50" class="shadow-light rounded-circle"></a>        
        <ul class="navbar-nav navbar-right ml-auto">
          <li class="nav-item"><a href="<?php echo base_url().'starter/login'; ?>" class="nav-link nav-link-lg"><i class="fa fa-sign-in"></i></a></li>
        </ul>
      </nav>
