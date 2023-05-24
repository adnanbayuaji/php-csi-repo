<?php
class Scope extends CI_Controller
{
    private $filename = "import_data_scope"; // Kita tentukan nama filenya
    //fungsi untuk menambahkan data
    function tambah()
    {
        $cek = $this->session->userdata('role');
		if($cek!=null)
		{
            $data = array(
                'title' => "Tambah Scope of Work - CSI GA Div"
            );
            
            //dropdownlist value
            $dept = array('' => '--Pilih Departemen--');
            $this->load->model('Departemenmodel');
            $cari = $this->Departemenmodel->tampil_aktif();
            if($cari != null)
            {
                foreach ( $cari as $key) 
                {
                    $dept[$key->dept_id] = $key->dept_nama;
                }
                $data['dept'] = $dept;
            }

            //jika ada post submit yang diterima dalam form
            if($this->input->post('submit'))
            {
                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');

                $this->form_validation->set_rules('scope', 'Scope of Work', 'required');
                $this->form_validation->set_rules('dept', 'Departemen', 'required');

                if($this->form_validation->run() == true)
                {
                    //load file model 
                    $this->load->model('Scopemodel');

                    //menjalankan fungsi tambah data pada model
                    $this->Scopemodel->tambah();
                    $this->session->set_flashdata('item','tambah');
                    //mengarahkan file ke controller 
                    //artinya mengarahkan ke index
                    redirect ('scope');
                }
            }  
        
            $this->load->view('scope/scope_tambah', $data);
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
                'title' => "Scope of Work - CSI GA Div"
            );

            //meload file model
            $this->load->model('Scopemodel');

            //mengambil nilai pengambalian dari fungsi tampil pada model
            //return nilai didapat berupa array
            $data['hasil'] = $this->Scopemodel->tampil_user();

            //meload file view
            //sekaligus memberikan parameter $data
            //yang berisi data $hasil dari fungsi tampil pada model
            $this->load->view('scope/scope_tampil', $data);
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
            $this->load->model('Scopemodel');
                
            //menjalankan fungsi hapus pada model
            $this->Scopemodel->hapuson($id);
            $this->session->set_flashdata('item','non-aktifkan');
            
            //mengarahkan ke controller
            redirect('scope');
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
            $this->load->model('Scopemodel');

            //menjalankan fungsi hapus pada model
            $this->Scopemodel->hapusoff($id);
            $this->session->set_flashdata('item','aktifkan');

            //mengarahkan ke controller
            redirect('scope');
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
                'title' => "Ubah Scope of Work - CSI GA Div"
            );

