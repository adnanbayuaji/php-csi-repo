<?php
class Question extends CI_Controller
{
    private $filename = "import_data_question"; // Kita tentukan nama filenya
    //fungsi untuk menambahkan data
    function tambah()
    {
        $cek = $this->session->userdata('role');
		if($cek!=null)
		{
            $data = array(
                'title' => "Tambah Question - CSI GA Div"
            );
            
            //dropdownlist value
            $attribute = array('' => '--Pilih Attribute--');
            $this->load->model('Attributemodel');
            $cari = $this->Attributemodel->tampil_aktif();
            if($cari != null)
            {
                foreach( $cari as $key) 
                {
                    $attribute[$key->att_id] = $key->att_deskripsi;
                }
                $data['attribute'] = $attribute;
            }

            //jika ada post submit yang diterima dalam form
            if($this->input->post('submit'))
            {
                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');

                $this->form_validation->set_rules('attribute', 'Attribute', 'required');
                $this->form_validation->set_rules('kepentingan', 'Kepentingan', 'required');
                $this->form_validation->set_rules('kepuasan', 'Kepuasan', 'required');

                if($this->form_validation->run() == true)
                {
                    //load file model 
                    $this->load->model('Questionmodel');

                    //menjalankan fungsi tambah data pada model
                    $this->Questionmodel->tambah();
                    $this->session->set_flashdata('item','tambah');
                    //mengarahkan file ke controller 
                    //artinya mengarahkan ke index
                    redirect ('question');
                }
            }  
        
            $this->load->view('question/question_tambah', $data);
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
                'title' => "Question - CSI GA Div"
            );

            //meload file model
            $this->load->model('Questionmodel');

            //mengambil nilai pengambalian dari fungsi tampil pada model
            //return nilai didapat berupa array
            $data['hasil'] = $this->Questionmodel->tampil_user();

            //meload file view
            //sekaligus memberikan parameter $data
            //yang berisi data $hasil dari fungsi tampil pada model
            $this->load->view('question/question_tampil', $data);
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
            $this->load->model('Questionmodel');
                
            //menjalankan fungsi hapus pada model
            $this->Questionmodel->hapuson($id);
            $this->session->set_flashdata('item','non-aktifkan');
            
            //mengarahkan ke controller
            redirect('question');
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
            $this->load->model('Questionmodel');

            //menjalankan fungsi hapus pada model
            $this->Questionmodel->hapusoff($id);
            $this->session->set_flashdata('item','aktifkan');

            //mengarahkan ke controller
            redirect('question');
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
                'title' => "Ubah Question - CSI GA Div"
            );

