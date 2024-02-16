<?php
  //load our new PHPExcel library
  $this->load->library('excel');
  // ตั้งชื่อไฟล์
  $date_stamp = date_format(date_create($date_time_stamp),"Ymd");
  $fileName = 'TJSIF2019_Organization_all_'.$date_stamp.'.xlsx';
  //อินสแตนซ์คลาส PHPExcel
  $objPHPExcel = new PHPExcel();
  //activate worksheet number 1
  $this->excel->setActiveSheetIndex(0);
  //ยุบรวมเซลล์
  $this->excel->getActiveSheet()->mergeCells('A1:L1');
  //กำหนดรายละเอียดเกี่ยวกับเอกสาร หัวข้อ
  $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'TJSIF2019 The list of all Organizations. Date: '.$date_time_stamp);
  //set aligment to center for that merged cell (A1 to D1)
  $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  // set Header ตั้งค่าหัวตาราง แถวที่ 2
  $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'No');
  $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Org ID');
  $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Organization name');
  $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Shortname');
  $objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Address1');
  $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Address2');
  $objPHPExcel->getActiveSheet()->SetCellValue('G3', 'City');
  $objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Province');
  $objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Zip');
  $objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Phone');
  $objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Fax');
  $objPHPExcel->getActiveSheet()->SetCellValue('L3', 'E-mail');
  $objPHPExcel->getActiveSheet()->SetCellValue('M3', 'Homepage');
  $objPHPExcel->getActiveSheet()->SetCellValue('N3', 'Type');
  $objPHPExcel->getActiveSheet()->SetCellValue('O3', 'Active');
  $objPHPExcel->getActiveSheet()->SetCellValue('P3', 'Update time');
  // set Row ตั้งค่าเริ่มต้นใส่ข้อมูลที่แถวที่ 4
  $rowCount = 4;
  $i=1;
  //วนลูปเพื่อนำค่าจากตัวแปรใส่ลงในแต่ละแถว
  foreach ($orgs as $org) {
      $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);     //ที่
      $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $org->id);     //ID
      $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $org->name);    //
      $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $org->shortname);
      $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $org->address1);   //
      $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $org->address2);   //
      $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $org->city);   //
      $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $org->province);   //
      $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $org->zip);   //
      $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $org->tel);   //
      $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $org->fax);   //
      $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $org->email);   //
      $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $org->homepage);   //
      $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $this->Org_model->fetch_org_type_name($org->type));   //
      $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $org->active);   //
      $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount,$project->update_time);
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
