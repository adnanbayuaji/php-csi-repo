<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$bool = false;
$jumlah=[];
if(!empty($datas))
{
  $bool = true;
  foreach($datas as $try){
      $jumlah = number_format((float)$try->csi/100, 2, '.', '');
      // echo '<script language="javascript">';
      // echo 'alert("a'.$try->csi.'")';
      // echo '</script>';
  }
}
$plant_cattop=[];
$plant_sertop=[];
if(!empty($datas_top))
{
  $bool = true;
  foreach($datas_top as $try_top){
      $plant_cattop[] = $try_top->deskripsi;
      $plant_sertop[] = round($try_top->total/10,2);
  }
}
$plant_catbot=[];
$plant_serbot=[];
if(!empty($datas_bot))
{
  $bool = true;
  foreach($datas_bot as $try_bot){
      $plant_catbot[] = $try_bot->deskripsi;
      $plant_serbot[] = round($try_bot->total/10,2);
  }
}
$plant_cat=[];
$plant_series=[];
if(!empty($datas_plant))
{
  $bool = true;
  foreach($datas_plant as $try_plant){
      $plant_cat[] = $try_plant->pla_nama;
      $plant_series[] = round($try_plant->csi/100,2);
  }
}
$dept_cat=[];
$dept_series=[];
if(!empty($datas_dept))
{
  $bool = true;
  foreach($datas_dept as $try_dept){
      $dept_cat[] = $try_dept->dept_nama;
      $dept_series[] = round($try_dept->csi/100,2);
  }
}
?>
  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div id="tch_result"></div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="impor-data-scope">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Impor Data Scope of Work</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <?php
          echo form_open('scope/import', 'enctype="multipart/form-data"');
        ?>
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">Format</label>
            <label class="control-label">Silahkan unduh format template terlebih dahulu, </label> <a href='<?php echo base_url()."scope/ekspor"; ?>'><b>klik disini.</b></a>
          </div>
          <div class="form-group">
            <label class="control-label">Berkas Dokumen</label>
            <input type="file" name="file" class="control-form">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <?php 
              echo form_submit('submit', 'Simpan', 'id="submit-poin" class="btn btn-primary"');
            ?>
        </div>
        <?php echo form_close(); ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="impor-data-attribute">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Impor Data Attribute</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <?php
          echo form_open('attribute/import', 'enctype="multipart/form-data"');
        ?>
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">Format</label>
            <label class="control-label">Silahkan unduh format template terlebih dahulu, </label> <a href='<?php echo base_url()."attribute/ekspor"; ?>'><b>klik disini.</b></a>
          </div>
          <div class="form-group">
            <label class="control-label">Berkas Dokumen</label>
            <input type="file" name="file" class="control-form">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <?php 
              echo form_submit('submit', 'Simpan', 'id="submit-poin" class="btn btn-primary"');
            ?>
        </div>
        <?php echo form_close(); ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="impor-data-question">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Impor Data Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <?php
          echo form_open('question/import', 'enctype="multipart/form-data"');
        ?>
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">Format</label>
            <label class="control-label">Silahkan unduh format template terlebih dahulu, </label> <a href='<?php echo base_url()."question/ekspor"; ?>'><b>klik disini.</b></a>
          </div>
          <div class="form-group">
            <label class="control-label">Berkas Dokumen</label>
            <input type="file" name="file" class="control-form">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <?php 
              echo form_submit('submit', 'Simpan', 'id="submit-poin" class="btn btn-primary"');
            ?>
        </div>
        <?php echo form_close(); ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- General JS Scripts -->
  <script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
  
  <!-- DataTables -->
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>

  
  <!-- <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-sweetalert.js"></script> -->
<script src="<?php echo base_url()."assets/modules/chartjs/Chart.bundle.js"; ?>"></script>
<script src="<?php echo base_url()."assets/modules/chartjs/samples/utils.js"; ?>"></script>
<script src="<?php echo base_url()."assets/modules/chartjs/chartjs-plugin-datalabels.min.js"; ?>"></script>
<script src="<?php echo base_url()."assets/modules/gauge/dist/gauge.js"; ?>"></script>
<script src="<?php echo base_url()."assets/modules/highcharts/highcharts.js";?>"></script>
<script src="<?php echo base_url()."assets/modules/highcharts/highcharts-more.js";?>"></script>
<script src="<?php echo base_url()."assets/modules/highcharts/modules/solid-gauge.src.js";?>"></script>
<script src="<?php echo base_url()."assets/modules/highcharts/modules/exporting.js";?>"></script>
<script src="<?php echo base_url()."assets/modules/highcharts/modules/export-data.js";?>"></script>
<script src="<?php echo base_url()."assets/modules/highcharts/modules/accessibility.js";?>"></script>

