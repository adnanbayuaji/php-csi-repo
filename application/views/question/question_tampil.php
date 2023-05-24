<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <div class="section-header">
            <h1>Pengelolaan Question</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item">Master Data</div>
              <div class="breadcrumb-item">Question</div>
            </div>
          </div>

          <div class="section-body">

            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#impor-data-question">
                  Impor Data
                </button> &nbsp;
                <a href="<?php echo base_url().'question/tambah'; ?>" class="btn btn-primary btn-sm">Tambah Data</a>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <div style="overflow: auto">
                    <table id="example4" class="table table-striped">
                      <thead>
                        <tr>
                            <th>NO</th>
                            <th>Departemen</th>
                            <th>Scope of Work</th>
                            <th>Attribute</th>
                            <th>Kepentingan</th>
                            <th>Kepuasan</th>
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
                                  <td> <?php echo $data->sow_deskripsi; ?> </td>
                                  <td> <?php echo $data->att_deskripsi; ?> </td>
                                  <td> <?php echo $data->que_kepentingan; ?> </td>
                                  <td> <?php echo $data->que_kepuasan; ?> </td>
                                  <td> <?php echo $data->que_status; ?> </td>
                                  <td> 
                                  <a href='<?php echo base_url()."question/update/".$data->que_id; ?>'><i class="fa fa-edit"></i></a> &nbsp;
                                  <?php
                                    if($data->que_status == 'Aktif') {
                                    ?>
                                    <a href='<?php echo base_url()."question/deleteon/".$data->que_id; ?>' class='tombol-hapuson'><i class="fa fa-toggle-on"></i></a>
                                  <?php } if($data->que_status == 'Tidak Aktif'){?>
                                    <a href='<?php echo base_url()."question/deleteoff/".$data->que_id; ?>' class='tombol-hapusoff'><i class="fa fa-toggle-off"></i></a>
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