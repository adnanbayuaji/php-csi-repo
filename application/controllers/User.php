<?php
class User extends CI_Controller
{
    //fungsi untuk menambahkan data
    function tambah()
    {
        
        $cek = $this->session->userdata('role');
		if($cek!=null)
		{
            $data = array(
                'title' => "Tambah Pengguna - CSI GA Div"
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
            
            //jika ada post submit yang diterima dalam form
            if($this->input->post('submit'))
            {

                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
    
                $this->form_validation->set_rules('role', 'Hak Akses', 'required');
                $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
                $this->form_validation->set_rules('fullnama', 'Nama Lengkap', 'required');
                $this->form_validation->set_rules('plant', 'Lokasi Pabrik', 'required');
                $this->form_validation->set_rules('npk', 'NPK', 'required');
                $this->form_validation->set_rules('pass', 'Kata Sandi', 'required');
                $this->form_validation->set_rules('repass', 'Ulang Kata Sandi', 'required|matches[pass]');
                $this->form_validation->set_rules('email', 'Surat Elektronik (Email)', 'trim|required|valid_email');
    
                if($this->form_validation->run() == true)
                {
                    //load file model 
                    $this->load->model('Usermodel');
    
                    //menjalankan fungsi tambah data pada model
                    $bool = $this->Usermodel->tambah();
                    if($bool)
                    {
                        $this->session->set_flashdata('item','tambah');
                        //mengarahkan file ke controller 
                        //artinya mengarahkan ke index
                        redirect ('user');
                    }
                    else
                    {
                        echo "<script>
                        alert('Format yang dimasukkan salah atau Size > 2MB!');
                        window.location.href='tambah';
                        </script>";
                    }
                }
            }  
            
            $this->load->view('user/user_tambah', $data);
        }
		else
		{
			header('location:'.base_url());
        }

    }

    //fungsi pertama kali diload ketika memanggil controller
    function index()
    {   
        $cek = $this->session->userdata('role');
		if($cek!=null)
		{
            $data = array(
                'title' => "Pengguna - CSI GA Div"
            );
                    
            //meload file model
            $this->load->model('Usermodel');
            $data['hasil'] = $this->Usermodel->tampil_user();
            // $data['hasil'] = $this->Usermodel->platampil_user($this->session->userdata('plant'));
            $this->load->view('user/user_tampil', $data);
        }
		else
		{
			header('location:'.base_url());
        }
    }

    //fungsi hapus data
    function deleteon($id)
    {
        $cek = $this->session->userdata('role');
		if($cek!=null)
		{
            //meload file model
            $this->load->model('Usermodel');

            //menjalankan fungsi hapus pada model
            $this->Usermodel->hapuson($id);
            $this->session->set_flashdata('item','non-aktifkan');

            //mengarahkan ke controller
            redirect('User');
        }
		else
		{
			header('location:'.base_url());
        }
    }

    //fungsi hapus data
    function deleteoff($id)
    {
        $cek = $this->session->userdata('role');
		if($cek!=null)
		{
            //meload file model
            $this->load->model('Usermodel');

            //menjalankan fungsi hapus pada model
            $this->Usermodel->hapusoff($id);
            $this->session->set_flashdata('item','aktifkan');

            //mengarahkan ke controller
            redirect('User');
        }
		else
		{
			header('location:'.base_url());
        }
    }

    //fungsi untuk melakukan perubahan data
    function update($id)
    {
        $cek = $this->session->userdata('role');
		if($cek!=null)
		{
            $data = array(
                'title' => "Ubah Pengguna - CSI GA Div"
            );

            //membaca apakah form submit dilakukan
            if($_POST==null)
            {
                
                $cek = $this->session->userdata('role');
                if($cek!=null)
                {
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

                    //meload file model
                    $this->load->model('Usermodel');
                    //menjalankan fungsi ubah tampil
                    $data['hasil'] = $this->Usermodel->ubah_tampil($id);
                    
                    //meload file view
                    $this->load->view('user/user_ubah', $data);
                }
                else
                {
                    header('location:'.base_url());
                }
            }
            else
            {

                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');

                $this->form_validation->set_rules('role', 'Hak Akses', 'required');
                $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
                $this->form_validation->set_rules('fullnama', 'Nama Lengkap', 'required');
                $this->form_validation->set_rules('npk', 'NPK', 'required');
                $this->form_validation->set_rules('plant', 'Lokasi Pabrik', 'required');
                $this->form_validation->set_rules('email', 'Surat Elektronik (Email)', 'trim|required|valid_email');

                if($this->form_validation->run() == true)
                {
                    
                    //meload file model
                    $this->load->model('Usermodel');
                    
                    //menjalankan fungsi ubah 
                    $bool = $this->Usermodel->ubah($id);
                    if($bool)
                    {
                        $this->session->set_flashdata('item','ubah');
                        //mengarahkan file controller
                        redirect('User');
                    }
                    else
                    {
                        echo "<script>
                        alert('Format yang dimasukkan salah atau Size > 2MB!');
                        window.location.href='tambah';
                        </script>";
                    }
                }
                else
                {
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
                    
                    //meload file model
                    $this->load->model('Usermodel');

                    //menjalankan fungsi ubah tampil
                    $data['hasil'] = $this->Usermodel->ubah_tampil($id);

                    //meload file view
                    $this->load->view('user/user_ubah', $data);
                }
            }
        }
		else
		{
			header('location:'.base_url());
        }
    }

    //fungsi untuk melakukan perubahan data
    function ubahpass()
    {
        $id =  $this->uri->segment(3);
        $pass =  $this->uri->segment(4);
        //membaca apakah form submit dilakukan
        if($_POST==null)
        {
            $this->load->model('Menumodel');
            if($this->session->userdata('id')==$id)
            {
                $data['akses']=$this->Menumodel->getstatus($this->session->userdata('role'), 'pengguna');
                $data['menu']=$this->Menumodel->getmenu($this->session->userdata('role'));
                //meload file model
                $this->load->model('Usermodel');

                //menjalankan fungsi ubah tampil
                $data['hasil'] = $this->Usermodel->ubah_tampil($id);

                //meload file view
                $this->load->view('user_ubahpass', $data);
            }
            else
            {
                redirect('User/ubahpass/'.$this->session->userdata('id'));
            }
        }
        else
        {
            $this->load->helper(array('form', 'url'));
            $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
            $this->form_validation->set_rules('passnew', 'Kata Sandi Baru', 'required');
            $this->form_validation->set_rules('repass', 'Ulangi Kata Sandi Baru', 'required|matches[passnew]');
            $this->form_validation->set_rules('passlast', 'Kata Sandi Lama', 'required');
            if($this->form_validation->run() == true)
            {
                if($pass == md5($this->input->post('passlast')))
                {
                    //meload file model
                    $this->load->model('Usermodel');
                    
                    //menjalankan fungsi ubah 
                    $this->Usermodel->ubah_pass($id, $pass);
                    $this->session->set_flashdata('item','ubah');
                    
                    //mengarahkan file controller
                    redirect('User/profil/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('item','error_passlast');
                    
                    $this->load->model('Menumodel');
                    if($this->session->userdata('id')==$id)
                    {
                        $data['akses']=$this->Menumodel->getstatus($this->session->userdata('role'), 'pengguna');
                        $data['menu']=$this->Menumodel->getmenu($this->session->userdata('role'));
                        //meload file model
                        $this->load->model('Usermodel');

                        //menjalankan fungsi ubah tampil
                        $data['hasil'] = $this->Usermodel->ubah_tampil($id);

                        //meload file view
                        $this->load->view('user_ubahpass', $data);
                    }
                    else
                    {
                        redirect('User/ubahpass/'.$this->session->userdata('id'));
                    }
                }
            }
            else
            {
                $this->load->model('Menumodel');
                if($this->session->userdata('id')==$id)
                {
                    $data['akses']=$this->Menumodel->getstatus($this->session->userdata('role'), 'pengguna');
                    $data['menu']=$this->Menumodel->getmenu($this->session->userdata('role'));
                    //meload file model
                    $this->load->model('Usermodel');

                    //menjalankan fungsi ubah tampil
                    $data['hasil'] = $this->Usermodel->ubah_tampil($id);

                    //meload file view
                    $this->load->view('user_ubahpass', $data);
                }
                else
                {
                    redirect('User/ubahpass/'.$this->session->userdata('id'));
                }
            }
        }
    }

    //fungsi untuk melakukan perubahan data
    function profil($id)
    {
        $this->load->model('Menumodel');
        if($this->session->userdata('id')==$id)
        {
            $data['akses']=$this->Menumodel->getstatus($this->session->userdata('role'), 'pengguna');
            $data['menu']=$this->Menumodel->getmenu($this->session->userdata('role'));
                       
            //meload file model
            $this->load->model('Usermodel');

            //menjalankan fungsi ubah tampil
            $data['hasil'] = $this->Usermodel->ubah_tampilprofil($id);

            //meload file view
            $this->load->view('user_profil', $data);
        }
        else
        {
            redirect('User/profil/'.$this->session->userdata('id'));
        }
    }

    //fungsi untuk melakukan perubahan data
    function ubahprofil($id)
    {
        //membaca apakah form submit dilakukan
        if($_POST==null)
        {
            $this->load->model('Menumodel');
            if($this->session->userdata('id')==$id)
            {
                $data['akses']=$this->Menumodel->getstatus($this->session->userdata('role'), 'pengguna');
                $data['menu']=$this->Menumodel->getmenu($this->session->userdata('role'));
                //dropdownlist value
                $role = array('' => '--Pilih Hak Akses--');
                $this->load->model('Rolemodel');
                $cari = $this->Rolemodel->tampil_aktif();
                if($cari != null)
                {
                    foreach ( $cari as $key) 
                    {
                        $role[$key->rol_id] = $key->rol_deskripsi;
                    }
                    $data['role'] = $role;
                }

                //dropdownlist value
                $plant = array('' => '--Pilih Lokasi Pabrik--');
                $this->load->model('Plantmodel');
                $cari = $this->Plantmodel->tampil_aktif();
                if($cari != null)
                {
                    foreach ( $cari as $key) 
                    {
                        $plant[$key->pla_id] = $key->pla_nama;
                    }
                    $data['plant'] = $plant;
                }
                
                //meload file model
                $this->load->model('Usermodel');
    
                //menjalankan fungsi ubah tampil
                $data['hasil'] = $this->Usermodel->ubah_tampil($id);
    
                //meload file view
                $this->load->view('user_ubahprofil', $data);
            }
            else
            {
                redirect('User/ubahprofil/'.$this->session->userdata('id'));
            }
        }
        else
        {
            $this->load->helper(array('form', 'url'));
            $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');

            $this->form_validation->set_rules('role', 'Hak Akses', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('plant', 'Lokasi Pabrik', 'required');
            $this->form_validation->set_rules('email', 'Surat Elektronik (Email)', 'trim|required|valid_email');
            
            if($this->form_validation->run() == true)
            {
                
                //meload file model
                $this->load->model('Usermodel');
                
                //menjalankan fungsi ubah 
                $bool = $this->Usermodel->ubah($id);
                if($bool)
                {
                    $this->session->set_flashdata('item','ubah');
                    //mengarahkan file controller
                    redirect('User/profil/'.$id);
                }
                else
                {
                    echo "<script>
                    alert('Format yang dimasukkan salah atau Size > 2MB!');
                    window.location.href='tambah';
                    </script>";
                }
            }
            else
            {
                $this->load->model('Menumodel');
                $data['akses']=$this->Menumodel->getstatus($this->session->userdata('role'), 'pengguna');
                $data['menu']=$this->Menumodel->getmenu($this->session->userdata('role'));
                //dropdownlist value
                $role = array('' => '--Pilih Hak Akses--');
                $this->load->model('Rolemodel');
                $cari = $this->Rolemodel->tampil_aktif();
                if($cari != null)
                {
                    foreach ( $cari as $key) 
                    {
                        $role[$key->rol_id] = $key->rol_deskripsi;
                    }
                    $data['role'] = $role;
                }

                //dropdownlist value
                $plant = array('' => '--Pilih Lokasi Pabrik--');
                $this->load->model('Plantmodel');
                $cari = $this->Plantmodel->tampil_aktif();
                if($cari != null)
                {
                    foreach ( $cari as $key) 
                    {
                        $plant[$key->pla_id] = $key->pla_nama;
                    }
                    $data['plant'] = $plant;
                }
                
                //meload file model
                $this->load->model('Usermodel');

                //menjalankan fungsi ubah tampil
                $data['hasil'] = $this->Usermodel->ubah_tampil($id);

                //meload file view
                $this->load->view('user_ubahprofil', $data);
            }
        }
    }

    function reset($id)
    {
        //meload file model
        $this->load->model('Usermodel');

        //menjalankan fungsi hapus pada model
        $this->Usermodel->reset($id);
        $this->session->set_flashdata('item','reset');

        //mengarahkan ke controller
        redirect('User');
    }
}
?>