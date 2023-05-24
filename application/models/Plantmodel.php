<?php
    //membuat class baru inherit CI_Model
    class Plantmodel extends CI_Model
    {
        //fungsi untuk melakukan penambahan data pada database
        function tambah()
        {
            //mengambil data dari view
            //lalu diletakkan ke variabel
            $nama = $this->input->post('nama');
            $kode = $this->input->post('kode');
            $createby = $this->session->userdata('id');
            $createdate = date("Y-m-d H:i:s");

            //meletakkan isi variabel ke dalam array
            //array adalah nama kolom di tabel pada database
            $data = array('pla_nama'=>$nama, 'pla_status'=>"Aktif", 'pla_kodearea'=>$kode, 'pla_createby'=>$createby, 'pla_createdate'=>$createdate);

            //menginput array $data ke dalam tabel database
            $this->db->insert('csi_ms_plant', $data);
        }

        //fungsi untuk membaca data dari database
        function tampil()
        {
            //mengambil data dari tabel database ke variabel 
            $tampil = $this->db->get('csi_ms_plant');
            
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

        //fungsi untuk membaca data dari database
        function tampil_aktif()
        {
            //mengambil data dari tabel database ke variabel 
            $tampil = $this->db->get_where('csi_ms_plant', array('pla_status' => 'Aktif'));
            
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
            $data = array('pla_status'=>$status);
            $this->db->where('pla_id', $id);
            $this->db->update('csi_ms_plant', $data);
        }

        function hapusoff($id)
        {
            $status = "Aktif";
            $data = array('pla_status'=>$status);
            $this->db->where('pla_id', $id);
            $this->db->update('csi_ms_plant', $data);
        }

        //fungsi menampilkan saat akan mengubah
        function ubah_tampil($id)
        {
            //membaca dari tabel
            return $this->db->get_where('csi_ms_plant', array('pla_id'=>$id))->row();
        }

        //fungsi ubah data
        function ubah($id)
        {
            //mengambil dari post ke var
            $nama = $this->input->post('nama');
            $kode = $this->input->post('kode');
            $modifby = $this->session->userdata('id');
            $modifdate = date("Y-m-d H:i:s");

            //meletakkan isi variabel ke dalam array
            //array adalah nama kolom di tabel pada database
            $data = array('pla_nama'=>$nama, 'pla_kodearea'=>$kode, 'pla_modifby'=>$modifby, 'pla_modifdate'=>$modifdate);

            //kondisi yang akan dirubah by id
            $this->db->where('pla_id', $id);

            //update tabel ke array
            $this->db->update('csi_ms_plant', $data);
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

        // public function insert_import($iteplant){
        //     // if (count($data) > 0) {
        //     //     foreach($data as $datas)
		// 	// 	{
        //     //         $this->db->insert('csi_dtl_equipment', $data);
		// 	// 	}
        //     // }
            
        //     $createby = $this->session->userdata('id');
        //     $createdate = date("Y-m-d H:i:s");
        //     $data = array('pla_nama'=>$iteplant, 'pla_createby'=>$createby, 'pla_createdate'=>$createdate);

        //     $this->db->insert('csi_ms_plant', $data);
        // }
    }
?>