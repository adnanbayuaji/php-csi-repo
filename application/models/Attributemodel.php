<?php
    //membuat class baru inherit CI_Model
    class Attributemodel extends CI_Model
    {
        //fungsi untuk melakukan penambahan data pada database
        function tambah()
        {
            //mengambil data dari view
            //lalu diletakkan ke variabel
            $attribute = $this->input->post('attribute');
            $sow_id = $this->input->post('scope');
            $status = 'Aktif';
            $createby = $this->session->userdata('id');
            $createdate = date("Y-m-d H:i:s");

            //meletakkan isi variabel ke dalam array
            //array adalah nama kolom di tabel pada database
            // $data = array('rol_deskripsi'=>$deskripsi, 'rol_status'=>$status, 'rol_createby'=>$createby, 'rol_createdate'=>$createdate, 'rol_modifby'=>$modifby, 'rol_modifdate'=>$modifdate);
            $data = array('att_deskripsi'=>$attribute, 'sow_id'=>$sow_id, 'att_status'=>$status, 'att_createby'=>$createby, 'att_createdate'=>$createdate);

            //menginput array $data ke dalam tabel database
            $this->db->insert('csi_ms_attribute', $data);
        }

        //fungsi untuk membaca data dari database
        function tampil()
        {
            //mengambil data dari tabel database ke variabel 
            $tampil = $this->db->get('csi_ms_attribute');
            
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
            $this->db->select('csi_ms_attribute.att_id, csi_ms_attribute.att_deskripsi, csi_ms_scopeofwork.sow_deskripsi, csi_ms_attribute.att_status');
            $this->db->from('csi_ms_attribute');
            $this->db->join('csi_ms_scopeofwork','csi_ms_scopeofwork.sow_id = csi_ms_attribute.sow_id');
            // $this->db->where('salur_sedekah.id_amil',$id);
            // $this->db->order_by('csi_ms_attribute.att_status', 'asc');
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
            $tampil = $this->db->get_where('csi_ms_attribute', array('att_status' => 'Aktif'));
            
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
            $data = array('att_status'=>$status);
            $this->db->where('att_id', $id);
            $this->db->update('csi_ms_attribute', $data);
        }

        function hapusoff($id)
        {
            $status = "Aktif";
            $data = array('att_status'=>$status);
            $this->db->where('att_id', $id);
            $this->db->update('csi_ms_attribute', $data);
        }

        //fungsi menampilkan saat akan mengubah
        function ubah_tampil($id)
        {
            //membaca dari tabel
            return $this->db->get_where('csi_ms_attribute', array('att_id'=>$id))->row();
        }

        //fungsi ubah data
        function ubah($id)
        {
            //mengambil dari post ke var
            $attribute = $this->input->post('attribute');
            $sow_id = $this->input->post('scope');
            $modifby = $this->session->userdata('id');
            $modifdate = date("Y-m-d H:i:s");

            //meletakkan isi variabel ke dalam array
            //array adalah nama kolom di tabel pada database
            $data = array('att_deskripsi'=>$attribute, 'sow_id'=>$sow_id, 'att_modifby'=>$modifby, 'att_modifdate'=>$modifdate);

            //kondisi yang akan dirubah by id
            $this->db->where('att_id', $id);

            //update tabel ke array
            $this->db->update('csi_ms_attribute', $data);
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

        public function insert_import($desk, $sow_id){
            // if (count($data) > 0) {
            //     foreach($data as $datas)
			// 	{
            //         $this->db->insert('beam_dtl_equipment', $data);
			// 	}
            // }
            
            $createby = $this->session->userdata('id');
            $createdate = date("Y-m-d H:i:s");
            $data = array('att_deskripsi'=>$desk, 'sow_id'=>$sow_id, 'att_status'=>'Aktif', 'att_createby'=>$createby, 'att_createdate'=>$createdate);

            $this->db->insert('csi_ms_attribute', $data);
        }
    }
?>