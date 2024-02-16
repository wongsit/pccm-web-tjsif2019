<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    $this->load->library('Pdf');

    class MyPDF extends Pdf
    {
        /**
         * "Remembers" the template id of the imported page
         */
        var $_tplIdx;

        /**
         * Draw an imported PDF logo on every page
         */
        function Header()
        {
            /*--------------------------
            ไฟล์ pdf ที่เตรียมไว้เป็น background
            ------------------------------*/
            $file = dirname(__FILE__)."/card_v2.pdf";  //ไฟล์ pdf ที่เตรียมไว้
            if (is_null($this->_tplIdx)) {
                $this->setSourceFile($file);
                $this->_tplIdx = $this->importPage(1);
            }
            $specs = $this->getTemplateSize($this->_tplIdx);
            $size = $this->useTemplate($this->_tplIdx, 0);     // ตั้งค่า กั้นหน้า
        }

        function Footer()
        {
            // emtpy method body
        }
    }

    // initiate PDF
    $pdf = new MyPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
    $pdf->SetAutoPageBreak(true, 10);
    $pdf->setFontSubsetting(false);
    $pdf->SetTitle($title.'-'.$user->firstname);  //title

    // add a page
    $pdf->AddPage('L', 'A4');
        $pdf->setCellPaddings(0, 2, 0, 0);
        $pdf->setCellMargins(0, 0, 0, 0);

        //เส้นกรอบบัตร
        $pdf->SetDrawColor(180, 180, 180);
        $pdf->SetFillColor(255,255, 255);
        $pdf->Rect(45, 20, 207.5, 136.5, 'DฺฺB', 0);

        //People Type
        $pdf->SetFont('freeserifB', '', 22);   //ขนาตตัวอักษร
        $pdf->SetXY(47,51); //SetXY(x,y);
        $types_name = '';
        foreach($types as $type) {
          if($type->id == $user->type){
             $types_name = $type->name;
           }
        }
        $pdf->SetTextColor(0, 0, 0, 0);
        $pdf->MultiCell(100, 9, strtoupper($types_name), 0, 'C', 0, 0);

        //ID
        $pdf->SetFont('freeserifB', '', 14);   //ขนาตตัวอักษร
        $pdf->SetTextColor(100, 100, 100);
        $pdf->SetXY(60,144); //SetXY(x,y);
        $pdf->MultiCell(30, 9, $user->id, 0, 'L', 0, 0);
        /*------ส่วนหัว-------*/
        $pdf->SetFont('freeserif', '', 18);   //ขนาตตัวอักษร
        $pdf->SetTextColor(0, 0, 0);
        //ชื่อ-นามสกุล
        $pdf->SetXY(47,67); //SetXY(x,y);
        $prename = '';
        foreach($titles as $title) {
          if($title->id == $user->title){
             $prename = $title->name;
           }
        }
        $pdf->MultiCell(100, 5,$prename.''.ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)), 0, 'C', 0, 0, '', '', true);

        //โรงเรียน
        $pdf->SetFont('freeserif', '', 12);   //ขนาตตัวอักษร
        $pdf->SetXY(47,78); //SetXY(x,y);
        $org_name = '';
        foreach($orgs as $org) {
          if($org->id == $user->org_id){
             $org_name = $org->name;
           }
        }
        $pdf->MultiCell(100, 9, $org_name, 0, 'C', 0, 0);

        //Wifi
        // define style for border
        $border_style = array('all' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));
        $pdf->SetDrawColor(255, 255, 255);
        $pdf->SetFillColor(220,220, 220);
        $pdf->Rect(155, 93, 90, 17, 'DF', 0);
        $pdf->SetFont('freeserif', '', 12);   //ขนาตตัวอักษร
        $pdf->SetXY(160,93); //SetXY(x,y);
        $pdf->MultiCell(80, 9,  'Free Wi-Fi account SSID: PCSHSM', 0, 'L', 0, 0);
        $pdf->SetFont('freeserif', '', 10);   //ขนาตตัวอักษร
        $pdf->SetXY(160,98); //SetXY(x,y);
        $pdf->MultiCell(90, 9,  'User: '.$user->email, 0, 'L', 0, 0);
        $pdf->SetXY(160,103); //SetXY(x,y);
        $pdf->MultiCell(70, 9, 'Password: '. substr($user->email,0,strpos($user->email,'@')), 0, 'L', 0, 0);

        //Fieldtrip
        $fieldtrip_selected = $this->Users_model->fetch_fieldtrip_row($user->trip);
        $user_trip = $this->Users_model->fetch_fieldtrip_chose_id($user->id);
        $pdf->SetFont('freeserifB', '', 9);   //ขนาตตัวอักษร
        if($fieldtrip_selected != null){
          if($user->occ_id == 1){
            $pdf->SetXY(155,69); //SetXY(x,y);
            $pdf->MultiCell(45, 9,  $fieldtrip_selected->name.' (Group: '.$this->Users_model->fetch_fieldtrip_sub_group_id($user->id).')', 0, 'L', 0, 0);
          }else{
            $pdf->SetXY(155,69); //SetXY(x,y);
            $pdf->MultiCell(45, 9,  $fieldtrip_selected->name, 0, 'L', 0, 0);
          }
        }
        if($user_trip !== null){
          $pdf->SetFont('freeserifB', '', 14);   //ขนาตตัวอักษร
          $pdf->SetXY(175,82); //SetXY(x,y);
          $pdf->MultiCell(10, 9,  $user_trip->bus_no, 0, 'L', 0, 0);
        }
        //Work shop
        if($user->occ_id == 1){
          if($fieldtrip_selected != null){
            $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
            $pdf->SetXY(220,67); //SetXY(x,y);
            $pdf->MultiCell(35, 9,  $fieldtrip_selected->workshop_room, 0, 'L', 0, 0);
          }
        }else{
          $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
          $pdf->SetXY(220,67); //SetXY(x,y);
          $pdf->MultiCell(35, 9,  '-', 0, 'L', 0, 0);
        }
        //Project ID, Code
        $project_user = $this->Project_model->fetch_student_project($user->id);

        if($project_user != null){
          $project_present = $this->Project_model->fetch_project_present_id($project_user->id);
          if($project_present != null){
            $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
            $pdf->SetXY(231,46); //SetXY(x,y);
            $pdf->MultiCell(20, 9,  $project_present->new_id, 0, 'L', 0, 0);
          }
          if($project_present != null){
            $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
            $pdf->SetXY(231,52); //SetXY(x,y);
            $pdf->MultiCell(20, 9,  $project_present->poster_id, 0, 'L', 0, 0);
          }
        }else{
          $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
          $pdf->SetXY(231,46); //SetXY(x,y);
          $pdf->MultiCell(20, 9,  '-', 0, 'L', 0, 0);
          $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
          $pdf->SetXY(231,52); //SetXY(x,y);
          $pdf->MultiCell(20, 9,  '-', 0, 'L', 0, 0);
        }

        //Cafeteria
        if($user->occ_id == 1){
          $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
          $pdf->SetXY(221,83); //SetXY(x,y);
          $pdf->MultiCell(35, 9,  'Cafeteria', 0, 'L', 0, 0);
        }else{
          if($user->country == 'JP'){
            $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
            $pdf->SetXY(221,83); //SetXY(x,y);
            $pdf->MultiCell(35, 9,  '311 - 313', 0, 'L', 0, 0);
          }else{
            $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
            $pdf->SetXY(221,83); //SetXY(x,y);
            $pdf->MultiCell(35, 9,  '314 - 318', 0, 'L', 0, 0);
          }
        }

        //Hostel
        if($user->occ_id == 1){    //
          $hostel = $this->Member_model->fetch_hostel_id($user->id);
          if($hostel != null){
            $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
            $pdf->SetXY(157,52); //SetXY(x,y);
            $pdf->MultiCell(40, 9,  $hostel->hostel_name, 0, 'L', 0, 0);
            $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
            $pdf->SetXY(157,57); //SetXY(x,y);
            $pdf->MultiCell(40, 9,  'Room: '.$hostel->room, 0, 'L', 0, 0);
          }else{
            $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
            $pdf->SetXY(157,52); //SetXY(x,y);
            $pdf->MultiCell(40, 9,  'Dormitory: -', 0, 'L', 0, 0);
            $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
            $pdf->SetXY(157,57); //SetXY(x,y);
            $pdf->MultiCell(40, 9,  'Room: -', 0, 'L', 0, 0);
          }
        }else{
          $pdf->SetFont('freeserifB', '', 10);   //ขนาตตัวอักษร
          $pdf->SetXY(157,52); //SetXY(x,y);
          $pdf->MultiCell(40, 9,  'Hotel in Mukdahan', 0, 'L', 0, 0);
        }

        // QRCODE
        // set style for barcode
        $style = array(
        	'border' => 0,
        	'vpadding' => 'auto',
        	'hpadding' => 'auto',
        	'fgcolor' => array(0,0,0),
        	'bgcolor' => false, //array(255,255,255)
        	'module_width' => 1, // width of a single module in points
        	'module_height' => 1 // height of a single module in points
        );
        // QRCODE,H : QR-CODE Best error correction
        $pdf->write2DBarcode($user->id, 'QRCODE,H', 69.3, 92, 55, 55, $style, 'N');
        $pdf->SetFont('freeserif', '', 10);   //ขนาตตัวอักษร
        //$pdf->Text(58, 112.5, 'QR-CODE');
    $pdf->Output();

    ?>
