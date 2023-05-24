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
                    <h4>Departemen di Divisi GA</h4>
                  </div>
                  <?php
                    echo form_open('Questionnaire/pilihdept', 'class="form-horizontal"');
                  ?>
                  <div class="card-body">
                    <p>Berilah tanda pada jawaban yang telah disediakan, sesuai dengan kondisi Bapak / Ibu, dan berilah jawaban pada kolom yang telah disediakan.</p>
                    <div class="form-group">
                      <label><b>Departemen mana saja dalam Divisi GA yang kamu pernah hadapi?</b></label>
                        <div class="form-check">
                          <?php
                            echo form_hidden('id_res', $id_res);
                            // echo form_hidden('id_dept', $id_res);

                            if(!empty($departemen))
                            {
                              $i=1;
                              foreach($departemen as $sd)
                              {
                                $datas = array(
                                  'name'          => 'dept'.$i,
                                  'id'            => 'dept'.$i,
                                  'value'         => $sd->dept_id,
                                  'checked'       => FALSE,
                                  'class'         => 'form-check-input'
                                );
                                echo form_checkbox($datas);
                                echo '<label class="form-check-label" for="defaultCheck1">'.$sd->dept_nama.'</label>';
                                echo "<br/>";
                                // echo form_error('dept');
                                $i++;
                              }
                            }
                          ?> 
                        </div>
                    </div>
                    <p>Mohon diisi sesuai dengan fakta di lapangan dan sejujurnya. Hasil survey digunakan dalam rangka evaluasi GA Division. Angket ini tidak mempengaruhi penilaian atau performa kerja individu responden.</p>

                      
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