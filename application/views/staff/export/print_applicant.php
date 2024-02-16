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
            $file = dirname(__FILE__)."/print_applicant.pdf";  //ไฟล์ pdf ที่เตรียมไว้
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

    // add a page
    $pdf->AddPage();

        $pdf->setCellPaddings(0, 2, 0, 0);
        $pdf->setCellMargins(0, 0, 0, 0);
        /*------ส่วนหัว-------*/
        $pdf->SetFont('freeserif', '', 14);   //ขนาตตัวอักษร
        $pdf->SetXY(50,32); //SetXY(x,y);
        $pdf->MultiCell(95, 13, $exam->name, 0, 'L', 0, 0);  //ระดับชั้น
        /*-------รายละเอียดผู้สมัคร--------*/
        $pdf->SetFont('freeserif', '', 12);   //ขนาตตัวอักษร
        //สมาชิกในกลุ่ม
        $i=1;
        $j=1;

        /******ท้ายหน้า*******/
        //เลขหน้า
        $page = 1;
        $pdf->SetFont('freeserif', '', 10);   //ขนาตตัวอักษร
        $pdf->setXY(10, 278);
        $pdf->Cell(56, 8, 'หน้า '.$page.'  | Ref.No.: http://sci-mat.pccm.ac.th/admin/applicant/print_applicant Update: '.$this->System_model->date_thai($date_time_stamp), 0, 0, 'L');
        $line = 43;
        foreach ($applicants as $applicant) {
          $line = $line+7;    //คำนวนหาตำแหน่งบรรทัดถัดไป
          //ลำดับ
          $pdf->SetXY(28,$line); //SetXY(x,y);
          $pdf->MultiCell(10, 9, $j, 0, 'L', 0, 0);
          //เลขบัตรประชาชน
          $pdf->SetXY(35,$line); //SetXY(x,y);
          $pdf->MultiCell(50, 9, $applicant->pid, 0, 'L', 0, 0);
          //ชื่อ นามสกุล
          $pdf->SetXY(70,$line); //SetXY(x,y);
          $pdf->MultiCell(50, 9,  $this->User_model->fetch_prename_name($applicant->pname).' '.$applicant->fname.'  '.$applicant->lname, 0, 'L', 0, 0);
          //การศึกษาชั้น
          $pdf->SetXY(124,$line); //SetXY(x,y);
          $pdf->MultiCell(40, 9, $this->Admin_model->fetch_class_name($applicant->s_class), 0, 'L', 0, 0);
          //โทรศัพท์
          $pdf->SetXY(154,$line); //SetXY(x,y);
          $pdf->MultiCell(30, 9, $applicant->phone, 0, 'L', 0, 0);

          $i++;
          $j++;
          if($i>30){    //28 คือ จำนวนสูงสุดของสมาชิกใน 1 หน้า
            $line = 60;
            $pdf->AddPage();
            //เลขหน้า
            $page++;
            $pdf->SetFont('freeserif', '', 10);   //ขนาตตัวอักษร
            $pdf->setXY(10, 278);
            $pdf->Cell(56, 8, 'หน้า '.$page.'  | Ref.No.: http://sci-mat.pccm.ac.th/admin/applicant/print_applicant Update: '.$this->System_model->date_thai($date_time_stamp), 0, 0, 'L');
            $i=0;
          }
        }

    $pdf->Output();

    ?>
