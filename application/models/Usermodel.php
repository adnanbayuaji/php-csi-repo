<?php
    //membuat class baru inherit CI_Model
    class Usermodel extends CI_Model
    {
        //fungsi untuk melakukan penambahan data pada database
        function tambah()
        {
            //mengambil data dari view
            //lalu diletakkan ke variabel
            $rol_name = $this->input->post('role');
            $usr_status = "Aktif";
            $usr_nama = $this->input->post('nama');
            $usr_pass = md5($this->input->post('pass'));
            $usr_namalengkap = $this->input->post('fullnama');
            $usr_email = $this->input->post('email');
            $usr_npk = $this->input->post('npk');
            $pla_id = $this->input->post('plant');
            $createby = $this->session->userdata('id');
            $createdate = date("Y-m-d H:i:s");

            if($_FILES['file']['name']!=null)
            {
                $ekstensi = array('png','jpg','jpeg');
                $nama = $_FILES['file']['name'];
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $nama);
                $eksten = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $imagename = $file_name . time() . "." . $eksten;
                // $x = explode('.',$nama);
                // $eksten = strtolower(end($x));
                $file_tmp = $_FILES['file']['tmp_name'];
                $size = $_FILES['file']['size'];	
            }
            else
            {
                $imagename = 'logo.png';
                $eksten = 'png';
                $ekstensi = array('png','jpg','jpeg');
                $size=100;
            }       

            if(in_array($eksten, $ekstensi)===true)
            {
                if($size<=2000000)
                {
                    move_uploaded_file($file_tmp,DOCROOT.'/csi/gambar/'.$imagename);
                    $data = array('rol_name'=>$rol_name, 'usr_status'=>$usr_status, 'pla_id'=>$pla_id, 'usr_nama'=>$usr_nama, 'usr_pass'=>$usr_pass, 'usr_foto'=>$imagename, 'usr_namalengkap'=>$usr_namalengkap, 'usr_email'=>$usr_email, 'usr_npk'=>$usr_npk, 'usr_createby'=>$createby, 'usr_createdate'=>$createdate);
                    //menginput array $data ke dalam tabel database
                    $this->db->insert('csi_ms_user', $data);
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
            
        }

        //fungsi untuk membaca data dari database
        function tampil()
        {
            //mengambil data dari tabel database ke variabel 
            $tampil = $this->db->get('csi_ms_user');
            
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
            $data = array('usr_status'=>$status);
            $this->db->where('usr_id', $id);
            $this->db->update('csi_ms_user', $data);
        }

        function hapusoff($id)
        {
            $status = "Aktif";
            $data = array('usr_status'=>$status);
            $this->db->where('usr_id', $id);
            $this->db->update('csi_ms_user', $data);
        }

        //fungsi menampilkan saat akan mengubah
        function ubah_tampil($id)
        {
            //membaca dari tabel
            return $this->db->get_where('csi_ms_user', array('usr_id'=>$id))->row();
        }

        //fungsi menampilkan saat akan mengubah
        function ubah_tampilprofil($id)
        {
            $sedekah = array();
            $this->db->select('csi_ms_user.usr_id, csi_ms_user.rol_id, csi_ms_user.usr_namalengkap, csi_ms_user.usr_npk, csi_ms_user.usr_status, csi_ms_role.rol_deskripsi, csi_ms_user.usr_nama, csi_ms_user.usr_pass, csi_ms_user.usr_foto, csi_ms_user.usr_email, csi_ms_plant.pla_nama');
            $this->db->from('csi_ms_user');
            $this->db->join('csi_ms_role', 'csi_ms_user.rol_id = csi_ms_role.rol_id');
            $this->db->join('csi_ms_plant', 'csi_ms_plant.pla_id = csi_ms_user.pla_id');
            $this->db->where('csi_ms_user.usr_id',$id);
            $salur=$this->db->get()->row();
            //membaca dari tabel
            return $salur;
        }

        //fungsi ubah data
        function reset($id)
        {
            $usr_pass = md5('Astra123');
            $data = array('usr_pass'=>$usr_pass);
            $this->db->where('usr_id', $id);
            $this->db->update('csi_ms_user', $data);
        }

        //fungsi ubah data
        function ubah($id)
        {
            //mengambil dari post ke var
            $rol_name = $this->input->post('role');
            $usr_nama = $this->input->post('nama');
            $usr_pass = md5($this->input->post('pass'));
            $usr_namalengkap = $this->input->post('fullnama');
            $usr_email = $this->input->post('email');
            $usr_npk = $this->input->post('npk');
            $pla_id = $this->input->post('plant');
            $modifby = $this->session->userdata('id');
            $modifdate = date("Y-m-d H:i:s");

            $bools = false;
            if($_FILES['file']['name']!=null)
            {
                echo "<script>
                    alert('cek".$_FILES['file']['name']."');
                    </script>";
                $ekstensi = array('png','jpg','jpeg');
                $nama = $_FILES['file']['name'];
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $nama);
                $eksten = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $imagename = $file_name . time() . "." . $eksten;
                // $x = explode('.',$nama);
                // $eksten = strtolower(end($x));
                $file_tmp = $_FILES['file']['tmp_name'];
                $size = $_FILES['file']['size'];
                $bools = true;
            }
            
            if($bools == true)
            {
                if(in_array($eksten, $ekstensi)==true)
                {
                    if($size<=2000000)
                    {
                        move_uploaded_file($file_tmp,DOCROOT.'/csi/gambar/'.$imagename);
                        //meletakkan isi variabel ke dalam array
                        //array adalah nama kolom di tabel pada database
                        $data = array('rol_name'=>$rol_name, 'pla_id'=>$pla_id, 'usr_nama'=>$usr_nama, 'usr_foto'=>$imagename, 'usr_namalengkap'=>$usr_namalengkap, 'usr_email'=>$usr_email, 'usr_npk'=>$usr_npk, 'usr_modifby'=>$modifby, 'usr_modifdate'=>$modifdate);

                        //kondisi yang akan dirubah by id
                        $this->db->where('usr_id', $id);

                        //update tabel ke array
                        $this->db->update('csi_ms_user', $data);
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }
            else
            {
                $data = array('rol_name'=>$rol_name, 'pla_id'=>$pla_id, 'usr_nama'=>$usr_nama, 'usr_namalengkap'=>$usr_namalengkap, 'usr_npk'=>$usr_npk, 'usr_email'=>$usr_email, 'usr_modifby'=>$modifby, 'usr_modifdate'=>$modifdate);
                $this->db->where('usr_id', $id);
                $this->db->update('csi_ms_user', $data);
                return true;
            }
        }

        //fungsi ubah data
        function ubah_pass($id)
        {
            //mengambil dari post ke var
            $pass = md5($this->input->post('passnew'));

            //meletakkan isi variabel ke dalam array
            //array adalah nama kolom di tabel pada database
            $data = array('usr_pass'=>$pass);

            //kondisi yang akan dirubah by id
            $this->db->where('usr_id', $id);

            //update tabel ke array
            $this->db->update('csi_ms_user', $data);
        }

        function tampil_user()
		{
			$sedekah = array();
            $this->db->select('csi_ms_user.usr_id, csi_ms_user.usr_nama, csi_ms_plant.pla_kodearea, csi_ms_user.rol_name, csi_ms_user.usr_status');
            $this->db->from('csi_ms_user');
            $this->db->join('csi_ms_plant', 'csi_ms_plant.pla_id = csi_ms_user.pla_id');
            // $this->db->where('salur_sedekah.id_amil',$id);
            $this->db->order_by('csi_ms_user.usr_status', 'asc');
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
        
        function platampil_user($plaid)
		{
			$sedekah = array();
            $this->db->select('csi_ms_user.usr_id, csi_ms_user.usr_nama, csi_ms_plant.pla_kodearea, csi_ms_role.rol_deskripsi, csi_ms_user.usr_status');
            $this->db->from('csi_ms_user');
            $this->db->join('csi_ms_role', 'csi_ms_role.rol_id = csi_ms_user.rol_id');
            $this->db->join('csi_ms_plant', 'csi_ms_plant.pla_id = csi_ms_user.pla_id');
            $this->db->where('csi_ms_user.pla_id',$plaid);
            $this->db->order_by('csi_ms_user.usr_status', 'asc');
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
        
        function returnbooldata($id, $plaid)
        {
            $this->db->select('csi_ms_user.pla_id');
            $this->db->from('csi_ms_user');
            $array = array('csi_ms_user.pla_id' => $plaid, 'csi_ms_user.usr_id' => $id);
            $this->db->where($array);
            $salur=$this->db->get();
            //memeriksa jumlah row yang ditemukan pada tabel komentar tidak 0
            if($salur->num_rows()>0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>