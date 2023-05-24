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
                <h4>Ubah Data</h4>
              </div>
              <?php
                  echo form_open('question/update/'.$hasil->que_id, 'class="form-horizontal"');
              ?>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm">
                  <div class="form-group">
                      <label class="col-sm-12 control-label">Attribute</label>
                      <div class="col-sm-12">
                      <?php
                          echo form_dropdown('attribute', $attribute, $hasil->att_id, array('class' => 'form-control'));
                          echo form_error('attribute');
                      ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Kepentingan</label>
                      <div class="col-sm-12">
                        <?php
                          $kepentingan = array('name'=>'kepentingan', 'maxlength'=>'254','value'=>$hasil->que_kepentingan, 'class'=>'form-control');
                          echo form_input($kepentingan);
                          echo form_error('kepentingan');
                        ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Kepuasan</label>
                      <div class="col-sm-12">
                        <?php
                          $kepuasan = array('name'=>'kepuasan', 'maxlength'=>'254','value'=>$hasil->que_kepuasan, 'class'=>'form-control');
                          echo form_input($kepuasan);
                          echo form_error('kepuasan');
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-whitesmoke text-right">
                <a href="<?php echo base_url().'question'; ?>" class="btn btn-secondary">Kembali</a> &nbsp;
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