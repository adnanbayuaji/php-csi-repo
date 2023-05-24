<?php
    //membuat class baru inherit CI_Model
    class Questionnairemodel extends CI_Model
    {
        //fungsi untuk melakukan penambahan data pada database
        function tambah()
        {
            //mengambil data dari view
            //lalu diletakkan ke variabel
            $npk = $this->input->post('npk');
            $jeniskelamin = $this->input->post('jeniskelamin');
            $usia = $this->input->post('usia');
            $pendidikan = $this->input->post('pendidikan');
            $jabatan = $this->input->post('jabatan');
            $lamabekerja = $this->input->post('lamabekerja');
            $plant = $this->input->post('plant');
            $periode = $this->input->post('periode');
            $status = 0;
            $createdate = date("Y-m-d H:i:s");

            //meletakkan isi variabel ke dalam array
            //array adalah nama kolom di tabel pada database
            // $data = array('rol_deskripsi'=>$deskripsi, 'rol_status'=>$status, 'rol_createby'=>$createby, 'rol_createdate'=>$createdate, 'rol_modifby'=>$modifby, 'rol_modifdate'=>$modifdate);
            $data = array('res_npk'=>$npk, 'res_gender'=>$jeniskelamin, 'res_usia'=>$usia, 'res_pendidikan'=>$pendidikan, 'res_jabatan'=>$jabatan, 'res_lamakerja'=>$lamabekerja, 'pla_id'=>$plant, 'res_statusisi'=>$status, 'res_periode'=>$periode, 'res_createby'=>$npk, 'res_createdate'=>$createdate);

            //menginput array $data ke dalam tabel database
            $this->db->insert('csi_ms_responden', $data);

            return $this->db->insert_id();
        }

        //fungsi menampilkan saat akan mengubah
        function cari_data()
        {
            $npk = $this->input->post('npk');
            //membaca dari tabel
            // return $this->db->get_where('csi_ms_responden', array('res_npk'=>$npk), 1)->row();
            $query = $this->db->query("SELECT * FROM csi_ms_responden WHERE res_npk = '$npk' ORDER BY res_id DESC LIMIT 1");
            return $query->row();
        }

        // //fungsi untuk menghapus data di database
        // function deletenol()
        // {
        //     $npk = $this->input->post('npk');
        //     //get id resp
        //     //get id detresp
        //     //delete quesioner with id detresp that 0
        //     //delete detresp with id resp

        //     //delete resp
        //     $this->db->delete('csi_ms_responden', array('res_npk'=>$npk, 'res_statusisi'=>0));
        // }
        
        //fungsi untuk melakukan penambahan data pada database
        function tambahdetres()
        {
            //mengambil data dari view
            //lalu diletakkan ke variabel
            $id_res = $this->input->post('id_res');

            // echo '<script language="javascript">';
            // echo 'alert("a'.$id_res.'")';
            // echo '</script>';
            $bool = null;
            $tampil = $this->db->get('csi_ms_departemen');
            $x = 1;
            if($tampil->num_rows() > 0)
            {
                foreach ($tampil->result() as $data)
                {
                    if($this->input->post('dept'.$x)!=0)
                    {
                        $datas = array('res_id'=>$id_res, 'dept_id'=>$this->input->post('dept'.$x), 'tdr_statusisi'=>0);
                        $this->db->insert('csi_tr_detresponden', $datas);
                        $bool = true;
                    }
                    $x++;
                }
            }
            return $bool;
        }

        function tampil_survey($dept_id, $res_id)
		{
            $query = $this->db->query("SELECT * FROM csi_tr_detresponden WHERE res_id = '$res_id' and dept_id = '$dept_id' ORDER BY tdr_id ASC LIMIT 1");
            // return $query->row();
            if($query->num_rows() > 0)
            {
                foreach ($query->result() as $data)
                {
                    $this->db->select('csi_ms_question.que_id, csi_ms_question.que_kepentingan, csi_ms_question.que_kepuasan');
                    $this->db->from('csi_ms_question');
                    $this->db->join('csi_ms_attribute','csi_ms_attribute.att_id = csi_ms_question.att_id');
                    $this->db->join('csi_ms_scopeofwork','csi_ms_scopeofwork.sow_id = csi_ms_attribute.sow_id');
                    $this->db->where('csi_ms_scopeofwork.dept_id',$data->dept_id);
                    $this->db->where('csi_ms_question.que_status','Aktif');
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
            }
            else
            {
                //kalo query nya kosong
            }
        }

        function tampil_iddept()
		{
            $sedekah = array();
            //cari satu dept
            $id_res = $this->input->post('id_res');
            $query = $this->db->query("SELECT * FROM csi_tr_detresponden WHERE res_id = '$id_res' ORDER BY tdr_id ASC LIMIT 1");
            // return $query->row();
            if($query->num_rows() > 0)
            {
                foreach ($query->result() as $data)
                {
                    $this->db->select('csi_ms_question.que_id, csi_ms_question.que_kepentingan, csi_ms_question.que_kepuasan, csi_ms_scopeofwork.dept_id');
                    $this->db->from('csi_ms_question');
                    $this->db->join('csi_ms_attribute','csi_ms_attribute.att_id = csi_ms_question.att_id');
                    $this->db->join('csi_ms_scopeofwork','csi_ms_scopeofwork.sow_id = csi_ms_attribute.sow_id');
                    $this->db->where('csi_ms_scopeofwork.dept_id',$data->dept_id);
                    $this->db->where('csi_ms_question.que_status','Aktif');
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
            }
            else
            {
                //kalo query nya kosong
            }
        }

        function gettdrid()
        {
            //cari satu dept
            $id_res = $this->input->post('id_res');
            $query = $this->db->query("SELECT * FROM csi_tr_detresponden WHERE res_id = '$id_res' and tdr_statusisi = 0 ORDER BY tdr_id ASC LIMIT 1");
            return $query->row();
        }

        function gettdrid2()
        {
            //cari satu dept
            $id_res = $this->input->post('res_id');
            $query = $this->db->query("SELECT * FROM csi_tr_detresponden WHERE res_id = '$id_res' and tdr_statusisi = 0 ORDER BY tdr_id ASC LIMIT 1");
            return $query->row();
        }

        function getdeptid($id)
        {            
            $query = $this->db->query("SELECT dept_id FROM csi_tr_detresponden WHERE res_id = '$id' and tdr_statusisi = 0 ORDER BY tdr_id ASC LIMIT 1");

            return $query;
        }

        function tambahquestion()
        {
            //ambil data id question dari database where
            //cek isi data radiobutton dan input ke kuesioner
            //simpan yang ada isinya

            //cek iterasi selanjutnya ada dept lagi? kalo ada, buka halaman yang sama dan tampilkan sama seperti sebelumnya

            // echo '<script language="javascript">';
            // echo 'alert("a'.$this->input->post('tdr_id').'")';
            // echo '</script>';

            $sedekah = array();
            $createdate = date("Y-m-d H:i:s");
            $tdr_id = $this->input->post('tdr_id');
            $query = $this->db->query("SELECT * FROM csi_tr_detresponden WHERE tdr_id = '$tdr_id'");
            if($query->num_rows() > 0)
            {
                foreach ($query->result() as $data)
                {
                    $this->db->select('csi_ms_question.que_id, csi_ms_question.que_kepentingan, csi_ms_question.que_kepuasan, csi_ms_scopeofwork.dept_id');
                    $this->db->from('csi_ms_question');
                    $this->db->join('csi_ms_attribute','csi_ms_attribute.att_id = csi_ms_question.att_id');
                    $this->db->join('csi_ms_scopeofwork','csi_ms_scopeofwork.sow_id = csi_ms_attribute.sow_id');
                    $this->db->where('csi_ms_scopeofwork.dept_id',$data->dept_id);
                    $this->db->where('csi_ms_question.que_status','Aktif');
                    $salur=$this->db->get();
                    //memeriksa jumlah row yang ditemukan pada tabel komentar tidak 0
                    if($salur->num_rows()>0)
                    {
                        //perulangan untuk setiap data yang ditemukan
                        //akan diletakkan pada variabel $data
                        foreach($salur->result() as $datang)
                        {
                           if($this->input->post('rb_kepentingan'.$datang->que_id)!=null && $this->input->post('rb_kepuasan'.$datang->que_id)!=null)
                           {
                                $datas = array('tdr_id'=>$tdr_id, 'que_id'=>$datang->que_id, 'tku_poina'=>$this->input->post('rb_kepentingan'.$datang->que_id), 'tku_poinb'=>$this->input->post('rb_kepuasan'.$datang->que_id),  'tku_alasa'=>$this->input->post('alasana'.$datang->que_id), 'tku_alasb'=>$this->input->post('alasanb'.$datang->que_id), 'tku_tglinput'=>$createdate);
                                $this->db->insert('csi_tr_kuisioner', $datas);
                           }
                        }
                        return $sedekah;
                    }  
                }
            }
        }

        function ubah_statusdet()
        {
            $tdr_id = $this->input->post('tdr_id');
            //array adalah nama kolom di tabel pada database
            $data = array('tdr_statusisi'=>1);
            //kondisi yang akan dirubah by id
            $this->db->where('tdr_id', $tdr_id);
            //update tabel ke array
            $this->db->update('csi_tr_detresponden', $data);
        }

        function ubah_statusres()
        {
            $res_id = $this->input->post('res_id');
            //array adalah nama kolom di tabel pada database
            $data = array('res_statusisi'=>1);

            //kondisi yang akan dirubah by id
            $this->db->where('res_id', $res_id);

            //update tabel ke array
            $this->db->update('csi_ms_responden', $data);
        }

        function cek_dept()
        {
            $bool = false;
            $res_id = $this->input->post('res_id');
            $query = $this->db->query("SELECT * FROM csi_tr_detresponden WHERE res_id = '$res_id' and tdr_statusisi = 0 ORDER BY tdr_id ASC LIMIT 1");
            // return $query->row();
            if($query->num_rows() > 0)
            {
                $bool = true;
            }

            return $bool;
        }

        function deptdetail($id)
		{
            $hasil = null;
            $query = $this->db->query("SELECT csi_ms_departemen.dept_id, csi_ms_departemen.dept_nama FROM csi_ms_departemen WHERE csi_ms_departemen.dept_id = '$id'"); 
            //SELECT csi_ms_departemen.dept_id, csi_ms_departemen.dept_nama FROM csi_tr_detresponden JOIN csi_ms_departemen ON csi_ms_departemen.dept_id=csi_tr_detresponden.dept_id WHERE csi_tr_detresponden.res_id = '$id' LIMIT 1
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $data){
                    $hasil[] = $data;
                }
            }
			if(!isset($hasil)){$hasil=null;}
            return $hasil;
        }

        //fungsi untuk membaca data dari database
        function tampil_years()
        {
            //mengambil data dari tabel database ke variabel 
            // $tampil = $this->db->get_where('csi_ms_plant', array('pla_status' => 'Aktif'));

            $this->db->select('res_periode');
            $this->db->distinct();
            $tampil = $this->db->get_where('csi_ms_responden', array('res_statusisi' => 1));
            
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
    }
?>