            //membaca apakah form submit dilakukan
            if($_POST==null)
            {
                //dropdownlist value
                $attribute = array('' => '--Pilih Attribute--');
                $this->load->model('Attributemodel');
                $cari = $this->Attributemodel->tampil_aktif();
                if($cari != null)
                {
                    foreach( $cari as $key) 
                    {
                        $attribute[$key->att_id] = $key->att_deskripsi;
                    }
                    $data['attribute'] = $attribute;
                }
                
                //meload file model
                $this->load->model('Questionmodel');
                //menjalankan fungsi ubah tampil
                $data['hasil'] = $this->Questionmodel->ubah_tampil($id);

                //meload file view
                $this->load->view('question/question_ubah', $data);
            }
            else
            {
                $this->load->helper(array('form', 'url'));
                $this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
               
                $this->form_validation->set_rules('attribute', 'Attribute', 'required');
                $this->form_validation->set_rules('kepentingan', 'Kepentingan', 'required');
                $this->form_validation->set_rules('kepuasan', 'Kepuasan', 'required');
                if($this->form_validation->run() == true)
                {
                    //meload file model
                    $this->load->model('Questionmodel');
                    //menjalankan fungsi ubah 
                    $this->Questionmodel->ubah($id);
                    $this->session->set_flashdata('item','ubah');

                    //mengarahkan file controller
                    redirect('question');
                }
                else
                {
                    //dropdownlist value
                    $attribute = array('' => '--Pilih Attribute--');
                    $this->load->model('Attributemodel');
                    $cari = $this->Attributemodel->tampil_aktif();
                    if($cari != null)
                    {
                        foreach( $cari as $key) 
                        {
                            $attribute[$key->att_id] = $key->att_deskripsi;
                        }
                        $data['attribute'] = $attribute;
                    }
                    
                    //mengarahkan file controller
                    $this->load->model('Questionmodel');
                    //menjalankan fungsi ubah tampil
                    $data['hasil'] = $this->Questionmodel->ubah_tampil($id);

                    //meload file view
                    $this->load->view('question/question_ubah', $data);
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
        $fileName = 'excel/csi-question-'.time().'.xlsx';  
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
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Pertanyaan Kepentingan');  
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Pertanyaan Kepuasan');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Attribute');

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
        foreach(range('A','C') as $columnID) {
            if($columnID=='A')
            {
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(60);
            }
            else if($columnID=='B')
            {
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(60);
            }
            else
            {
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(40);
            }
            $objPHPExcel->getActiveSheet()->getStyle($columnID."1")->getFont()->setBold( true );
            $objPHPExcel->getActiveSheet()->getStyle($columnID."1")->applyFromArray($style);
        }

        $thick = array ();
        $thick['borders']=array();
        $thick['borders']['allborders']=array();
        $thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THICK ;
        $objPHPExcel->getActiveSheet()->getStyle ( 'A1:C1' )->applyFromArray ($thick);
        
        $thin = array ();
        $thin['borders']=array();
        $thin['borders']['allborders']=array();
        $thin['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_DASHDOT ;
        $objPHPExcel->getActiveSheet()->getStyle ( 'A2:C1000' )->applyFromArray($thin);

        $BStyle = array(
            'borders' => array(
              'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_THICK
              )
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle ( 'A2:C1000' )->applyFromArray($BStyle);
       
        $this->load->model('Attributemodel');
        $cari = $this->Attributemodel->tampil_aktif();
        if($cari != null)
        {
            $objPHPExcel->createSheet(1);           
            $objPHPExcel->setActiveSheetIndex(1); // This is the second required line
            $this->validations = $objPHPExcel->getActiveSheet();
            $this->validations->setTitle('Validations');
            $x = 1;
            foreach ( $cari as $key) 
            {
                $this->validations->setCellValue('A'.$x, $key->att_deskripsi);
                $x++;
            }
            $x-=1;
        }

        for($i = 2; $i < 1001; $i++)
        {
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                ->setCellValue('C'.$i, "--Pilih--")
                ;

            $objValidation = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getDataValidation();
            $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
            $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setErrorTitle('Input error');
            $objValidation->setError('Value is not in list.');
            $objValidation->setPromptTitle('Pilih Attribute');
            $objValidation->setPrompt('Pilih Attribute berdasarkan opsi yang tersedia');
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
        $this->load->model('Questionmodel');
		$upload = $this->Questionmodel->upload_file($this->filename);
			
            if($upload['result'] == "success"){ // Jika proses upload sukses
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load(FCPATH.'excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
            
            // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
            $data = array();
            
            $numrow = 1;
            foreach($sheet as $row){
                if($numrow > 1){
                    if($row['A']!= "" && $row['C']!= "--Pilih--")
                    {
                        // Kita push (add) array data ke variabel data
                        $this->load->model('Attributemodel');
                        $cari = $this->Attributemodel->tampil();
                        if($cari != null)
                        {
                            foreach ( $cari as $key) 
                            {
                                if($key->att_deskripsi == $row['C'])
                                {
                                    $row['C'] = $key->att_id;
                                }
                            }
                        }

                        $this->Questionmodel->insert_import($row['A'], $row['B'], $row['C']);
                    }
                }
                $numrow++; // Tambah 1 setiap kali looping
            }
            // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
            // $this->SiswaModel->insert_multiple($data);
        }
        
        $this->session->set_flashdata('item','import');
		redirect("Question"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
}

?>


