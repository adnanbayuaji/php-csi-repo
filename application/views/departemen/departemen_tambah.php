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
                <h4>Tambah Data</h4>
              </div>
              
              <?php
                echo form_open('departemen/tambah', 'class="form-horizontal"');
              ?>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm">
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Nama</label>
                      <div class="col-sm-12">
                        <?php
                          $nama = array('name'=>'nama', 'maxlength'=>'254','value'=>"", 'class'=>'form-control');
                          echo form_input($nama);
                          echo form_error('nama');
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-whitesmoke text-right">
                <a href="<?php echo base_url().'departemen'; ?>" class="btn btn-secondary">Kembali</a> &nbsp;
                <?php 
                  echo form_submit('submit', 'Simpan', 'id="submit" class="btn btn-primary"');
                ?>
              </div>
              <?php echo form_close(); ?> 
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('_partials/footer'); ?>