<script src="<?php echo base_url()."assets/modules/sweetalert2/package/dist/sweetalert2.all.min.js"; ?>"></script>
<script src="<?php echo base_url()."assets/modules/sweetalert2/package/dist/sweetalert2.min.js"; ?>"></script>
<script src="<?php echo base_url()."assets/js/myscript.js"; ?>"></script>

  <script>
  function hanyaAngkal(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode < 31 || charCode==45 || (charCode > 47 && charCode < 58))
      return true;
    return false;
  }

  
  </script>
  <script type="text/javascript">

  $(document).ready(function(){

    $(function () {
      $('#example1').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false, 
        aoColumns : [
          { sWidth: '5%' },
          { sWidth: '65%' },
          { sWidth: '20%' },
          { sWidth: '10%' }
        ],
        'columnDefs': [
        {
          "targets": 0, // your case first column
          "className": "text-center"
        },
        {
          "targets": 3, // your case first column
          "className": "text-center"
        }]
      }),
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false, 
        aoColumns : [
          { sWidth: '10%' },
          { sWidth: '40%' },
          { sWidth: '15%' },
          { sWidth: '15%' },
          { sWidth: '15%' },
          { sWidth: '5%' }
        ],
        'columnDefs': [
        {
          "targets": 0, // your case first column
          "className": "text-center"
        },
        {
          "targets": 5, // your case first column
          "className": "text-center"
        }]
      }),
      $('#example3').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false, 
        aoColumns : [
          { sWidth: '5%' },
          { sWidth: '50%' },
          { sWidth: '25%' },
          { sWidth: '15%' },
          { sWidth: '5%' }
        ],
        'columnDefs': [
        {
          "targets": 0, // your case first column
          "className": "text-center"
        },
        {
          "targets": 4, // your case first column
          "className": "text-center"
        }]
      }),
      $('#example4').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false, 
        aoColumns : [
          { sWidth: '5%' },
          { sWidth: '15%' },
          { sWidth: '15%' },
          { sWidth: '15%' },
          { sWidth: '20%' },
          { sWidth: '20%' },
          { sWidth: '5%' },
          { sWidth: '5%' }
        ],
        'columnDefs': [
        {
          "targets": 0, // your case first column
          "className": "text-center"
        },
        {
          "targets": 7, // your case first column
          "className": "text-center"
        }]
      }),
      // Initiate DataTable function comes with plugin
      $('#exampleVOC').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false, 
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        aoColumns : [
          { sWidth: '80%' },
          { sWidth: '10%' },
          { sWidth: '10%' }
        ],
        'columnDefs': [
        {
          "targets": 1, // your case first column
          "className": "text-center"
        },
        {
          "targets": 2, // your case first column
          "className": "text-center"
        }]
      });
      // Start jQuery click function to view Bootstrap modal when view info button is clicked
      $('#exampleVOC').on('click', '.view_data', function(){
      // Get the id of selected phone and assign it in a variable called phoneData
        var tchData = $(this).attr('id');
        var tchYear = $(this).attr('year');
        // Start AJAX function
        $.ajax({
          // Path for controller function which fetches selected phone data
          url: "<?php echo base_url() ?>Home/getViewData",
          // Method of getting data
          method: "POST",
          // Data is sent to the server
          data: {tchData:tchData, tchYear:tchYear},
          // Callback function that is executed after data is successfully sent and recieved
          success: function(data){
            // Print the fetched data of the selected phone in the section called #phone_result 
            // within the Bootstrap modal
              $('#tch_result').html(data);
              // Display the Bootstrap modal
              $('#myModal').modal('show');
          }
        });
        // End AJAX function
      });
    });
    
    <?php if($bool)
    { ?>
      var gaugeOptions = {
        chart: {
          type: 'solidgauge',
          height: 260
        },

        title: null,

        pane: {
          center: ['50%', '50%'],
          size: '80%',
          startAngle: -90,
          endAngle: 90,
          background: {
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
            innerRadius: '60%',
            outerRadius: '100%',
            shape: 'arc'
          }
        },

        tooltip: {
          enabled: true
        },

        // the value axis
        yAxis: {
          stops: [
            [0.0, '#DF5353'], //red
            [0.6, '#DDDF0D'], // yellow
            [0.75, '#55BF3B'] // green
          ],
          lineWidth: 0,
          tickWidth: 0,
          minorTickInterval: null,
          tickAmount: 2,
          title: {
            y: -70
          },
          labels: {
            y: 16
          }
        },

        plotOptions: {
          solidgauge: {
            dataLabels: {
              y: 5,
              borderWidth: 0,
              //useHTML: true
            }
          }
        }
        };
        // The speed gauge
        $('#okChart').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
          min: 0,
          max: 1,
          title: {
            text: null
          }
        },

        credits: {
          enabled: false
        },

        series: [{
          name: 'CSI',
          data: [<?php echo $jumlah; ?>],
          dataLabels: {
            format: '<div style="text-align:center"><span style="font-size:25px;color:' +
              ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
              '<span style="font-size:12px;color:silver">capaian</span></div>'
          },
          tooltip: {
            valueSuffix: ' capaian'
          }
        }]
        }));

        Highcharts.chart('plantChart', {
          chart: {
              type: 'column'
          },
          title: {
              text: null
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              categories: <?php echo json_encode($plant_cat); ?>,
              crosshair: true
          },
          yAxis: {
              min: 0,
              max: 1,
              title: {
                  text: 'Poin CSI'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.2f} capaian</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0,
                  dataLabels: {
                      enabled: true
                  }
              }
          },
          series: [{
              name: 'CSI',
              data: <?php echo json_encode($plant_series); ?>
          }]
        });

        Highcharts.chart('deptChart', {
          chart: {
              type: 'column'
          },
          title: {
              text: null
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              categories: <?php echo json_encode($dept_cat); ?>,
              crosshair: true
          },
          yAxis: {
              min: 0,
              max: 1,
              title: {
                  text: 'Poin CSI'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.2f} capaian</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0,
                  dataLabels: {
                      enabled: true
                  }
              }
          },
          series: [{
              name: 'CSI',
              data: <?php echo json_encode($dept_series); ?>
          }]
        });

        Highcharts.chart('topChart', {
          chart: {
              type: 'bar'
          },
          title: {
              text: null
          },
          subtitle: {
              text: null
          },
          xAxis: {
              categories: <?php echo json_encode($plant_cattop); ?>,
              title: {
                  text: null
              }
          },
          yAxis: {
              min: 0,
              max: 1,
              title: {
                  text: 'poin',
                  align: 'high'
              },
              labels: {
                  overflow: 'justify'
              }
          },
          tooltip: {
              valueSuffix: ' poin'
          },
          plotOptions: {
              bar: {
                  dataLabels: {
                      enabled: true
                  }
              }
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'top',
              x: -75,
              y: 143,
              floating: true,
              borderWidth: 1,
              backgroundColor:
                  Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
              shadow: true
          },
          credits: {
              enabled: false
          },
          series: [{
              name: 'Top 3',
              data: <?php echo json_encode($plant_sertop); ?>
          }]
        });

        Highcharts.chart('bottomChart', {
          chart: {
              type: 'bar'
          },
          title: {
              text: null
          },
          subtitle: {
              text: null
          },
          xAxis: {
              categories: <?php echo json_encode($plant_catbot); ?>,
              title: {
                  text: null
              }
          },
          yAxis: {
              min: 0,
              max: 1,
              title: {
                  text: 'poin',
                  align: 'high'
              },
              labels: {
                  overflow: 'justify'
              }
          },
          tooltip: {
              valueSuffix: ' poin'
          },
          plotOptions: {
              bar: {
                  dataLabels: {
                      enabled: true
                  }
              }
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'top',
              x: -75,
              y: 143,
              floating: true,
              borderWidth: 1,
              backgroundColor:
                  Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
              shadow: true
          },
          credits: {
              enabled: false
          },
          series: [{
              name: 'Bottom 3',
              data: <?php echo json_encode($plant_serbot); ?>
          }]
        });
      <?php } ?>
  });

  function showAlasan(radio) {
    // alert(radio.name);
    let str1 = "#";
    let res = str1.concat(radio.name);
    $(res).show();
    let res2 = "#label".concat(radio.name);
    $(res2).prop('required',true);
  }

  function hideAlasan(radio) {
    // alert(radio.name);
    let str1 = "#";
    let res = str1.concat(radio.name);
    $(res).hide();
    let res2 = "#label".concat(radio.name);
    // alert(res2);
    $(res2).prop('required',false);
    $(res2).val("");
  }

  </script>

  <!-- JS Libraies -->