            //membaca apakah form submit dilakukan
            if($_POST==null)
            {
                //dropdownlist value
                $dept = array('' => '--Pilih Departemen--');
                $this->load->model('Departemenmodel');
                $cari = $this->Departemenmodel->tampil_aktif();
                if($cari != null)
                {
                    foreach ( $cari as $key) 
                    {
                        $dept[$key->dept_id] = $key->dept_nama;
                    }
                    $data['dept'] = $dept;
                }
                
                //meload file model
                $this->load->model('Scopemodel');
                //menjalankan fungsi ubah tampil
                $data['hasil'] = $this->Scopemodel->ubah_tampil($id);

                //meload file view
                $this->load->view('scope/scope_ubah', $data);
            }
            else
            {
                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
                $this->form_validation->set_rules('scope', 'Scope of Work', 'required');
                $this->form_validation->set_rules('dept', 'Departemen', 'required');
                if($this->form_validation->run() == true)
                {
                    //meload file model
                    $this->load->model('Scopemodel');
                    //menjalankan fungsi ubah 
                    $this->Scopemodel->ubah($id);
                    $this->session->set_flashdata('item','ubah');

                    //mengarahkan file controller
                    redirect('scope');
                }
                else
                {
                    //dropdownlist value
                    $dept = array('' => '--Pilih Departemen--');
                    $this->load->model('Departemenmodel');
                    $cari = $this->Departemenmodel->tampil_aktif();
                    if($cari != null)
                    {
                        foreach ( $cari as $key) 
                        {
                            $dept[$key->dept_id] = $key->dept_nama;
                        }
                        $data['dept'] = $dept;
                    }
                    
                    //mengarahkan file controller
                    $this->load->model('Scopemodel');
                    //menjalankan fungsi ubah tampil
                    $data['hasil'] = $this->Scopemodel->ubah_tampil($id);

                    //meload file view
                    $this->load->view('scope/scope_ubah', $data);
                }
            }
        }
		else
		{
			header('location:'.base_url());
        }
    }

    
    // create xlsx
    function ekspor() {
        // create file name
        $fileName = 'excel/csi-sow-'.time().'.xlsx';  
        // load excel library
        $this->load->library('excel');
        // $mobiledata = $this->export->mobileList();
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getProperties()->setCreator("GA Ops 3")
            ->setLastModifiedBy("Adnan Bayu Aji")
            ->setTitle("CSI Import")
            ->setSubject("Template CSI Import Data")
            ->setDescription("Template CSI Import Data XLSX, generated using PHP classes.")
            ->setKeywords("template csi import data")
            ->setCategory("Template CSI Import Data");

        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Scope Of Work');  
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Departemen');

        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '00e676')
            )
        );
        
        $objPHPExcel->setActiveSheetIndex(0);
        foreach(range('A','B') as $columnID) {
            if($columnID=='A')
            {
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(30);
            }
            else
            {
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(20);
            }
            $objPHPExcel->getActiveSheet()->getStyle($columnID."1")->getFont()->setBold( true );
            $objPHPExcel->getActiveSheet()->getStyle($columnID."1")->applyFromArray($style);
        }

        $thick = array ();
        $thick['borders']=array();
        $thick['borders']['allborders']=array();
        $thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THICK ;
        $objPHPExcel->getActiveSheet()->getStyle ( 'A1:B1' )->applyFromArray ($thick);
        
        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_DASHDOT ;
        $objPHPExcel->getActiveSheet()->getStyle ( 'A2:B1000' )->applyFromArray($thin);

        $BStyle = array(
            'borders' => array(
              'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_THICK
              )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle ( 'A2:B1000' )->applyFromArray($BStyle);

        $this->load->model('Departemenmodel');
        $cari = $this->Departemenmodel->tampil_aktif();
        if($cari != null)
        {
            $objPHPExcel->createSheet(1);           
            $objPHPExcel->setActiveSheetIndex(1); // This is the second required line
            $this->validations = $objPHPExcel->getActiveSheet();
            $this->validations->setTitle('Validations');
            $x = 1;
            foreach ( $cari as $key) 
            {
                $this->validations->setCellValue('A'.$x, $key->dept_nama);
                $x++;
            }
            $x-=1;
        }

        for($i = 2; $i < 1001; $i++)
        {
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                ->setCellValue('B'.$i, "--Pilih--")
                ;

            $objValidation = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getDataValidation();
            $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
            $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Pilih Departemen');
            $objValidation->setPrompt('Pilih Departemen berdasarkan opsi yang tersedia');
            $objValidation->setFormula1('Validations!A1:A'.$x);
        }

        $objPHPExcel->getSheetByName('Validations')->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
        $objPHPExcel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_BREAK_PREVIEW);

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(base_url().$fileName);              
    }

    public function import(){
        // load excel library
        $this->load->library('excel');
        $this->load->model('Scopemodel');
		$upload = $this->Scopemodel->upload_file($this->filename);
			
            if($upload['result'] == "success"){ // Jika proses upload sukses
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load(FCPATH.'excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
            
            // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
            $data = array();
            
            $numrow = 1;
            foreach($sheet as $row){
                if($numrow > 1){
                    if($row['A']!= "" && $row['B']!= "--Pilih--")
                    {
                        // Kita push (add) array data ke variabel data
                        $this->load->model('Departemenmodel');
                        $cari = $this->Departemenmodel->tampil();
                        if($cari != null)
                        {
                            foreach ( $cari as $key) 
                            {
                                if($key->dept_nama == $row['B'])
                                {
                                    $row['B'] = $key->dept_id;
                                }
                            }
                        }

                        $this->Scopemodel->insert_import($row['A'], $row['B']);
                    }
                }
                $numrow++; // Tambah 1 setiap kali looping
            }
            // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
            // $this->SiswaModel->insert_multiple($data);
        }
        
        $this->session->set_flashdata('item','import');
		redirect("Scope"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
}
?>