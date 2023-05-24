<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function controladminuser($get_value)
    {
        $data = array(
            'title' => "CSI Dashboard"
        );
        
        $this->load->model('Graphmodel');
        $data['datas'] = $this->Graphmodel->tampil_grafik($get_value);
        $data['datas_plant'] = $this->Graphmodel->tampil_grafik_plant($get_value);
        $data['datas_top'] = $this->Graphmodel->topChart($get_value);
        $data['datas_bot'] = $this->Graphmodel->bottomChart($get_value);
        $data['datas_voc'] = $this->Graphmodel->voiceOfCustomer($get_value);
        $data['datas_dept'] = $this->Graphmodel->tampil_grafik_dept($get_value);

        $years = array('' => '-- Tampil Semua --');
        $this->load->model('Questionnairemodel');
        $cari = $this->Questionnairemodel->tampil_years();
        if($cari != null)
        {
            foreach ( $cari as $key) 
            {                
                $years[$key->res_periode] = $key->res_periode;
            }
            $data['datas_ddl'] = $years;
        }

        return $data;
    }

    public function setddlyears()
    {
        //jika ada post submit yang diterima dalam form
        $get_value = "";
        $this->session->unset_userdata(array('years'));
		if($this->input->get('ddl_years'))
		{
            $get_value = $this->input->get('ddl_years');

            $newdata = array(
                'years'  => $this->input->get('ddl_years')
            );

            $this->session->set_userdata($newdata);
        }

        return $get_value;
    }

	public function admin()
	{
        $get_value=$this->setddlyears();

        $cek = $this->session->userdata('role');
        if($cek!=null)
        {
            $data = $this->controladminuser($get_value);
            // $data['datas_ddl'] = $this->Graphmodel->tampil_ddl();

            $this->load->view('admin/index', $data);
        }
        else
        {
            header('location:'.base_url());
        }
    }
    
    public function user()
	{
		$get_value=$this->setddlyears();

        $cek = $this->session->userdata('role');
        if($cek!=null)
        {
            $data = $this->controladminuser($get_value);

            $this->load->view('user/index', $data);
        }
        else
        {
            header('location:'.base_url());
        }
	}

	public function getViewData()
	{
        $tchData = $this->input->post('tchData');
        $tchYear = $this->input->post('tchYear');
        if(isset($tchData) and !empty($tchData)){
            $this->load->model('Graphmodel');
            $records = $this->Graphmodel->getViewData($tchData, $tchYear);
            $output = '';
            // $row = $records->row();
            foreach($records->result_array() as $row){
                if($row["que_id"]=="")$row["que_id"]="-";
                if($row["que_kepentingan"]=="") $row["que_kepentingan"] = "-";
                if($row["que_kepuasan"]=="") $row["que_kepuasan"] = "-";
                if($row["att_deskripsi"]=="") $row["att_deskripsi"] = "-";
                if($row["sow_deskripsi"]=="") $row["sow_deskripsi"] = "-";
                $output .= '
            <div class="modal-header">
                <h5 class="modal-title">Detail Data '.$row["att_deskripsi"].'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" align="center">
                        <div class="form-group">
                            <label class="control-label">Departemen</label><br/>'.$row["dept_nama"].'
                        </div>
                        <div class="form-group">
                            <label class="control-label">Scope Of Work</label><br/>'.$row["sow_deskripsi"].'
                        </div>
                        <div class="form-group">
                            <label class="control-label">Attribute</label><br/>'.$row["att_deskripsi"].'
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" align="center">
                        <div class="form-group">
                            <label class="control-label">Pertanyaan Kepuasan </label><br/>'.$row["que_kepuasan"].'
                        </div>
                        <div class="form-group">';
                        $this->load->model('Graphmodel');
                        $ress = $this->Graphmodel->tampilanalasa($row["que_id"], $tchYear);

                        if($ress != null)
                        {
                            $output.='<div class="table-responsive text-align:center">
                                    <table id="example999" class="table table-striped center">
                                        <tr>
                                            <th><center>Poin</center></th>
                                            <th><center>Alasan</center></th>
                                        </tr>';
                            foreach ( $ress as $rowss) {    
                                $output .= '<tr>
                                <td>'.$rowss->tku_poina.'</td>
                                <td>'.$rowss->tku_alasa.'</td>
                                </tr>';
                            }
                            $output .='
                                </table>
                            </div>
                            ';
                        }
                        $output .= '</div>
                    </div>
                    <div class="col-md-6" align="center">
                        <div class="form-group">
                            <label class="control-label">Pertanyaan Kepentingan </label><br/>'.$row["que_kepentingan"].'
                        </div>
                        <div class="form-group">';
                        $this->load->model('Graphmodel');
                        $ress = $this->Graphmodel->tampilanalasb($row["que_id"], $tchYear);
                        if($ress != null)
                        {
                            $output.='<div class="table-responsive text-align:center">
                                    <table id="example999" class="table table-striped center">
                                        <tr>
                                            <th><center>Poin</center></th>
                                            <th><center>Alasan</center></th>
                                        </tr>';
                            foreach($ress as $rowss){    
                                $output .= '<tr>
                                <td>'.$rowss->tku_poinb.'</td>
                                <td>'.$rowss->tku_alasb.'</td>
                                </tr>';
                            }
                            $output .='
                                </table>
                            </div>
                            ';
                        }
                        $output .= '</div>
                    </div>
                </div>
            </div>';
				
        //         <hr>
        //         <div class="row">
        //             <div class="col-md-4">
        //                 <div class="form-group" align="center">
        //                     <label class="control-label">Status</label><br/>'.$row["tch_statuscek"].'
        //                 </div>
        //             </div>
        //             <div class="col-md-4">
        //                 <div class="form-group" align="center">
        //                     <label class="control-label">Status Pengajuan</label><br/>'.$row["tch_approval"].'
        //                 </div>
        //             </div>
        //             <div class="col-md-4">
        //                 <div class="form-group" align="center">
        //                     <label class="control-label">Alasan Penolakan</label><br/>'.$row["tch_alasan"].'
        //                 </div>
        //             </div>
        //         </div>
        //         <hr>';
        //         if($row["tch_statusketerangan"]=="1"||$row["tch_statuscatatan"]=="1"||$row["tch_statusfeedback"]=="1"){
        //             $output .= '
        //             <div class="table-responsive text-align:center">
        //             <table id="example999" class="table table-striped center">
        //                 <thead>
        //                     <tr>
        //                         <th><center>Dari</center></th>
        //                         <th><center>Deskripsi</center></th>
        //                         <th><center>Bukti</center></th>
        //                     </tr>
        //                 </thead>
        //                 <tbody class="table">';
        //                 if($row["tch_statusketerangan"]=="1"){
        //                     $output .= '
        //                     <tr>
        //                         <td><center>Teknisi</center></td>
        //                         <td>'.$row["tch_keterangan"].'</td>
        //                         <td><center><img src="'.base_url().'/gambar/'.$row["tch_fotoketerangan"].'" height="100" alt="User Image"></center></td>
        //                     </tr>';
        //                 }
        //                 if($row["tch_statuscatatan"]=="1"){
        //                     $output .= '
        //                     <tr>
        //                         <td><center>PIC GA</center></td>
        //                         <td>'.$row["tch_catatan"].'</td>
        //                         <td><center><img src="'.base_url().'/gambar/'.$row["tch_fotocatatan"].'" height="100" alt="User Image"></center></td>
        //                     </tr>';
        //                 }
        //                 if($row["tch_statusfeedback"]=="1"){
        //                     $output .= '
        //                     <tr>
        //                         <td><center>PIC User</center></td>
        //                         <td>'.$row["tch_feedback"].'</td>
        //                         <td><center><img src="'.base_url().'/gambar/'.$row["tch_fotofeedback"].'" height="100" alt="User Image"></center></td>
        //                     </tr>';
        //                 }
        //                 $output .= '
        //                 </tbody>
        //             </table>
        //             </div>
        //             <hr/>
        //             ';
        //         }

        //         $this->load->model('Checksheetmodel');
        //         $ress = $this->Checksheetmodel->tampilansaae($row["tch_id"]);
        //         if(!empty($ress))
        //         {
        //             $output .= '
        //             <div class="table-responsive text-align:center">
        //                 <table id="example998" class="table table-striped center">
        //                     <thead>
        //                         <tr>
        //                             <th><center>Poin Pemeriksaan</center></th>
        //                             <th><center>Standard</center></th>
        //                             <th><center>Angka</center></th>
        //                         </tr>
        //                     </thead>
        //                     <tbody class="table">
        //                     ';
        //             foreach($ress->result_array() as $rowss){    
        //                 $output .= '<tr>
        //                 <td>'.$rowss["dpo_namapoin"].'</td>
        //                 <td>'.$rowss["dpo_standar_min"].'-'.$rowss["dpo_standar_max"].'</td>
        //                 <td>'.$rowss["tdp_nilai"].' '.$rowss["dpo_satuan"].'</td>
        //                 </tr>';
        //             }
        //             $output .='
        //                     </tbody>
        //                 </table>
        //             </div>
        //             ';
        //         }

        //         $this->load->model('Checksheetmodel');
        //         $ress = $this->Checksheetmodel->tampilanjoss($row["tch_id"]);
        //         if(!empty($ress))
        //         {
        //             $output .= '
        //             <div class="table-responsive text-align:center">
        //                 <table id="example998" class="table table-striped center">
        //                     <thead>
        //                         <tr>
        //                             <th><center>Item Pemeriksaan</center></th>
        //                             <th><center>Kriteria</center></th>
        //                         </tr>
        //                     </thead>
        //                     <tbody class="table">
        //                     ';
        //             foreach($ress->result_array() as $rowss){    
        //                 $output .= '<tr>
        //                 <td>'.$rowss["ite_obyek"].'</td>';
        //                 if($rowss["tdi_kondisi"]=='1')$output .= '<td>OK</td></tr>';
        //                 if($rowss["tdi_kondisi"]=='2')$output .= '<td>Repaired</td></tr>';
        //                 if($rowss["tdi_kondisi"]=='3')$output .= '<td>Broken</td></tr>';
        //             }
        //             $output .='
        //                     </tbody>
        //                 </table>
        //             </div>
        //             ';
        //         }
                
        //         $output .= '
        //         </div>
        //                 ';

            }				
            echo $output;
        }
        else {
            echo '
            <h4 class="modal-title">Detail Data <label class="control-label" id="lblJudul"></label></h4>
            </div>
            <div class="modal-body">
            <center><ul class="list-group"><li class="list-group-item">'.'Select a Checksheet'.'</li></ul></center>';
        }
 
    }
}
?>