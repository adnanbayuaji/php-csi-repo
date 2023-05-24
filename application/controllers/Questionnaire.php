<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questionnaire extends CI_Controller {
	public function _construct()
	{
		session_start();
	}
	
	public function index()
	{		
		$data = array(
			'title' => "CSI Questionnaire"
		);

		$plant = array('' => '--Pilih Lokasi--');
        $this->load->model('Plantmodel');
        $cari = $this->Plantmodel->tampil_aktif();
        if($cari != null)
        {
            foreach ( $cari as $key) 
            {                
				$plant[$key->pla_id] = $key->pla_kodearea." - ".$key->pla_nama;
            }
            $data['plant'] = $plant;
		}
		
		$this->load->view('questionnaire/questionnaire1', $data);
	}

	//fungsi untuk menambahkan data
    function tambah()
    {
		//jika ada post submit yang diterima dalam form
		if($this->input->post('submit'))
		{
			$this->load->helper(array('form', 'url'));
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');

			$newdata = array(
				'tr_npk'  => $this->input->post('npk'),
				'tr_jeniskelamin'  => $this->input->post('jeniskelamin'),
				'tr_usia'  => $this->input->post('usia'),
				'tr_pendidikan'  => $this->input->post('pendidikan'),
				'tr_jabatan'  => $this->input->post('jabatan'),
				'tr_lamabekerja'  => $this->input->post('lamabekerja'),
				'tr_plant'  => $this->input->post('plant'),
				'tr_periode'  => $this->input->post('periode')
			);
			
			$this->session->set_userdata($newdata);

			$this->form_validation->set_rules('npk', 'NPK', 'required');
			$this->form_validation->set_rules('jeniskelamin', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('usia', 'Usia', 'required');
			$this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
			$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
			$this->form_validation->set_rules('lamabekerja', 'Lama Bekerja', 'required');
			$this->form_validation->set_rules('plant', 'Plant', 'required');
			$this->form_validation->set_rules('periode', 'Periode', 'required');

			if($this->form_validation->run() == true)
			{
				//load file model 
				$this->load->model('Questionnairemodel');

				//menjalankan fungsi tambah data pada model
				// $this->Questionnairemodel->deletenol();
				$id_res = $this->Questionnairemodel->tambah();

				$this->session->unset_userdata(array('tr_npk', 'tr_jeniskelamin', 'tr_usia', 'tr_pendidikan', 'tr_jabatan', 'tr_lamabekerja', 'tr_plant', 'tr_periode'));
				
				$data = array(
					'title' => "CSI Questionnaire"
				);
				
				//dropdownlist value
				$departemen = array('' => '--Pilih Departemen--');
				$this->load->model('Departemenmodel');

				$data['departemen'] = $this->Departemenmodel->tampil_aktif();
				$data['id_res'] = $id_res;
					
				$this->load->view('questionnaire/questionnaire_choosedept', $data);
			}
			else
			{
				$this->index();
			}		
		}  
		else if($this->input->post('cari'))
		{
			$this->load->helper(array('form', 'url'));
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');

			$this->form_validation->set_rules('npk', 'NPK', 'required');

			if($this->form_validation->run() == true)
			{
				// $this->index();
				$this->load->model('Questionnairemodel');
				//menjalankan fungsi ubah tampil
				$data['hasil'] = $this->Questionnairemodel->cari_data();
		
				$plant = array('' => '--Pilih Lokasi--');
				$this->load->model('Plantmodel');
				$cari = $this->Plantmodel->tampil_aktif();
				if($cari != null)
				{
					foreach ( $cari as $key) 
					{                
						$plant[$key->pla_id] = $key->pla_kodearea." - ".$key->pla_nama;
					}
					$data['plant'] = $plant;
				}

				if(empty($data['hasil']))
				{
					$this->session->set_flashdata('item','npk_notfound');
			    	redirect('questionnaire');
				}
				else
				{
					$data['title'] = "CSI Questionnaire";

					$this->load->view('questionnaire/questionnaire1', $data);
				}
			}	
			else
			{
			    $this->session->set_flashdata('item','npk_required');
			    redirect('questionnaire');
			}
		}
	}
	
	//fungsi untuk menambahkan data
    function pilihdept()
    {
		//jika ada post submit yang diterima dalam form
		if($this->input->post('submit'))
		{
			//load file model 
			$this->load->model('Questionnairemodel');

			//menjalankan fungsi tambah data pada model
			//$this->Questionnairemodel->deletenol();
			
			if($this->Questionnairemodel->tambahdetres()!=null)
			{
				$data = array(
					'title' => "CSI Questionnaire"
				);

				//cari dept_id dari res_id
				$res_id = $this->input->post('id_res');
				$this->load->model('Questionnairemodel');
				$records = $this->Questionnairemodel->getdeptid($res_id);
				foreach($records->result_array() as $row){
					$data['deptdetail'] = $this->Questionnairemodel->deptdetail($row['dept_id']);
					$data['questionnaire'] = $this->Questionnairemodel->tampil_survey($row['dept_id'], $res_id);
					$data['rowgettdrid'] = $this->Questionnairemodel->gettdrid();
				}
				
				$this->load->view('questionnaire/questionnaire_survey', $data);
			}
			else
			{
				$data = array(
					'title' => "CSI Questionnaire"
				);
				
				//dropdownlist value
				$departemen = array('' => '--Pilih Departemen--');
				$this->load->model('Departemenmodel');

				$data['departemen'] = $this->Departemenmodel->tampil_aktif();
				$data['id_res'] = $this->input->post('id_res');
					
				$this->load->view('questionnaire/questionnaire_choosedept', $data);
			}
		} 
	}

	// function choosedept()
	// {
	// 	$data = array(
	// 		'title' => "CSI Questionnaire"
	// 	);
		
	// 	//dropdownlist value
	// 	$departemen = array('' => '--Pilih Departemen--');
	// 	$this->load->model('Departemenmodel');

	// 	$data['departemen'] = $this->Departemenmodel->tampil_aktif();
	// 	// $data['id_res'] = $this->session->userdata('id_res');
			
	// 	$this->load->view('questionnaire/questionnaire_choosedept', $data);
	// }

	function tambahquestion()
	{
		if($this->input->post('submit'))
		{
			//validasi data questioner
			//????

			//insert data questioner
			$this->load->model('Questionnairemodel');
			$this->Questionnairemodel->tambahquestion();

			//rubah status isi detaildept menjadi 1
			$this->Questionnairemodel->ubah_statusdet();

			//dapet data yang 0 ada atau ngga
			$this->load->model('Questionnairemodel');
			$cekada = $this->Questionnairemodel->cek_dept();

			//cek dulu ada yang 0 atau ngga. 0? questionnaire_survey : redirect('questionnaire')
			if($cekada == true) 	
			{
				$data = array(
					'title' => "CSI Questionnaire"
				);
				
				$this->load->model('Questionnairemodel');
				$res_id = $this->input->post('res_id');
				$records = $this->Questionnairemodel->getdeptid($res_id);
				foreach($records->result_array() as $row){
					$data['deptdetail'] = $this->Questionnairemodel->deptdetail($row['dept_id']);
					$data['questionnaire'] = $this->Questionnairemodel->tampil_survey($row['dept_id'], $res_id);
					$data['rowgettdrid'] = $this->Questionnairemodel->gettdrid2();
				}
					
				$this->load->view('questionnaire/questionnaire_survey', $data);
			}
			else
			{
				$this->load->model('Questionnairemodel');
				//rubah status isi detaildept menjadi 1
				$this->Questionnairemodel->ubah_statusres();
				//cekdata kalo 0	
				$this->session->set_flashdata('item','tambahkan!');
				redirect('questionnaire');
			}
		}
	}
}
?>