<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <div class="section-header">
            <h1>Pengelolaan Scope of Work</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item">Master Data</div>
              <div class="breadcrumb-item">Scope of Work</div>
            </div>
          </div>

          <div class="section-body">

            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#impor-data-scope">
                  Impor Data
                </button> &nbsp;
                <a href="<?php echo base_url().'scope/tambah'; ?>" class="btn btn-primary btn-sm">Tambah Data</a>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <div style="overflow: auto">
                    <table id="example3" class="table table-striped">
                      <thead>
                        <tr>
                            <th>NO</th>
                            <th>Scope of Work</th>
                            <th>Departemen</th>
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
                                  <td> <?php echo $data->sow_deskripsi; ?> </td>
                                  <td> <?php echo $data->dept_nama; ?> </td>
                                  <td> <?php echo $data->sow_status; ?> </td>
                                  <td> 
                                  <a href='<?php echo base_url()."scope/update/".$data->sow_id; ?>'><i class="fa fa-edit"></i></a> &nbsp;
                                  <?php
                                    if($data->sow_status == 'Aktif') {
                                    ?>
                                    <a href='<?php echo base_url()."scope/deleteon/".$data->sow_id; ?>' class='tombol-hapuson'><i class="fa fa-toggle-on"></i></a>
                                  <?php } if($data->sow_status == 'Tidak Aktif'){?>
                                    <a href='<?php echo base_url()."scope/deleteoff/".$data->sow_id; ?>' class='tombol-hapusoff'><i class="fa fa-toggle-off"></i></a>
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