<?php
  //load our new PHPExcel library
  $this->load->library('excel');
  // ตั้งชื่อไฟล์
  $date_stamp = date_format(date_create($date_time_stamp),"Ymd");
  $fileName = 'TJSIF2019_Projects_needs_'.$date_stamp.'.xlsx';
  //อินสแตนซ์คลาส PHPExcel
  $objPHPExcel = new PHPExcel();
  //activate worksheet number 1
  $this->excel->setActiveSheetIndex(0);
  //ยุบรวมเซลล์
  $this->excel->getActiveSheet()->mergeCells('A1:L1');
  //กำหนดรายละเอียดเกี่ยวกับเอกสาร หัวข้อ
  $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'TJSIF2019 The list of all projects needs. Date: '.$date_time_stamp);
  //set aligment to center for that merged cell (A1 to D1)
  $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  // set Header ตั้งค่าหัวตาราง แถวที่ 2
  $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'No');
  $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Project ID');
  $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Project name');
  $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Electricity');
  $objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Water');
  $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Hug space');
  $objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Other needs');
  $objPHPExcel->getActiveSheet()->SetCellValue('H3', 'update time');
  // set Row ตั้งค่าเริ่มต้นใส่ข้อมูลที่แถวที่ 4
  $rowCount = 4;
  $i=1;
  //วนลูปเพื่อนำค่าจากตัวแปรใส่ลงในแต่ละแถว
  foreach ($projects as $project) {
      $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $project->id);     //ที่
      $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $project->project_id);    //
      $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $this->Project_model->fetch_project_name($project->project_id));
      $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $project->electricity); //
      $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $project->water); //
      $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $project->hug_space); //
      $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $project->other); //
      $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $project->update_time); //
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
