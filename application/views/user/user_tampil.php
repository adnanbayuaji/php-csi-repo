<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <div class="section-header">
            <h1>Pengelolaan Pengguna</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item">Master Data</div>
              <div class="breadcrumb-item">Pengguna</div>
            </div>
          </div>

          <div class="section-body">

            <div class="card">
              <div class="card-header">
                <a href="<?php echo base_url().'user/tambah'; ?>" class="btn btn-primary btn-sm">Tambah Data</a>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <div style="overflow: auto">
                    <table id="example2" class="table table-striped">
                      <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Pengguna</th>
                            <th>Hak Akses</th>
                            <th>Pabrik</th>
                            <th>Status Data</th>
                            <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                          $no = 1;
                          if(!empty($hasil))
                          {
                              foreach($hasil as $data)
                              {
                                  ?>
                                  <tr>
                                  <td> <?php echo $no; ?> </td>
                                  <td> <?php echo $data->usr_nama; ?> </td>
                                  <td> <?php echo $data->rol_name; ?> </td>
                                  <td> <?php echo $data->pla_kodearea; ?> </td>
                                  <td> <?php echo $data->usr_status; ?> </td>
                                  <td> 
                                  <a href='<?php echo base_url()."user/update/".$data->usr_id; ?>'><i class="fa fa-edit"></i></a> &nbsp;
                                  <?php
                                    if($data->usr_status == 'Aktif') {
                                    ?>
                                    <a href='<?php echo base_url()."user/deleteon/".$data->usr_id; ?>' class='tombol-hapuson'><i class="fa fa-toggle-on"></i></a>
                                  <?php } if($data->usr_status == 'Tidak Aktif'){?>
                                    <a href='<?php echo base_url()."user/deleteoff/".$data->usr_id; ?>' class='tombol-hapusoff'><i class="fa fa-toggle-off"></i></a>
                                  <?php
                                  } ?>
                                  </td>
                                  </tr>
                                  <?php
                                  $no++;
                              }
                          }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('_partials/footer'); ?>