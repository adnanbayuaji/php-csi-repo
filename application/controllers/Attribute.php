<?php
class Attribute extends CI_Controller
{
    private $filename = "import_data_attribute"; // Kita tentukan nama filenya
    //fungsi untuk menambahkan data
    function tambah()
    {
        $cek = $this->session->userdata('role');
		if($cek!=null)
		{
            $data = array(
                'title' => "Tambah Attribute - CSI GA Div"
            );
            
            //dropdownlist value
            $scope = array('' => '--Pilih Scope of Work--');
            $this->load->model('Scopemodel');
            $cari = $this->Scopemodel->tampil_aktif();
            if($cari != null)
            {
                foreach( $cari as $key) 
                {
                    $scope[$key->sow_id] = $key->sow_deskripsi;
                }
                $data['scope'] = $scope;
            }

            //jika ada post submit yang diterima dalam form
            if($this->input->post('submit'))
            {
                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');

                $this->form_validation->set_rules('attribute', 'Attribute', 'required');
                $this->form_validation->set_rules('scope', 'Scope of Work', 'required');

                if($this->form_validation->run() == true)
                {
                    //load file model 
                    $this->load->model('Attributemodel');

                    //menjalankan fungsi tambah data pada model
                    $this->Attributemodel->tambah();
                    $this->session->set_flashdata('item','tambah');
                    //mengarahkan file ke controller 
                    //artinya mengarahkan ke index
                    redirect ('attribute');
                }
            }  
        
            $this->load->view('attribute/attribute_tambah', $data);
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
                'title' => "Attribute - CSI GA Div"
            );

            //meload file model
            $this->load->model('Attributemodel');

            //mengambil nilai pengambalian dari fungsi tampil pada model
            //return nilai didapat berupa array
            $data['hasil'] = $this->Attributemodel->tampil_user();

            //meload file view
            //sekaligus memberikan parameter $data
            //yang berisi data $hasil dari fungsi tampil pada model
            $this->load->view('attribute/attribute_tampil', $data);
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
            $this->load->model('Attributemodel');
                
            //menjalankan fungsi hapus pada model
            $this->Attributemodel->hapuson($id);
            $this->session->set_flashdata('item','non-aktifkan');
            
            //mengarahkan ke controller
            redirect('attribute');
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
            $this->load->model('Attributemodel');

            //menjalankan fungsi hapus pada model
            $this->Attributemodel->hapusoff($id);
            $this->session->set_flashdata('item','aktifkan');

            //mengarahkan ke controller
            redirect('attribute');
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
                'title' => "Ubah Attribute - CSI GA Div"
            );

            //membaca apakah form submit dilakukan
            if($_POST==null)
            {
                //dropdownlist value
                $scope = array('' => '--Pilih Scope of Work--');
                $this->load->model('Scopemodel');
                $cari = $this->Scopemodel->tampil_aktif();
                if($cari != null)
                {
                    foreach( $cari as $key) 
                    {
                        $scope[$key->sow_id] = $key->sow_deskripsi;
                    }
                    $data['scope'] = $scope;
                }
                
                //meload file model
                $this->load->model('Attributemodel');
                //menjalankan fungsi ubah tampil
                $data['hasil'] = $this->Attributemodel->ubah_tampil($id);

                //meload file view
                $this->load->view('attribute/attribute_ubah', $data);
            }
            else
            {
                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
                $this->form_validation->set_rules('attribute', 'Attribute', 'required');
                $this->form_validation->set_rules('scope', 'Scope of Work', 'required');
                if($this->form_validation->run() == true)
                {
                    //meload file model
                    $this->load->model('Attributemodel');
                    //menjalankan fungsi ubah 
                    $this->Attributemodel->ubah($id);
                    $this->session->set_flashdata('item','ubah');

                    //mengarahkan file controller
                    redirect('attribute');
                }
                else
                {
                    //dropdownlist value
                    $scope = array('' => '--Pilih Scope of Work--');
                    $this->load->model('Scopemodel');
                    $cari = $this->Scopemodel->tampil_aktif();
                    if($cari != null)
                    {
                        foreach( $cari as $key) 
                        {
                            $scope[$key->sow_id] = $key->sow_deskripsi;
                        }
                        $data['scope'] = $scope;
                    }
                    
                    //mengarahkan file controller
                    $this->load->model('Attributemodel');
                    //menjalankan fungsi ubah tampil
                    $data['hasil'] = $this->Attributemodel->ubah_tampil($id);

                    //meload file view
                    $this->load->view('attribute/attribute_ubah', $data);
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
        $fileName = 'excel/csi-attribute-'.time().'.xlsx';  
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
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Attribute');  
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Scope Of Work');

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
       
        $this->load->model('Scopemodel');
        $cari = $this->Scopemodel->tampil_aktif();
        if($cari != null)
        {
            $objPHPExcel->createSheet(1);           
            $objPHPExcel->setActiveSheetIndex(1); // This is the second required line
            $this->validations = $objPHPExcel->getActiveSheet();
            $this->validations->setTitle('Validations');
            $x = 1;
            foreach ( $cari as $key) 
            {
                $this->validations->setCellValue('A'.$x, $key->sow_deskripsi);
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
            $objValidation->setPromptTitle('Pilih Scope of Work');
            $objValidation->setPrompt('Pilih Scope of Work berdasarkan opsi yang tersedia');
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
        $this->load->model('Attributemodel');
		$upload = $this->Attributemodel->upload_file($this->filename);
			
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
                        $this->load->model('Scopemodel');
                        $cari = $this->Scopemodel->tampil();
                        if($cari != null)
                        {
                            foreach ( $cari as $key) 
                            {
                                if($key->sow_deskripsi == $row['B'])
                                {
                                    $row['B'] = $key->sow_id;
                                }
                            }
                        }

                        $this->Attributemodel->insert_import($row['A'], $row['B']);
                    }
                }
                $numrow++; // Tambah 1 setiap kali looping
            }
            // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
            // $this->SiswaModel->insert_multiple($data);
        }
        
        $this->session->set_flashdata('item','import');
		redirect("Attribute"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
}

?>


