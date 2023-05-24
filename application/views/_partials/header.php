<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $title; ?> &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url()."assets/modules/sweetalert2/package/dist/sweetalert2.min.css"; ?>">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <style>
    .center {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<?php
//dashboard-nav
if (($this->uri->segment(1) == "home" || $this->uri->segment(1) == "Home") ) {
  $cek = $this->session->userdata('role');
  if($cek==null||$cek=="user")
  {
    header('location:'.base_url());
  }
  $this->load->view('_partials/layout_home');
  $this->load->view('_partials/sidebar');
}
//side-nav
if (($this->uri->segment(1) == "User" || $this->uri->segment(1) == "user") || ($this->uri->segment(1) == "departemen" || $this->uri->segment(1) == "Departemen") || ($this->uri->segment(1) == "scope" || $this->uri->segment(1) == "Scope") || ($this->uri->segment(1) == "attribute" || $this->uri->segment(1) == "Attribute") || ($this->uri->segment(1) == "question" || $this->uri->segment(1) == "Question")) {
  $cek = $this->session->userdata('role');
  if($cek==null||$cek=="user")
  {
    header('location:'.base_url());
  }
  $this->load->view('_partials/layout');
  $this->load->view('_partials/sidebar');
}
//top-nav
elseif (($this->uri->segment(1) != "home" && $this->uri->segment(1) != "Home") && ($this->uri->segment(1) != "starter" && $this->uri->segment(1) != "Starter") && ($this->uri->segment(1) != "user" && $this->uri->segment(1) != "User") && ($this->uri->segment(1) != "departemen" && $this->uri->segment(1) != "Departemen") && ($this->uri->segment(1) != "scope" && $this->uri->segment(1) != "Scope") && ($this->uri->segment(1) != "attribute" && $this->uri->segment(1) != "Attribute") && ($this->uri->segment(1) != "question" && $this->uri->segment(1) != "Question")) {
  $this->load->view('_partials/layout-3');
  $this->load->view('_partials/navbar');
}
?>
