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
                <h4>Tambah Data</h4>
              </div>
              
              <?php
                echo form_open('user/tambah', 'class="form-horizontal" enctype="multipart/form-data"');
              ?>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm">
                    <div class="form-group">
                      <label class="col-sm-12 control-label">NPK</label>
                      <div class="col-sm-12">
                        <?php
                          $npk = array('name'=>'npk', 'maxlength'=>'15','value'=>"", 'class'=>'form-control', 'onkeypress'=>'return hanyaAngkal(event)');
                          echo form_input($npk);
                          echo form_error('npk');
                        ?>     
                        <p class="help-block">Isikan "<b>-</b>" jika tidak terdapat npk.</p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Nama Lengkap</label>
                      <div class="col-sm-12">
                        <?php
                          $fullnama = array('name'=>'fullnama', 'maxlength'=>'254','value'=>"", 'class'=>'form-control');
                          echo form_input($fullnama);
                          echo form_error('fullnama');
                        ?>     
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Hak Akses</label>
                      <div class="col-sm-12">
                        <?php
                          $options = array(
                            ''          => '-- Pilih Hak Akses --',
                            'admin'         => 'Admin',
                            'user'         => 'User'
                          );
                          $extra = array('class'=>'form-control');
                          echo form_dropdown('role', $options, '', $extra);
                          echo form_error('role');
                        ?>  
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Lokasi Pabrik</label>
                      <div class="col-sm-12">
                        <?php
                          echo form_dropdown('plant', $plant, array(), array('class' => 'form-control'));
                          echo form_error('plant');
                        ?>     
                      </div>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Email</label>
                      <div class="col-sm-12">
                        <?php
                          $email = array('name'=>'email', 'maxlength'=>'254','value'=>"", 'class'=>'form-control');
                          echo form_input($email);
                          echo form_error('email');
                        ?>     
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Nama Pengguna</label>
                      <div class="col-sm-12">
                        <?php
                          $nama = array('name'=>'nama', 'maxlength'=>'254','value'=>"", 'class'=>'form-control');
                          echo form_input($nama);
                          echo form_error('nama');
                        ?>     
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Kata Sandi</label>
                      <div class="col-sm-12">
                        <?php
                          $pass = array('name'=>'pass', 'maxlength'=>'254','value'=>"", 'class'=>'form-control');
                          echo form_password($pass);
                          echo form_error('pass');
                        ?>     
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Ulang Kata Sandi</label>
                      <div class="col-sm-12">
                        <?php
                          $repass = array('name'=>'repass', 'maxlength'=>'254','value'=>"", 'class'=>'form-control');
                          echo form_password($repass);
                          echo form_error('repass');
                        ?>     
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Unggah Gambar</label>
                      <div class="col-sm-12">
                        <input type="file" name="file" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer bg-whitesmoke text-right">
                <a href="<?php echo base_url().'user'; ?>" class="btn btn-secondary">Kembali</a> &nbsp;
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