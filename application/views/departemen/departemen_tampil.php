<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <div class="section-header">
            <h1>Pengelolaan Departemen</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item">Master Data</div>
              <div class="breadcrumb-item">Departemen</div>
            </div>
          </div>

          <div class="section-body">

            <div class="card">
              <div class="card-header">
                <a href="<?php echo base_url().'departemen/tambah'; ?>" class="btn btn-primary btn-sm">Tambah Data</a>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <div style="overflow: auto">
                    <table id="example1" class="table table-striped">
                      <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Departemen</th>
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
                                  <td> <?php echo $data->dept_nama; ?> </td>
                                  <td> <?php echo $data->dept_status; ?> </td>
                                  <td> 
                                  <a href='<?php echo base_url()."departemen/update/".$data->dept_id; ?>'><i class="fa fa-edit"></i></a> &nbsp;
                                  <?php
                                    if($data->dept_status == 'Aktif') {
                                    ?>
                                    <a href='<?php echo base_url()."departemen/deleteon/".$data->dept_id; ?>' class='tombol-hapuson'><i class="fa fa-toggle-on"></i></a>
                                  <?php } if($data->dept_status == 'Tidak Aktif'){?>
                                    <a href='<?php echo base_url()."departemen/deleteoff/".$data->dept_id; ?>' class='tombol-hapusoff'><i class="fa fa-toggle-off"></i></a>
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