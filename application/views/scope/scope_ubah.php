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
                <h4>Ubah Data</h4>
              </div>
              <?php
                  echo form_open('scope/update/'.$hasil->sow_id, 'class="form-horizontal"');
              ?>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm">
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Scope of Work</label>
                      <div class="col-sm-12">
                        <?php
                            $scope = array('name'=>'scope', 'maxlength'=>'254','value'=>$hasil->sow_deskripsi,'size'=>'30', 'class'=>'form-control');
                            echo form_input($scope);
                            echo form_error('scope');
                        ?>           
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Departemen</label>
                      <div class="col-sm-12">
                      <?php
                          echo form_dropdown('dept', $dept, $hasil->dept_id, array('class' => 'form-control'));
                          echo form_error('dept');
                      ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-whitesmoke text-right">
                <a href="<?php echo base_url().'scope'; ?>" class="btn btn-secondary">Kembali</a> &nbsp;
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