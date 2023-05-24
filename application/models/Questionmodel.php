<?php
    //membuat class baru inherit CI_Model
    class Questionmodel extends CI_Model
    {
        //fungsi untuk melakukan penambahan data pada database
        function tambah()
        {
            //mengambil data dari view
            //lalu diletakkan ke variabel
            $att_id = $this->input->post('attribute');
            $kepentingan = $this->input->post('kepentingan');
            $kepuasan = $this->input->post('kepuasan');
            $status = 'Aktif';
            $createby = $this->session->userdata('id');
            $createdate = date("Y-m-d H:i:s");

            //meletakkan isi variabel ke dalam array
            //array adalah nama kolom di tabel pada database
            // $data = array('rol_deskripsi'=>$deskripsi, 'rol_status'=>$status, 'rol_createby'=>$createby, 'rol_createdate'=>$createdate, 'rol_modifby'=>$modifby, 'rol_modifdate'=>$modifdate);
            $data = array('que_kepentingan'=>$kepentingan, 'que_kepuasan'=>$kepuasan, 'att_id'=>$att_id, 'que_status'=>$status, 'que_createby'=>$createby, 'que_createdate'=>$createdate);

            //menginput array $data ke dalam tabel database
            $this->db->insert('csi_ms_question', $data);
        }

        //fungsi untuk membaca data dari database
        function tampil()
        {
            //mengambil data dari tabel database ke variabel 
            $tampil = $this->db->get('csi_ms_question');
            
            //memeriksa jumlah row != 0
            if($tampil->num_rows() > 0)
            {
                //perulangan data diletakkan ke $data
                foreach ($tampil->result() as $data)
                {
                    //setiap data yang ditemukan diletakkan ke array 
                    $hasil[] = $data;
                }
                //mengembalikan nilai data dari array
                return $hasil;
            }
        }

        function tampil_user()
		{
			$sedekah = array();
            $this->db->select('csi_ms_question.que_id, csi_ms_question.que_kepentingan, csi_ms_question.que_kepuasan, csi_ms_attribute.att_deskripsi, csi_ms_scopeofwork.sow_deskripsi,csi_ms_departemen.dept_nama, csi_ms_question.que_status');
            $this->db->from('csi_ms_question');
            $this->db->join('csi_ms_attribute','csi_ms_attribute.att_id = csi_ms_question.att_id');
            $this->db->join('csi_ms_scopeofwork','csi_ms_scopeofwork.sow_id = csi_ms_attribute.sow_id');
            $this->db->join('csi_ms_departemen','csi_ms_scopeofwork.dept_id = csi_ms_departemen.dept_id');
            // $this->db->where('salur_sedekah.id_amil',$id);
            $this->db->order_by('csi_ms_question.que_status', 'asc');
            $this->db->order_by('csi_ms_departemen.dept_nama', 'asc');
            $this->db->order_by('csi_ms_scopeofwork.sow_deskripsi', 'asc');
            $salur=$this->db->get();
            //memeriksa jumlah row yang ditemukan pada tabel komentar tidak 0
            if($salur->num_rows()>0)
            {
                //perulangan untuk setiap data yang ditemukan
                //akan diletakkan pada variabel $data
            	foreach($salur->result() as $data)
				{
					$sedekah[] = $data;
				}
                return $sedekah;
            }
        }

        //fungsi untuk membaca data dari database
        function tampil_aktif()
        {
            //mengambil data dari tabel database ke variabel 
            $tampil = $this->db->get_where('csi_ms_question', array('que_status' => 'Aktif'));
            
            //memeriksa jumlah row != 0
            if($tampil->num_rows() > 0)
            {
                //perulangan data diletakkan ke $data
                foreach ($tampil->result() as $data)
                {
                    //setiap data yang ditemukan diletakkan ke array 
                    $hasil[] = $data;
                }
                //mengembalikan nilai data dari array
                return $hasil;
            }
        }

        //fungsi untuk menghapus data di database
        function hapuson($id)
        {
            $status = "Tidak Aktif";
            $data = array('que_status'=>$status);
            $this->db->where('que_id', $id);
            $this->db->update('csi_ms_question', $data);
        }

        function hapusoff($id)
        {
            $status = "Aktif";
            $data = array('que_status'=>$status);
            $this->db->where('que_id', $id);
            $this->db->update('csi_ms_question', $data);
        }

        //fungsi menampilkan saat akan mengubah
        function ubah_tampil($id)
        {
            //membaca dari tabel
            return $this->db->get_where('csi_ms_question', array('que_id'=>$id))->row();
        }

        //fungsi ubah data
        function ubah($id)
        {
            //mengambil dari post ke var
            $att_id = $this->input->post('attribute');
            $kepentingan = $this->input->post('kepentingan');
            $kepuasan = $this->input->post('kepuasan');
            $modifby = $this->session->userdata('id');
            $modifdate = date("Y-m-d H:i:s");

            //meletakkan isi variabel ke dalam array
            //array adalah nama kolom di tabel pada database
            $data = array('que_kepentingan'=>$kepentingan, 'que_kepuasan'=>$kepuasan, 'att_id'=>$att_id, 'que_modifby'=>$modifby, 'que_modifdate'=>$modifdate);

            //kondisi yang akan dirubah by id
            $this->db->where('que_id', $id);

            //update tabel ke array
            $this->db->update('csi_ms_question', $data);
        }

        // Fungsi untuk melakukan proses upload file
        function upload_file($filename){
            $this->load->library('upload'); // Load librari upload
            
            $config['upload_path'] = './excel/';
            $config['allowed_types'] = 'xlsx';
            $config['max_size']	= '2048';
            $config['overwrite'] = true;
            $config['file_name'] = $filename;

            $this->upload->initialize($config); // Load konfigurasi uploadnya
            if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
                // Jika berhasil :
                $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
                return $return;
            }else{
                // Jika gagal :
                $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
                return $return;
            }
        }

        public function insert_import($desk_kepentingan, $desk_kepuasan, $att_id){
            // if (count($data) > 0) {
            //     foreach($data as $datas)
			// 	{
            //         $this->db->insert('beam_dtl_equipment', $data);
			// 	}
            // }
            
            $createby = $this->session->userdata('id');
            $createdate = date("Y-m-d H:i:s");
            $data = array('que_kepentingan'=>$desk_kepentingan, 'que_kepuasan'=>$desk_kepuasan, 'att_id'=>$att_id, 'que_status'=>'Aktif', 'que_createby'=>$createby, 'que_createdate'=>$createdate);

            $this->db->insert('csi_ms_question', $data);
        }
    }
?>