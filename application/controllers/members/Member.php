<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Users_Controller
{
   public function __construct(){
     parent::__construct();
     $this->load->model('Member_model');
     $this->load->model('Org_model');
     $this->load->model('Users_model');
     $this->load->model('Site_model');
     $this->load->library('email');
   }

 	public function index()
 	{
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['users'] = $this->Users_model->fetch_users();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
      $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
      $data['occs'] = $this->Users_model->fetch_occ_type();
      $data['types'] = $this->Users_model->fetch_people_type();
 			$data['title'] = 'Member';
 			$data['page'] = 'member/index';
 			$this->load->view('templates/tjsif_member',$data);   //แสดง view
 	}

  //หน้าแรกของ profile
  function info($id)
  {
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['user'] = $this->Users_model->fetch_user_data_id($id);    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = $this->lang->line('profile_title');
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['page'] = 'member/info';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }


  public function invite()
  {
    //เช็คกับกำหนดการลงทะเบียน
    if($this->Site_model->check_register_date($this->System_model->get_date()) == 0){   //ถ้าเกินกำหนด หรือไม่เปิดลงทะเบียน
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registeration closed</strong><p>You are not currently in the registration schedule or the system is not yet registered.</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Invite';
        $data['page'] = 'member/invite';
        $this->load->view('templates/tjsif_member',$data);   //แสดง view
    }else{
      $data['title'] = 'Invite';
      $data['page'] = 'member/invite';
      $this->load->view('templates/tjsif_member',$data);   //แสดง view
  }
  }

  public function send_email()
  {
    //การตั่งค่า congig สำหรับการส่ง email ให้แก้ไขค่าใน application/config
    //กำหนด email address ผู้รับ
    //เช็ค REQUEST_METHOD
    if ($this->input->server('REQUEST_METHOD') == TRUE) {
      //อีเมล์
      $this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email', array(
        'valid_email' => $this->lang->line('warn_email'), //ตัวอักตัวอักษรเท่านั้น
      ));

      //เช็คผลการตรวจสอบข้อมูล
      if (($this->form_validation->run() == TRUE) && ($this->Users_model->record_count_user($this->input->post('email')) == 0)) {    //ถ้าการตรวจสอบ rule ถูกต้อง จะได้ TRUE และ email ยังไม่ถูกใช้ใน tb_users
          $to_addr = $this->input->post('email');
          $this->email->from('noreply@pccm.ac.th', 'tjsif2019');
          $this->email->to($to_addr);
        //  $this->email->cc('another@another-example.com');  //สำเนา...ถ้าต้องการ
        //  $this->email->bcc('them@their-example.com');

          //กำหนดตัวแปรชื่อผู้ส่ง และเนื้อหาในจดหมาย
          $invite_form = '';
          switch($this->session->userdata('title')) {      //เพศ
              case 1: $invite_form .= 'Mr.'; break;
              case 2: $invite_form .= 'Ms.'; break;
              case 3: $invite_form .= 'Mrs.'; break;
              case 4: $invite_form .= 'Miss.'; break;
              case 5: $invite_form .= 'Dr.'; break;
          }
          $invite_form .= $this->session->userdata('firstname').' '.$this->session->userdata('lastname');   //ชื่่อผู้ส่ง
          $data['invite_form'] = $invite_form;
          $body = $this->load->view('member/emails/invite_template.php',$data,TRUE);        //โหลด Template email
          $message = str_replace("%%from%%", $invite_form, $body);      //ใส่ชื่อผู้ส่งลงในไฟล์ template

          //กำหนด Token
          $invite_token = "";
          $invite_token = $this->Member_model->create_token($this->session->userdata('id'), $to_addr);
          $message = str_replace("%%token%%", $invite_token, $message);

          $this->email->subject('The invitation to TJ-SIF2019 Official Website');  //หัวข้อ
          $this->email->message($message);  //กำหนดเนื้อหาในจดหมาย

          //Send mail
           if($this->email->send()){
             //แสดงผลลัพท์จากระบบ
             $this->session->set_flashdata(
     					array(
     						'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Invite Result -> </strong>Email  sent to '.$to_addr.' is successfully.</div>',
                 'reg_result' => TRUE
                 )
     					);
           }else{
             //แสดงผลลัพท์จากระบบ
            $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Invite Result -> </strong>Error in sending Email..</div>',
               'reg_result' => TRUE
               )
            );
           }
          $data['title'] = 'Invite';
          $data['page'] = 'member/invite';
          $this->load->view('templates/tjsif_member',$data);   //แสดง view
      } else {
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Invite Result -> Email  '.$to_addr.' is already exists.</strong></div>',
            'reg_result' => FALSE
            )
          );

          $data['title'] = 'Invite';
          $data['page'] = 'member/invite';
          $this->load->view('templates/tjsif_member',$data);   //แสดง view
      }
    }
  }


}
