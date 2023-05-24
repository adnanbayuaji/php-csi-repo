<?php
class Departemen extends CI_Controller
{
    //fungsi untuk menambahkan data
    function tambah()
    {
        $cek = $this->session->userdata('role');
		if($cek!=null)
		{
            $data = array(
                'title' => "Tambah Departemen - CSI GA Div"
            );
            
            //jika ada post submit yang diterima dalam form
            if($this->input->post('submit'))
            {
                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');

                $this->form_validation->set_rules('nama', 'Nama', 'required');

                if($this->form_validation->run() == true)
                {
                    //load file model 
                    $this->load->model('Departemenmodel');

                    //menjalankan fungsi tambah data pada model
                    $this->Departemenmodel->tambah();
                    $this->session->set_flashdata('item','tambah');
                    //mengarahkan file ke controller 
                    //artinya mengarahkan ke index
                    redirect ('departemen');
                }
            }  
        
            $this->load->view('departemen/departemen_tambah', $data);
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
                'title' => "Departemen - CSI GA Div"
            );

            //meload file model
            $this->load->model('Departemenmodel');

            //mengambil nilai pengambalian dari fungsi tampil pada model
            //return nilai didapat berupa array
            $data['hasil'] = $this->Departemenmodel->tampil();

            //meload file view
            //sekaligus memberikan parameter $data
            //yang berisi data $hasil dari fungsi tampil pada model
            $this->load->view('departemen/departemen_tampil', $data);
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
            $this->load->model('Departemenmodel');
                
            //menjalankan fungsi hapus pada model
            $this->Departemenmodel->hapuson($id);
            $this->session->set_flashdata('item','non-aktifkan');
            
            //mengarahkan ke controller
            redirect('Departemen');
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
            $this->load->model('Departemenmodel');

            //menjalankan fungsi hapus pada model
            $this->Departemenmodel->hapusoff($id);
            $this->session->set_flashdata('item','aktifkan');

            //mengarahkan ke controller
            redirect('Departemen');
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
                'title' => "Ubah Departemen - CSI GA Div"
            );

            //membaca apakah form submit dilakukan
            if($_POST==null)
            {
                //meload file model
                $this->load->model('Departemenmodel');
                //menjalankan fungsi ubah tampil
                $data['hasil'] = $this->Departemenmodel->ubah_tampil($id);

                //meload file view
                $this->load->view('departemen/departemen_ubah', $data);
            }
            else
            {
                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
                $this->form_validation->set_rules('nama', 'Nama', 'required');
                if($this->form_validation->run() == true)
                {
                    //meload file model
                    $this->load->model('Departemenmodel');
                    //menjalankan fungsi ubah 
                    $this->Departemenmodel->ubah($id);
                    $this->session->set_flashdata('item','ubah');

                    //mengarahkan file controller
                    redirect('Departemen');
                }
                else
                {
                    //mengarahkan file controller
                    $this->load->model('Departemenmodel');
                    //menjalankan fungsi ubah tampil
                    $data['hasil'] = $this->Departemenmodel->ubah_tampil($id);

                    //meload file view
                    $this->load->view('departemen/departemen_ubah', $data);
                }
            }
        }
		else
		{
			header('location:'.base_url());
        }
    }
}
?>