<?php
if ($this->uri->segment(2) == "" || $this->uri->segment(2) == "index") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "index_0") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "bootstrap_card") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "bootstrap_modal") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/prism/prism.js"></script>
<?php
}elseif ($this->uri->segment(2) == "layout_transparent") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/sticky-kit.js"></script>
<?php
}elseif ($this->uri->segment(2) == "components_gallery") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "components_multiple_upload") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/dropzonejs/min/dropzone.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "components_statistic") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.indonesia.js"></script>
<?php
}elseif ($this->uri->segment(2) == "components_table") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "components_user") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "forms_advanced_form") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "forms_editor") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/codemirror/lib/codemirror.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/codemirror/mode/javascript/javascript.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "gmaps_advanced_route" || $this->uri->segment(2) == "gmaps_draggable_marker" || $this->uri->segment(2) == "gmaps_geocoding" || $this->uri->segment(2) == "gmaps_geolocation" || $this->uri->segment(2) == "gmaps_marker" || $this->uri->segment(2) == "gmaps_multiple_marker" || $this->uri->segment(2) == "gmaps_route" || $this->uri->segment(2) == "gmaps_simple") { ?>
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyB55Np3_WsZwUQ9NS7DP-HnneleZLYZDNw&amp;sensor=true"></script>
  <script src="<?php echo base_url(); ?>assets/modules/gmaps.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_calendar") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/fullcalendar/fullcalendar.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_chartjs") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_datatables") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_owl_carousel") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_sparkline") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_sweet_alert") { ?>
