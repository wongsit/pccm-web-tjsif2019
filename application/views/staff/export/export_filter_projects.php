<?php
  //load our new PHPExcel library
  $this->load->library('excel');
  // ตั้งชื่อไฟล์
  $date_stamp = date_format(date_create($date_time_stamp),"Ymd");
  $fileName = 'TJSIF2019_Projects_by_filter_'.$date_stamp.'.xlsx';
  //อินสแตนซ์คลาส PHPExcel
  $objPHPExcel = new PHPExcel();
  //activate worksheet number 1
  $this->excel->setActiveSheetIndex(0);
  //ยุบรวมเซลล์
  $this->excel->getActiveSheet()->mergeCells('A1:L1');
  //กำหนดรายละเอียดเกี่ยวกับเอกสาร หัวข้อ
  $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'TJSIF2019 The list of projects by filter. Date: '.$date_time_stamp);
  //set aligment to center for that merged cell (A1 to D1)
  $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  // set Header ตั้งค่าหัวตาราง แถวที่ 2
  $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'ID');
  $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Project name');
  $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'category');
  $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'style');
  $objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Organization');
  $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Students');
  $objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Teachers');
  $objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Last update');
  // set Row ตั้งค่าเริ่มต้นใส่ข้อมูลที่แถวที่ 4
  $rowCount = 4;
  $i=1;
  //วนลูปเพื่อนำค่าจากตัวแปรใส่ลงในแต่ละแถว
  foreach ($projects as $project) {
      $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $project->id);     //ที่
      $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $project->name);    //
      $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $this->Project_model->fetch_project_category_name($project->category_id));
      $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $this->Project_model->fetch_project_style_name($project->style_id));   //
      $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $this->Org_model->fetch_org_name($project->org_id));   //
      //students
      $div= array();
      $div = explode(",",$project->students); //แยก student id ออกมา แช่น 2,5,12 => 2 5 12
      $student = '';
      $user=array();
      for($i=0;$i<count($div)-1;$i++){
        $user = $this->Users_model->fetch_user_data_id($div[$i]);
        $student .= $user->firstname.' '.$user->lastname.',';
      }
      $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $student);    //
      //Teachers
      $div= array();
      $div = explode(",",$project->teachers); //แยก student id ออกมา แช่น 2,5,12 => 2 5 12
      $teacher = '';
      $user = array();
      for($i=0;$i<count($div)-1;$i++){
        $user = $this->Users_model->fetch_user_data_id($div[$i]);
        $teacher .= $user->firstname.' '.$user->lastname.',';
      }
      $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $teacher); //ชั้น
      $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount,$project->update_time);
      $rowCount++;
      $i++;
  }
  $rowCount+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'Date: '.$date_time_stamp.' Developer: Griffinics');     //ที่
  //savefile
  $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
  $objWriter->save('assets/docs/exports/'.$fileName);
  // download file
  header("Content-Type: application/vnd.ms-excel");
  redirect(base_url().'assets/docs/exports/'.$fileName);
?>
