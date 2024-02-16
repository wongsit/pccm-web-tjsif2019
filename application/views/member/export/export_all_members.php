<?php
  //load our new PHPExcel library
  $this->load->library('excel');
  // ตั้งชื่อไฟล์
  $date_stamp = date_format(date_create($date_time_stamp),"Ymd");
  $fileName = 'TJSIF2019_Member_all_'.$date_stamp.'.xlsx';
  //อินสแตนซ์คลาส PHPExcel
  $objPHPExcel = new PHPExcel();
  //activate worksheet number 1
  $this->excel->setActiveSheetIndex(0);
  //ยุบรวมเซลล์
  $this->excel->getActiveSheet()->mergeCells('A1:L1');
  //กำหนดรายละเอียดเกี่ยวกับเอกสาร หัวข้อ
  $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'TJSIF2019 The list of all members. Date: '.$date_time_stamp);
  //set aligment to center for that merged cell (A1 to D1)
  $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  // set Header ตั้งค่าหัวตาราง แถวที่ 2
  $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'No.');
  $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Firstname');
  $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Lastname');
  $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Organization');
  $objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Organization Type');
  $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Occupation');
  $objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Type');
  $objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Gender');
  $objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Email');
  $objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Allergies');
  $objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Project');
  $objPHPExcel->getActiveSheet()->SetCellValue('L3', 'Attendances');
  // set Row ตั้งค่าเริ่มต้นใส่ข้อมูลที่แถวที่ 4
  $rowCount = 4;
  $i=1;
  //วนลูปเพื่อนำค่าจากตัวแปรใส่ลงในแต่ละแถว
  foreach ($users as $user) {
      $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);     //ที่
      $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $user->firstname);    //
      $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $user->lastname);
      $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $this->Org_model->fetch_org_name($user->org_id));   //
      $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $this->Org_model->fetch_org_type_name_by_org_id($user->org_id));   //
      $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $this->Occ_model->fetch_occ_type_name($user->occ_id));   //
      $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $this->Users_model->fetch_people_type_name($user->type));    //
      $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $this->Users_model->fetch_gender_name($user->gender)); //ชั้น
      $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount,$user->email);
      $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $user->allergies);
      $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $this->Project_model->fetch_user_project_name($user->id));
      $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, '');
      $rowCount++;
      $i++;
  }
  $rowCount+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'Date: '.$date_time_stamp.'Developer: Griffinics');     //ที่
  //savefile
  $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
  $objWriter->save('assets/docs/exports/'.$fileName);
  // download file
  header("Content-Type: application/vnd.ms-excel");
  redirect(base_url().'assets/docs/exports/'.$fileName);
?>
