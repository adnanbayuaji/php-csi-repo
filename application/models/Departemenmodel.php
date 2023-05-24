<?php
    //membuat class baru inherit CI_Model
    class Departemenmodel extends CI_Model
    {
        //fungsi untuk melakukan penambahan data pada database
        function tambah()
        {
            //mengambil data dari view
            //lalu diletakkan ke variabel
            $nama = $this->input->post('nama');
            $status = 'Aktif';
            $createby = $this->session->userdata('id');
            $createdate = date("Y-m-d H:i:s");

            //meletakkan isi variabel ke dalam array
            //array adalah nama kolom di tabel pada database
            // $data = array('rol_deskripsi'=>$deskripsi, 'rol_status'=>$status, 'rol_createby'=>$createby, 'rol_createdate'=>$createdate, 'rol_modifby'=>$modifby, 'rol_modifdate'=>$modifdate);
            $data = array('dept_nama'=>$nama, 'dept_status'=>$status, 'dept_createby'=>$createby, 'dept_createdate'=>$createdate);

            //menginput array $data ke dalam tabel database
            $this->db->insert('csi_ms_departemen', $data);
        }

        //fungsi untuk membaca data dari database
        function tampil()
        {
            //mengambil data dari tabel database ke variabel 
            $tampil = $this->db->get('csi_ms_departemen');
            
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
            $tampil = $this->db->get_where('csi_ms_departemen', array('dept_status' => 'Aktif'));
            
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
            $data = array('dept_status'=>$status);
            $this->db->where('dept_id', $id);
            $this->db->update('csi_ms_departemen', $data);
        }

        function hapusoff($id)
        {
            $status = "Aktif";
            $data = array('dept_status'=>$status);
            $this->db->where('dept_id', $id);
            $this->db->update('csi_ms_departemen', $data);
        }

        //fungsi menampilkan saat akan mengubah
        function ubah_tampil($id)
        {
            //membaca dari tabel
            return $this->db->get_where('csi_ms_departemen', array('dept_id'=>$id))->row();
        }

        //fungsi ubah data
        function ubah($id)
        {
            //mengambil dari post ke var
            $nama = $this->input->post('nama');
            $modifby = $this->session->userdata('id');
            $modifdate = date("Y-m-d H:i:s");

            //meletakkan isi variabel ke dalam array
            //array adalah nama kolom di tabel pada database
            $data = array('dept_nama'=>$nama, 'dept_modifby'=>$modifby, 'dept_modifdate'=>$modifdate);

            //kondisi yang akan dirubah by id
            $this->db->where('dept_id', $id);

            //update tabel ke array
            $this->db->update('csi_ms_departemen', $data);
        }
    }
?>