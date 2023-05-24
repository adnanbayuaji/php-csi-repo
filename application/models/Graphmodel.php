<?php
    //membuat class baru inherit CI_Model
    class Graphmodel extends CI_Model
    {
        function tampil_grafik($values)
		{
            $hasil = null;
            //".date('Y')."
            $this->db->trans_start();
            if($values=="")
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 group by res_npk)");
            }
            else
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1  and res_periode='".$values."' group by res_npk)");
            }
            $this->db->query("CREATE TEMPORARY TABLE temp_rsp_rsk
            Select que_id, ((count(case tku_poina when '5' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*5)+(count(case tku_poina when '4' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*4)+(count(case tku_poina when '3' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*3)+(count(case tku_poina when '2' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*2)+(count(case tku_poina when '1' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*1))/100 as rsp, ((count(case tku_poinb when '5' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*5)+(count(case tku_poinb when '4' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*4)+(count(case tku_poinb when '3' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*3)+(count(case tku_poinb when '2' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*2)+(count(case tku_poinb when '1' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*1))/100 as rsk from csi_tr_kuisioner join csi_tr_detresponden on csi_tr_kuisioner.tdr_id = csi_tr_detresponden.tdr_id join max_responden on max_responden.res_id = csi_tr_detresponden.res_id where  max_responden.res_statusisi = 1 group by que_id;");
            $this->db->query("CREATE TEMPORARY TABLE sum_rsp_rsk
            SELECT sum(rsp) as sum_rsp from temp_rsp_rsk;");
            $this->db->query("CREATE TEMPORARY TABLE temp_WF
            Select que_id, rsp/(select sum_rsp from sum_rsp_rsk) as WF from temp_rsp_rsk;");
            $this->db->query("CREATE TEMPORARY TABLE temp_WS
            Select rsk*WF as WS from temp_rsp_rsk join temp_WF on temp_WF.que_id = temp_rsp_rsk.que_id;");
            $query = $this->db->query("select SUM(WS)/5*100 as csi from temp_WS");
            $this->db->trans_complete(); 
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $data){
                    $hasil[] = $data;
                    // echo '<script language="javascript">';
                    // echo 'alert("a'.$data->csi.'")';
                    // echo '</script>';
                }
            }
			if(!isset($hasil)){$hasil=null;}
            return $hasil;
        }
        
        function tampil_grafik_plant($values)
		{
            $hasil = null;
            //".date('Y')."
            $this->db->trans_start();
            // $this->db->query("CREATE TEMPORARY TABLE max_responden2
            // SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` group by res_npk) and res_statusisi = 1");
            if($values=="")
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden2
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 group by res_npk)");
            }
            else
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden2
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 and res_periode='".$values."' group by res_npk)");
            }
            
            $this->db->query("CREATE TEMPORARY TABLE temp_rsp_rsk2
            Select que_id, pla_id, ((count(case tku_poina when '5' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*5)+(count(case tku_poina when '4' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*4)+(count(case tku_poina when '3' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*3)+(count(case tku_poina when '2' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*2)+(count(case tku_poina when '1' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*1))/100 as rsp, ((count(case tku_poinb when '5' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*5)+(count(case tku_poinb when '4' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*4)+(count(case tku_poinb when '3' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*3)+(count(case tku_poinb when '2' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*2)+(count(case tku_poinb when '1' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*1))/100 as rsk from csi_tr_kuisioner 
            join csi_tr_detresponden on csi_tr_kuisioner.tdr_id = csi_tr_detresponden.tdr_id 
            join max_responden2 on max_responden2.res_id = csi_tr_detresponden.res_id 
            where  max_responden2.res_statusisi = 1 group by que_id, pla_id;");
            
            
            // $this->db->query("CREATE TEMPORARY TABLE temp_rsp_rsk2
            // Select que_id, pla_id, ((count(case tku_poina when '5' then 1 else null end)/count(max_responden2.res_id)*100*5)+(count(case tku_poina when '4' then 1 else null end)/count(max_responden2.res_id)*100*4)+(count(case tku_poina when '3' then 1 else null end)/count(max_responden2.res_id)*100*3)+(count(case tku_poina when '2' then 1 else null end)/count(max_responden2.res_id)*100*2)+(count(case tku_poina when '1' then 1 else null end)/count(max_responden2.res_id)*100*1))/100 as rsp, ((count(case tku_poinb when '5' then 1 else null end)/count(max_responden2.res_id)*100*5)+(count(case tku_poinb when '4' then 1 else null end)/count(max_responden2.res_id)*100*4)+(count(case tku_poinb when '3' then 1 else null end)/count(max_responden2.res_id)*100*3)+(count(case tku_poinb when '2' then 1 else null end)/count(max_responden2.res_id)*100*2)+(count(case tku_poinb when '1' then 1 else null end)/count(max_responden2.res_id)*100*1))/100 as rsk from csi_tr_kuisioner 
            // join csi_tr_detresponden on csi_tr_kuisioner.tdr_id = csi_tr_detresponden.tdr_id 
            // join max_responden2 on max_responden2.res_id = csi_tr_detresponden.res_id
            // where  max_responden2.res_statusisi = 1 group by que_id, pla_id;");

            
            // $this->db->query("CREATE TEMPORARY TABLE sum_rsp_rsk2
            // SELECT sum(rsp) as sum_rsp from temp_rsp_rsk2;");
            // $this->db->query("CREATE TEMPORARY TABLE temp_WF2
            // Select que_id, pla_id, rsp/(select sum_rsp from sum_rsp_rsk2) as WF from temp_rsp_rsk2;");


            $this->db->query("CREATE TEMPORARY TABLE sum_rsp_rsk2
            SELECT pla_id, sum(rsp) as sum_rsp from temp_rsp_rsk2 group by pla_id;");
            $this->db->query("CREATE TEMPORARY TABLE temp_WF2
            Select que_id, temp_rsp_rsk2.pla_id, rsp/sum_rsp as WF from temp_rsp_rsk2 join sum_rsp_rsk2 on sum_rsp_rsk2.pla_id = temp_rsp_rsk2.pla_id;");

            
            $this->db->query("CREATE TEMPORARY TABLE temp_WS2
            Select temp_rsp_rsk2.pla_id, rsk*WF as WS from temp_rsp_rsk2 join temp_WF2 on temp_WF2.que_id = temp_rsp_rsk2.que_id and temp_WF2.pla_id = temp_rsp_rsk2.pla_id;");

            $query = $this->db->query("select pla_nama, SUM(WS)/5*100 as csi from temp_WS2 join csi_ms_plant on temp_WS2.pla_id = csi_ms_plant.pla_id group by temp_WS2.pla_id");

            $this->db->trans_complete(); 
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $data){
                    $hasil[] = $data;
                    // echo '<script language="javascript">';
                    // echo 'alert("a'.$data->csi.'")';
                    // echo '</script>';
                }
            }
			if(!isset($hasil)){$hasil=null;}
            return $hasil;
        }
        
        function topChart($values)
		{
            $hasil = null;
            //".date('Y')."
            $this->db->trans_start();
            // $this->db->query("CREATE TEMPORARY TABLE max_responden3
            // SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` group by res_npk) and res_statusisi = 1");
            if($values=="")
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden3
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 group by res_npk)");
            }
            else
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden3
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 and res_periode='".$values."' group by res_npk)");
            }
            $query = $this->db->query('select CONCAT(csi_ms_attribute.att_deskripsi," - ", csi_ms_scopeofwork.sow_deskripsi," - ", SUBSTRING(csi_ms_question.que_kepentingan,1, 50),"...") as deskripsi, (SUM(tku_poina)+SUM(tku_poinb))/count(csi_ms_question.que_id) as total
            from csi_tr_kuisioner
            join csi_ms_question on csi_ms_question.que_id = csi_tr_kuisioner.que_id
            join csi_ms_attribute on csi_ms_question.att_id = csi_ms_attribute.att_id
            join csi_ms_scopeofwork on csi_ms_attribute.sow_id = csi_ms_scopeofwork.sow_id
            join csi_tr_detresponden on csi_tr_detresponden.tdr_id = csi_tr_kuisioner.tdr_id
            join max_responden3 on csi_tr_detresponden.res_id = max_responden3.res_id
            where max_responden3.res_statusisi = 1
            group by csi_ms_question.que_id 
            order by total DESC
            Limit 3');
            $this->db->trans_complete(); 
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $data){
                    $hasil[] = $data;
                    // echo '<script language="javascript">';
                    // echo 'alert("a'.$data->csi.'")';
                    // echo '</script>';
                }
            }
			if(!isset($hasil)){$hasil=null;}
            return $hasil;
        }
        
        function bottomChart($values)
		{
            $hasil = null;
            //".date('Y')."
            $this->db->trans_start();
            // $this->db->query("CREATE TEMPORARY TABLE max_responden4
            // SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` group by res_npk) and res_statusisi = 1");
            if($values=="")
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden4
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 group by res_npk)");
            }
            else
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden4
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 and res_periode='".$values."' group by res_npk)");
            }
            $query = $this->db->query('select CONCAT(csi_ms_attribute.att_deskripsi," - ", csi_ms_scopeofwork.sow_deskripsi," - ", SUBSTRING(csi_ms_question.que_kepentingan,1, 50),"...") as deskripsi, (SUM(tku_poina)+SUM(tku_poinb))/count(csi_ms_question.que_id) as total
            from csi_tr_kuisioner
            join csi_ms_question on csi_ms_question.que_id = csi_tr_kuisioner.que_id
            join csi_ms_attribute on csi_ms_question.att_id = csi_ms_attribute.att_id
            join csi_ms_scopeofwork on csi_ms_attribute.sow_id = csi_ms_scopeofwork.sow_id
            join csi_tr_detresponden on csi_tr_detresponden.tdr_id = csi_tr_kuisioner.tdr_id
            join max_responden4 on csi_tr_detresponden.res_id = max_responden4.res_id
            where max_responden4.res_statusisi = 1
            group by csi_ms_question.que_id 
            order by total ASC
            Limit 3');
            $this->db->trans_complete(); 
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $data){
                    $hasil[] = $data;
                    // echo '<script language="javascript">';
                    // echo 'alert("a'.$data->csi.'")';
                    // echo '</script>';
                }
            }
			if(!isset($hasil)){$hasil=null;}
            return $hasil;
        }
        
        function voiceOfCustomer($values)
		{
            $hasil = null;
            //".date('Y')."
            $this->db->trans_start();
            // $this->db->query("CREATE TEMPORARY TABLE max_responden7
            // SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` group by res_npk) and res_statusisi = 1");
            if($values=="")
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden7
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 group by res_npk)");

                $query = $this->db->query('select csi_ms_question.que_id, CONCAT(csi_ms_attribute.att_deskripsi," - ", csi_ms_scopeofwork.sow_deskripsi) as deskripsi, CONCAT(csi_ms_attribute.att_deskripsi," - ", csi_ms_scopeofwork.sow_deskripsi) as detail, sum(case when tku_alasa != "" then 1 else 0 end) + sum(case when tku_alasb != "" then 1 else 0 end) as alasanb, null as years
                from csi_tr_kuisioner
                join csi_ms_question on csi_ms_question.que_id = csi_tr_kuisioner.que_id
                join csi_ms_attribute on csi_ms_question.att_id = csi_ms_attribute.att_id
                join csi_ms_scopeofwork on csi_ms_attribute.sow_id = csi_ms_scopeofwork.sow_id
                join csi_tr_detresponden on csi_tr_detresponden.tdr_id = csi_tr_kuisioner.tdr_id
                join max_responden7 on csi_tr_detresponden.res_id = max_responden7.res_id
                where max_responden7.res_statusisi = 1 
                group by csi_ms_question.que_id
                having alasanb > 0 
                order by alasanb desc');
            }
            else
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden7
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 and res_periode='".$values."' group by res_npk)");
                
                $query = $this->db->query('select csi_ms_question.que_id, CONCAT(csi_ms_attribute.att_deskripsi," - ", csi_ms_scopeofwork.sow_deskripsi) as deskripsi, CONCAT(csi_ms_attribute.att_deskripsi," - ", csi_ms_scopeofwork.sow_deskripsi) as detail, sum(case when tku_alasa != "" then 1 else 0 end) + sum(case when tku_alasb != "" then 1 else 0 end) as alasanb, '.$values.' as years
                from csi_tr_kuisioner
                join csi_ms_question on csi_ms_question.que_id = csi_tr_kuisioner.que_id
                join csi_ms_attribute on csi_ms_question.att_id = csi_ms_attribute.att_id
                join csi_ms_scopeofwork on csi_ms_attribute.sow_id = csi_ms_scopeofwork.sow_id
                join csi_tr_detresponden on csi_tr_detresponden.tdr_id = csi_tr_kuisioner.tdr_id
                join max_responden7 on csi_tr_detresponden.res_id = max_responden7.res_id
                where max_responden7.res_statusisi = 1 
                group by csi_ms_question.que_id
                having alasanb > 0 
                order by alasanb desc');
            }
            $this->db->trans_complete(); 
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $data){
                    $hasil[] = $data;
                    // echo '<script language="javascript">';
                    // echo 'alert("a'.$data->csi.'")';
                    // echo '</script>';
                }
            }
			if(!isset($hasil)){$hasil=null;}
            return $hasil;
        }

        function tampil_grafik_dept($values)
		{
            $hasil = null;
            //".date('Y')."
            $this->db->trans_start();
            // $this->db->query("CREATE TEMPORARY TABLE max_responden6
            // SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` group by res_npk) and res_statusisi = 1");
            if($values=="")
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden6
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 group by res_npk)");
            }
            else
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden6
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 and res_periode='".$values."' group by res_npk)");
            }
            $this->db->query("CREATE TEMPORARY TABLE temp_rsp_rsk3
            Select csi_tr_kuisioner.que_id, csi_tr_detresponden.dept_id, ((count(case tku_poina when '5' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*5)+(count(case tku_poina when '4' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*4)+(count(case tku_poina when '3' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*3)+(count(case tku_poina when '2' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*2)+(count(case tku_poina when '1' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*1))/100 as rsp, ((count(case tku_poinb when '5' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*5)+(count(case tku_poinb when '4' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*4)+(count(case tku_poinb when '3' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*3)+(count(case tku_poinb when '2' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*2)+(count(case tku_poinb when '1' then 1 else null end)/count(csi_tr_detresponden.res_id)*100*1))/100 as rsk from csi_tr_kuisioner join csi_tr_detresponden on csi_tr_kuisioner.tdr_id = csi_tr_detresponden.tdr_id 
            join max_responden6 on max_responden6.res_id = csi_tr_detresponden.res_id 
            where  max_responden6.res_statusisi = 1 group by que_id;");
            $this->db->query("CREATE TEMPORARY TABLE sum_rsp_rsk3
            SELECT dept_id, sum(rsp) as sum_rsp from temp_rsp_rsk3 group by dept_id;");
            $this->db->query("CREATE TEMPORARY TABLE temp_WF3
            Select que_id, dept_id, rsp/(select sum_rsp from sum_rsp_rsk3 b where b.dept_id = a.dept_id ) as WF from temp_rsp_rsk3 a;");
            $this->db->query("CREATE TEMPORARY TABLE temp_WS3
            Select temp_WF3.dept_id, rsk*WF as WS from temp_rsp_rsk3 join temp_WF3 on temp_WF3.que_id = temp_rsp_rsk3.que_id;");
            $query = $this->db->query("select dept_nama, SUM(WS)/5*100 as csi from temp_WS3 join csi_ms_departemen on csi_ms_departemen.dept_id = temp_WS3.dept_id group by temp_WS3.dept_id ");
            $this->db->trans_complete(); 
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $data){
                    $hasil[] = $data;
                    // echo '<script language="javascript">';
                    // echo 'alert("a'.$data->csi.'")';
                    // echo '</script>';
                }
            }
			if(!isset($hasil)){$hasil=null;}
            return $hasil;
        }

        //  // function that finds the phone by its ID to display in th Bootstrap modal
        // function getViewData($tchData)
        // {
        //     $this->db->select('csi_tr_kuisioner.que_id, csi_ms_question.que_kepentingan, csi_ms_question.que_kepuasan, csi_ms_attribute.att_deskripsi, csi_ms_scopeofwork.sow_deskripsi, csi_ms_departemen.dept_nama');
        //     $this->db->from('csi_tr_kuisioner');
        //     $this->db->where('csi_tr_kuisioner.que_id',$tchData);
        //     $this->db->join('csi_ms_question', 'csi_ms_question.que_id = csi_tr_kuisioner.que_id');
        //     $this->db->join('csi_ms_attribute', 'csi_ms_question.att_id = csi_ms_attribute.att_id');
        //     $this->db->join('csi_ms_scopeofwork', 'csi_ms_attribute.sow_id = csi_ms_scopeofwork.sow_id');
        //     $this->db->join('csi_ms_departemen', 'csi_ms_departemen.dept_id = csi_ms_scopeofwork.dept_id');
        //     $this->db->group_by('csi_tr_kuisioner.que_id');
        //     $res2=$this->db->get();
        //     return $res2;
        // }

        // function that finds the phone by its ID to display in th Bootstrap modal
        function getViewData($tchData, $tchYear)
        {
            $this->db->trans_start();
            // echo "<script>console.log('Debug Objects: " . $tchYear . "' );</script>";
            if($tchYear=="")
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden8
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 group by res_npk)");
            }
            else
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden8
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 and res_periode='".$tchYear."' group by res_npk)");
            }
            $query = $this->db->query("select csi_tr_kuisioner.que_id, csi_ms_question.que_kepentingan, csi_ms_question.que_kepuasan, csi_ms_attribute.att_deskripsi, csi_ms_scopeofwork.sow_deskripsi, csi_ms_departemen.dept_nama from csi_tr_kuisioner 
            join csi_ms_question on csi_ms_question.que_id = csi_tr_kuisioner.que_id
            join csi_ms_attribute on csi_ms_question.att_id = csi_ms_attribute.att_id
            join csi_ms_scopeofwork on csi_ms_attribute.sow_id = csi_ms_scopeofwork.sow_id
            join csi_ms_departemen on csi_ms_departemen.dept_id = csi_ms_scopeofwork.dept_id
            join csi_tr_detresponden on csi_tr_detresponden.tdr_id = csi_tr_kuisioner.tdr_id
            join max_responden8 on csi_tr_detresponden.res_id = max_responden8.res_id
            where csi_tr_kuisioner.que_id = '$tchData'
            group by csi_tr_kuisioner.que_id");
            $this->db->trans_complete(); 
            return $query;
        }

        function tampilanalasa($id, $tchYear)
		{
            $hasil = null;
            $this->db->trans_start();
            if($tchYear=="")
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden9
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 group by res_npk)");
            }
            else
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden9
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 and res_periode='".$tchYear."' group by res_npk)");
            }
                
            $query = $this->db->query('select csi_tr_kuisioner.tku_poina, csi_tr_kuisioner.tku_alasa
            from csi_tr_kuisioner
            join csi_ms_question on csi_ms_question.que_id = csi_tr_kuisioner.que_id
            join csi_ms_attribute on csi_ms_question.att_id = csi_ms_attribute.att_id
            join csi_ms_scopeofwork on csi_ms_attribute.sow_id = csi_ms_scopeofwork.sow_id
            join csi_tr_detresponden on csi_tr_detresponden.tdr_id = csi_tr_kuisioner.tdr_id
            join max_responden9 on csi_tr_detresponden.res_id = max_responden9.res_id
            where csi_tr_kuisioner.que_id="'.$id.'" and csi_tr_kuisioner.tku_alasa!=""');
            $this->db->trans_complete(); 
            
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $data){
                    $hasil[] = $data;
                }
            }
			if(!isset($hasil)){$hasil=null;}
            return $hasil;


            // $this->db->select("csi_tr_kuisioner.tku_poina, csi_tr_kuisioner.tku_alasa");
            // $this->db->from('csi_tr_kuisioner');
            // $this->db->join('csi_tr_detresponden', 'csi_tr_detresponden.tdr_id = csi_tr_kuisioner.tdr_id');
            // $this->db->join('csi_ms_responden', 'csi_tr_detresponden.res_id = csi_ms_responden.res_id');
            // $this->db->where('csi_tr_kuisioner.que_id',$id);
            // $this->db->where('csi_tr_kuisioner.tku_alasa !=',"");
            // if($tchYear!="") $this->db->where('csi_ms_responden.res_periode',$tchYear);
            // $this->db->where('csi_ms_responden.res_statusisi',1);
            // $salur=$this->db->get();
            // if ($salur->num_rows() > 0) {
            //     return $salur;
            // } else {
            //     return FALSE;
            // }
        }

        function tampilanalasb($id, $tchYear)
		{
            $hasil = null;
            $this->db->trans_start();
            if($tchYear=="")
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden10
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 group by res_npk)");
            }
            else
            {
                $this->db->query("CREATE TEMPORARY TABLE max_responden10
                SELECT `csi_ms_responden`.* FROM `csi_ms_responden` where res_id IN (select MAX(res_id) from `csi_ms_responden` where res_statusisi = 1 and res_periode='".$tchYear."' group by res_npk)");
            }
                
            $query = $this->db->query('select csi_tr_kuisioner.tku_poinb, csi_tr_kuisioner.tku_alasb
            from csi_tr_kuisioner
            join csi_ms_question on csi_ms_question.que_id = csi_tr_kuisioner.que_id
            join csi_ms_attribute on csi_ms_question.att_id = csi_ms_attribute.att_id
            join csi_ms_scopeofwork on csi_ms_attribute.sow_id = csi_ms_scopeofwork.sow_id
            join csi_tr_detresponden on csi_tr_detresponden.tdr_id = csi_tr_kuisioner.tdr_id
            join max_responden10 on csi_tr_detresponden.res_id = max_responden10.res_id
            where csi_tr_kuisioner.que_id="'.$id.'" and csi_tr_kuisioner.tku_alasb!=""');
            $this->db->trans_complete(); 
            
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $data){
                    $hasil[] = $data;
                }
            }
			if(!isset($hasil)){$hasil=null;}
            return $hasil;

            // $this->db->select("csi_tr_kuisioner.tku_poinb, csi_tr_kuisioner.tku_alasb");
            // $this->db->from('csi_tr_kuisioner');
            // $this->db->join('csi_tr_detresponden', 'csi_tr_detresponden.tdr_id = csi_tr_kuisioner.tdr_id');
            // $this->db->join('csi_ms_responden', 'csi_tr_detresponden.res_id = csi_ms_responden.res_id');
            // $this->db->where('csi_tr_kuisioner.que_id',$id);
            // $this->db->where('csi_tr_kuisioner.tku_alasb !=',"");
            // if($tchYear!="") $this->db->where('csi_ms_responden.res_periode',$tchYear);
            // $this->db->where('csi_ms_responden.res_statusisi',1);
            // $salur=$this->db->get();
            // if ($salur->num_rows() > 0) {
            //     return $salur;
            // } else {
            //     return FALSE;
            // }
        }
    }
?>