<?php
}elseif ($this->uri->segment(2) == "modules_toastr") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_vector_map") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.indonesia.js"></script>
<?php
}elseif ($this->uri->segment(2) == "auth_register") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "features_post_create") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "features_posts") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "features_profile") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
<?php
}elseif ($this->uri->segment(2) == "features_setting_detail") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/codemirror/lib/codemirror.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/codemirror/mode/javascript/javascript.js"></script>
<?php
}elseif ($this->uri->segment(2) == "features_tickets") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
<?php
}elseif ($this->uri->segment(2) == "utilities_contact") { ?>
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyB55Np3_WsZwUQ9NS7DP-HnneleZLYZDNw&amp;sensor=true"></script>
  <script src="<?php echo base_url(); ?>assets/modules/gmaps.js"></script>
<?php
} ?>

  <!-- Page Specific JS File -->
<?php
if ($this->uri->segment(2) == "" || $this->uri->segment(2) == "index") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/index.js"></script>
<?php
}elseif ($this->uri->segment(2) == "index_0") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/index-0.js"></script>
<?php
}elseif ($this->uri->segment(2) == "bootstrap_modal") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/bootstrap-modal.js"></script>
<?php
}elseif ($this->uri->segment(2) == "components_chat_box") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/components-chat-box.js"></script>
<?php
}elseif ($this->uri->segment(2) == "components_multiple_upload") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/components-multiple-upload.js"></script>
<?php
}elseif ($this->uri->segment(2) == "components_statistic") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/components-statistic.js"></script>
<?php
}elseif ($this->uri->segment(2) == "components_table") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/components-table.js"></script>
<?php
}elseif ($this->uri->segment(2) == "components_user") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/components-user.js"></script>
<?php
}elseif ($this->uri->segment(2) == "forms_advanced_form") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/forms-advanced-forms.js"></script>
<?php
}elseif ($this->uri->segment(2) == "gmaps_advanced_route") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-advanced-route.js"></script>
<?php
}elseif ($this->uri->segment(2) == "gmaps_draggable_marker") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-draggable-marker.js"></script>
<?php
}elseif ($this->uri->segment(2) == "gmaps_geocoding") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-geocoding.js"></script>
<?php
}elseif ($this->uri->segment(2) == "gmaps_geolocation") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-geolocation.js"></script>
<?php
}elseif ($this->uri->segment(2) == "gmaps_marker") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-marker.js"></script>
<?php
}elseif ($this->uri->segment(2) == "gmaps_multiple_marker") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-multiple-marker.js"></script>
<?php
}elseif ($this->uri->segment(2) == "gmaps_route") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-route.js"></script>
<?php
}elseif ($this->uri->segment(2) == "gmaps_simple") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-simple.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_calendar") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-calendar.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_chartjs") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-chartjs.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_datatables") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-datatables.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_ion_icons") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-ion-icons.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_owl_carousel") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-slider.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_sparkline") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-sparkline.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_sweet_alert") { ?>
<?php
}elseif ($this->uri->segment(2) == "modules_toastr") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-toastr.js"></script>
<?php
}elseif ($this->uri->segment(2) == "modules_vector_map") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-vector-map.js"></script>
<?php
}elseif ($this->uri->segment(2) == "auth_register") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/auth-register.js"></script>
<?php
}elseif ($this->uri->segment(2) == "features_post_create") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/features-post-create.js"></script>
<?php
}elseif ($this->uri->segment(2) == "features_posts") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/features-posts.js"></script>
<?php
}elseif ($this->uri->segment(2) == "features_setting_detail") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/features-setting-detail.js"></script>
<?php
}elseif ($this->uri->segment(2) == "utilities_contact") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/utilities-contact.js"></script>
<?php
} ?>

  <!-- Template JS File -->
  <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
</body>
</html>