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
            
            <div style="overflow:hidden; width: 1110px;">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <?php if(!empty($deptdetail))
                      {
                        foreach($deptdetail as $deptdet){?>
                          <h4>Departemen <?php echo $deptdet->dept_nama; ?></h4>
                        <?php }
                      } ?>
                  </div>
                  <?php
                    echo form_open('Questionnaire/tambahquestion', 'class="form-horizontal"');
                  ?>
                  <div class="card-body">   
                    <p>Berilah tanda pada jawaban yang telah disediakan, sertakan alasan jika poin nilai yang diberikan 1 atau 2.</p>
                      <?php
                      if(!empty($questionnaire))
                      {
                        $x=1;
                        echo form_hidden('tdr_id', $rowgettdrid->tdr_id);
                        echo form_hidden('res_id', $rowgettdrid->res_id);
                        foreach($questionnaire as $sd)
                        {
                          ?>
                            <div class="form-group">
                              <?php //echo form_hidden('dept_id', $sd->dept_id); ?>
                              <label class="form-label">Pertanyaan <?php echo $x; $x++;?></label>
                              <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                  <h6><label class="form-label"><?php echo $sd->que_kepentingan;?></label></h6>
                                </div>
                              </div>
                              <!-- <div style="overflow:hidden; width: 1000px;"> -->
                                <div class="row">
                                  <div class="col-2 col-md-2 col-lg-2 center">
                                    <label class="form-label">Sangat Setuju</label>
                                  </div>
                                  <div class="col-3 col-md-3 col-lg-3 center">
                                    <div class="selectgroup w-100">
                                      <label class="selectgroup-item">
                                        <?php 
                                          $datasd = array(
                                            'name'          => 'rb_kepentingan'.$sd->que_id,
                                            'id'            => '5',
                                            'value'         => 5,
                                            'class'       => 'selectgroup-input',
                                            'onClick'       => 'hideAlasan(this);'
                                          );
                                          echo form_radio($datasd);
                                        ?>
                                        <!-- <input type="radio" name="value" value="50" class="selectgroup-input"> -->
                                        <span class="selectgroup-button">5</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <?php 
                                          $datasd = array(
                                            'name'          => 'rb_kepentingan'.$sd->que_id,
                                            'id'            => '4',
                                            'value'         => 4,
                                            'class'       => 'selectgroup-input',
                                            'onClick'       => 'hideAlasan(this);'
                                          );
                                          echo form_radio($datasd);
                                        ?>
                                        <!-- <input type="radio" name="value" value="100" class="selectgroup-input"> -->
                                        <span class="selectgroup-button">4</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <?php 
                                          $datasd = array(
                                            'name'          => 'rb_kepentingan'.$sd->que_id,
                                            'id'            => '3',
                                            'value'         => 3,
                                            'class'       => 'selectgroup-input',
                                            'onClick'       => 'hideAlasan(this);'
                                          );
                                          echo form_radio($datasd);
                                        ?>
                                        <!-- <input type="radio" name="value" value="150" class="selectgroup-input"> -->
                                        <span class="selectgroup-button">3</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <?php 
                                          $datasd = array(
                                            'name'          => 'rb_kepentingan'.$sd->que_id,
                                            'id'            => '2',
                                            'value'         => 2,
                                            'class'       => 'selectgroup-input',
                                            'onClick'       => 'showAlasan(this);'
                                          );
                                          echo form_radio($datasd);
                                        ?>
                                        <!-- <input type="radio" name="value" value="200" class="selectgroup-input"> -->
                                        <span class="selectgroup-button">2</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <?php 
                                          $datasd = array(
                                            'name'          => 'rb_kepentingan'.$sd->que_id,
                                            'id'            => '1',
                                            'value'         => 1,
                                            'class'       => 'selectgroup-input',
                                            'onClick'       => 'showAlasan(this);'
                                          );
                                          echo form_radio($datasd);
                                        ?>
                                        <!-- <input type="radio" name="value" value="250" class="selectgroup-input"> -->
                                        <span class="selectgroup-button">1</span>
                                      </label>
                                    </div>
                                  </div>                      
                                  <div class="col-2 col-md-2 col-lg-2 center">
                                    <label class="form-label">Sangat Tidak Setuju</label>
                                  </div>                   
                                  <div class="col-1 col-md-1 col-lg-1 center">
                                    <hr style="border: none; border-left: 1px solid hsla(200, 10%, 50%,100); height: 100%; width: 1px;"/>
                                  </div>
                                  <div class="col-4 col-md-4 col-lg-4 center">
                                    <div class="row" id="<?php echo 'rb_kepentingan'.$sd->que_id; ?>" style="display:none;">
                                      <div class="col-2 col-md-2 col-lg-2 center">
                                        <label class="form-label" data-toggle="tooltip" data-placement="left" title="Alasan untuk penilaian 2 dan 1">Alasan</label>
                                      </div>
                                      <div class="col-10 col-md-10 col-lg-10 center">
                                        <?php 
                                          $alasan = array('name'=>'alasana'.$sd->que_id, 'id'=>'labelrb_kepentingan'.$sd->que_id, 'maxlength'=>'254','value'=>'', 'class'=>'form-control');
                                          echo form_input($alasan);
                                        ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <!-- </div> -->
                            </div>
                            <div class="form-group">
                              <label class="form-label">Pertanyaan <?php echo $x; $x++;?></label>
                              <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                <h6><label class="form-label"><?php echo $sd->que_kepuasan;?></label></h6>
                                </div>
                              </div>
                              <!-- <div style="overflow:hidden; width: 1000px;"> -->
                                <div class="row">
                                  <div class="col-2 col-md-2 col-lg-2 center">
                                    <label class="form-label">Sangat Setuju</label>
                                  </div>
                                  <div class="col-3 col-md-3 col-lg-3 center">
                                    <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <?php 
                                          $datasd = array(
                                            'name'          => 'rb_kepuasan'.$sd->que_id,
                                            'id'            => '5',
                                            'value'         => 5,
                                            'class'         => 'selectgroup-input',
                                            'onClick'       => 'hideAlasan(this);'
                                          );
                                          echo form_radio($datasd);
                                        ?>
                                        <!-- <input type="radio" name="value" value="50" class="selectgroup-input"> -->
                                        <span class="selectgroup-button">5</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <?php 
                                          $datasd = array(
                                            'name'          => 'rb_kepuasan'.$sd->que_id,
                                            'id'            => '4',
                                            'value'         => 4,
                                            'class'       => 'selectgroup-input',
                                            'onClick'       => 'hideAlasan(this);'
                                          );
                                          echo form_radio($datasd);
                                        ?>
                                        <!-- <input type="radio" name="value" value="100" class="selectgroup-input"> -->
                                        <span class="selectgroup-button">4</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <?php 
                                          $datasd = array(
                                            'name'          => 'rb_kepuasan'.$sd->que_id,
                                            'id'            => '3',
                                            'value'         => 3,
                                            'class'       => 'selectgroup-input',
                                            'onClick'       => 'hideAlasan(this);'
                                          );
                                          echo form_radio($datasd);
                                        ?>
                                        <!-- <input type="radio" name="value" value="150" class="selectgroup-input"> -->
                                        <span class="selectgroup-button">3</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <?php 
                                          $datasd = array(
                                            'name'          => 'rb_kepuasan'.$sd->que_id,
                                            'id'            => '2',
                                            'value'         => 2,
                                            'class'       => 'selectgroup-input',
                                            'onClick'       => 'showAlasan(this);'
                                          );
                                          echo form_radio($datasd);
                                        ?>
                                        <!-- <input type="radio" name="value" value="200" class="selectgroup-input"> -->
                                        <span class="selectgroup-button">2</span>
                                      </label>
                                      <label class="selectgroup-item">
                                        <?php 
                                          $datasd = array(
                                            'name'          => 'rb_kepuasan'.$sd->que_id,
                                            'id'            => '1',
                                            'value'         => 1,
                                            'class'         => 'selectgroup-input',
                                            'onClick'       => 'showAlasan(this);'
                                          );
                                          echo form_radio($datasd);
                                        ?>
                                        <!-- <input type="radio" name="value" value="250" class="selectgroup-input"> -->
                                        <span class="selectgroup-button">1</span>
                                      </label>
                                    </div>
                                  </div>                      
                                  <div class="col-2 col-md-2 col-lg-2 center">
                                    <label class="form-label">Sangat Tidak Setuju</label>
                                  </div>     
                                  <div class="col-1 col-md-1 col-lg-1 center">
                                    <hr style="border: none; border-left: 1px solid hsla(200, 10%, 50%,100); height: 100%; width: 1px;"/>
                                  </div>
                                  <div class="col-4 col-md-4 col-lg-4 center">
                                    <div class="row" id="<?php echo 'rb_kepuasan'.$sd->que_id; ?>" style="display:none;">
                                      <div class="col-2 col-md-2 col-lg-2 center">
                                        <label class="form-label" data-toggle="tooltip" data-placement="left" title="Alasan untuk penilaian 2 dan 1">Alasan</label>
                                      </div>
                                      <div class="col-10 col-md-10 col-lg-10 center">
                                        <?php 
                                          $alasan = array('name'=>'alasanb'.$sd->que_id, 'id'=>'labelrb_kepuasan'.$sd->que_id, 'maxlength'=>'254','value'=>'', 'class'=>'form-control');
                                          echo form_input($alasan);
                                        ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <!-- </div> -->
                            </div>
                          <?php
                        }
                      }
                      ?>
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
          </div>
        </section>
      </div>
<?php $this->load->view('_partials/footer'); ?>