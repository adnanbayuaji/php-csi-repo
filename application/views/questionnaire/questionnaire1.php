<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>CSI GA Division - Astra Daihatsu Motor</h1>
            <!-- <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Layout</a></div>
              <div class="breadcrumb-item">Top Navigation</div>
            </div> -->
          </div>

          <div class="section-body">
            <!-- <h2 class="section-title">This is Example Page</h2>
            <p class="section-lead">This page is just an example for you to create your own page.</p> -->
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Profil Responden</h4>
                  </div>
                  <?php
                    echo form_open('Questionnaire/tambah', 'class="form-horizontal"');
                  ?>
                  <div class="card-body">
                    <p>Berilah tanda pada jawaban yang telah disediakan, sesuai dengan kondisi Bapak / Ibu, dan berilah jawaban pada kolom yang telah disediakan.</p>
                    <p>Mohon diisi sesuai dengan fakta di lapangan dan sejujurnya. Hasil survey digunakan dalam rangka evaluasi GA Division. Angket ini tidak mempengaruhi penilaian atau performa kerja individu responden.</p>
                    <div class="form-group">
                      <label>NPK</label>
                      <div class="input-group">
                        <?php
                          $npk = array('name'=>'npk', 'maxlength'=>'15','value'=>(!empty($hasil->res_npk)) ? $hasil->res_npk : ((!empty($_SESSION['tr_npk'])) ? $_SESSION['tr_npk'] : NULL ), 'class'=>'form-control', 'onkeypress'=>'return hanyaAngkal(event)');
                          echo form_input($npk);
                        ?>   
                        &nbsp;
                        <div class="pull-right">
                          <?php 
                            echo form_submit('cari', 'Cari', 'id="cari" class="btn btn-success btn-lg"');
                          ?>
                        </div>
                      </div>
                      <p>Gunakan tombol "Cari" jika pernah melakukan pengisian data pada periode sebelumnya untuk memudahkan pencarian data.</p>
                      <label><?php echo form_error('npk'); ?></label>
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <div class="input-group">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                          <?php
                          $tempA = (!empty($hasil->res_gender)) ? $hasil->res_gender : ((!empty($_SESSION['tr_jeniskelamin'])) ? $_SESSION['tr_jeniskelamin'] : NULL );
                          if($tempA == "Laki-Laki")
                          {
                           ?>
                          <label class="btn btn-secondary active">
                            <?php 
                              $datasd = array(
                                'name'          => 'jeniskelamin',
                                'id'            => 'laki',
                                'value'         => 'Laki-Laki',
                                'checked'       => TRUE
                              );
                              echo form_radio($datasd);
                            ?>Laki-Laki
                            <!-- <input type="radio" name="options" id="option1" autocomplete="off" checked> Active -->
                          </label>
                          <label class="btn btn-secondary">
                          <?php 
                              $datasd = array(
                                'name'          => 'jeniskelamin',
                                'id'            => 'perempuan',
                                'value'         => 'Perempuan',
                                'checked'       => FALSE
                              );
                              echo form_radio($datasd);
                            ?>Perempuan
                            <!-- <input type="radio" name="options" id="option2" autocomplete="off"> Radio -->
                          </label>
                           <?php 
                          }
                          else if($tempA == "Perempuan")
                          {
                            ?>
                          <label class="btn btn-secondary">
                            <?php 
                              $datasd = array(
                                'name'          => 'jeniskelamin',
                                'id'            => 'laki',
                                'value'         => 'Laki-Laki',
                                'checked'       => FALSE
                              );
                              echo form_radio($datasd);
                            ?>Laki-Laki
                            <!-- <input type="radio" name="options" id="option1" autocomplete="off" checked> Active -->
                          </label>
                          <label class="btn btn-secondary active">
                          <?php 
                              $datasd = array(
                                'name'          => 'jeniskelamin',
                                'id'            => 'perempuan',
                                'value'         => 'Perempuan',
                                'checked'       => TRUE
                              );
                              echo form_radio($datasd);
                            ?>Perempuan
                            <!-- <input type="radio" name="options" id="option2" autocomplete="off"> Radio -->
                          </label>
                            <?php
                          }
                          else
                          {
                            ?>
                          <label class="btn btn-secondary">
                            <?php 
                              $datasd = array(
                                'name'          => 'jeniskelamin',
                                'id'            => 'laki',
                                'value'         => 'Laki-Laki',
                                'checked'       => FALSE
                              );
                              echo form_radio($datasd);
                            ?>Laki-Laki
                            <!-- <input type="radio" name="options" id="option1" autocomplete="off" checked> Active -->
                          </label>
                          <label class="btn btn-secondary">
                          <?php 
                              $datasd = array(
                                'name'          => 'jeniskelamin',
                                'id'            => 'perempuan',
                                'value'         => 'Perempuan',
                                'checked'       => FALSE
                              );
                              echo form_radio($datasd);
                            ?>Perempuan
                            <!-- <input type="radio" name="options" id="option2" autocomplete="off"> Radio -->
                          </label>
                            <?php
                          }
                          ?>
                        </div> 
                      </div> 
                      <label><?php echo form_error('jeniskelamin'); ?></label>
                    </div>
                    <div class="form-group">
                      <label>Usia</label>
                      <div class="input-group">
                      <?php
                        $options = array(
                          ''          => '-- Pilih Usia --',
                          '1'         => '< 20 Tahun',
                          '2'         => '21 - 30 Tahun',
                          '3'         => '31 - 40 Tahun',
                          '4'         => '41 - 50 Tahun',
                          '5'         => '> 50 Tahun'
                        );
                        $extra = array('class'=>'form-control');
                        echo form_dropdown('usia', $options, (!empty($hasil->res_usia)) ? $hasil->res_usia : ((!empty($_SESSION['tr_usia'])) ? $_SESSION['tr_usia'] : NULL ), $extra);
                      ?>  
                      </div>
                      <label><?php echo form_error('usia'); ?></label>
                    </div>
                    <div class="form-group">
                      <label>Pendidikan Terakhir</label>
                      <div class="input-group">
                      <?php
                        $options = array(
                          ''           => '-- Pilih Pendidikan Terakhir --',
                          'SMU / Sederajat' => 'SMU / Sederajat',
                          'D1/D2/D3'         => 'D1/D2/D3',
                          'S1'      => 'S1',
                          'S2'         => 'S2',
                          'Lainnya'         => 'Lainnya'
                        );
                        $extra = array('class'=>'form-control');
                        echo form_dropdown('pendidikan', $options, (!empty($hasil->res_pendidikan)) ? $hasil->res_pendidikan : ((!empty($_SESSION['tr_pendidikan'])) ? $_SESSION['tr_pendidikan'] : NULL ), $extra);
                      ?>  
                      </div>
                      <label><?php echo form_error('pendidikan'); ?></label>
                    </div>
                    <div class="form-group">
                      <label>Jabatan</label>
                        <div class="input-group">
                        <?php
                          $options = array(
                            ''          => '-- Pilih Jabatan --',
                            'Staff'         => 'Staff',
                            'Supervisor'         => 'Supervisor',
                            'Manajer'         => 'Manajer'
                          );
                          $extra = array('class'=>'form-control');
                          echo form_dropdown('jabatan', $options, (!empty($hasil->res_jabatan)) ? $hasil->res_jabatan : ((!empty($_SESSION['tr_jabatan'])) ? $_SESSION['tr_jabatan'] : NULL ), $extra);
                        ?>
                        </div>
                      <label><?php echo form_error('jabatan'); ?></label>
                    </div>
                    <div class="form-group">
                      <label>Lama Bekerja</label>
                        <div class="input-group">
                        <?php
                          $options = array(
                            ''          => '-- Pilih Lama Bekerja --',
                            '1'         => '< 5 Tahun',
                            '2'         => '5 - 10 Tahun',
                            '3'         => '11 - 15 Tahun',
                            '4'         => '16 - 20 Tahun',
                            '5'         => '> 20 Tahun'
                          );
                          $extra = array('class'=>'form-control');
                          echo form_dropdown('lamabekerja', $options, (!empty($hasil->res_lamakerja)) ? $hasil->res_lamakerja : ((!empty($_SESSION['tr_lamabekerja'])) ? $_SESSION['tr_lamabekerja'] : NULL ), $extra);
                        ?>
                        </div>
                      <label><?php echo form_error('lamabekerja'); ?></label>
                    </div>
                    <div class="form-group">
                      <label>Plant/Pabrik</label>
                        <div class="input-group">
                          <?php
                            echo form_dropdown('plant', $plant, (!empty($hasil->pla_id)) ? $hasil->pla_id : ((!empty($_SESSION['tr_plant'])) ? $_SESSION['tr_plant'] : NULL ), array('class' => 'form-control select2'));
                          ?> 
                        </div>
                      <label><?php echo form_error('plant'); ?></label>
                    </div>
                    <div class="form-group">
                      <label>Periode CSI</label>
                      <div class="input-group">
                      <?php
                        $options = array(
                          ''          => '-- Pilih Periode --',
                          date("Y")   => date("Y"),
                          date("Y")-1 => date("Y")-1
                        );
                        $extra = array('class'=>'form-control');
                        echo form_dropdown('periode', $options, (!empty($hasil->res_periode)) ? $hasil->res_periode : ((!empty($_SESSION['tr_periode'])) ? $_SESSION['tr_periode'] : NULL ), $extra);
                      ?>  
                      </div>
                      <label><?php echo form_error('periode'); ?></label>
                    </div>
                  </div>
                  <div class="card-footer bg-whitesmoke text-right">
                    <?php 
                      echo form_submit('submit', 'Selanjutnya', 'id="submit" class="btn btn-primary"');
                    ?>
                  </div>
                <!-- <div class="card-footer bg-whitesmoke">
                  This is card footer
                </div> -->
                
                  <?php echo form_close(); ?> 
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('_partials/footer'); ?>