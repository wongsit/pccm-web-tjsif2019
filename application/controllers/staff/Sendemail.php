<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * profile by khanchai 20181221
 */
class Sendemail extends Staff_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('Notify_model');
    $this->load->model('Email_model');
    $this->load->model('Users_model');
    $this->load->library('email');
  }
  //หน้าแรกของ Send email
  function index()
  {
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['users'] = $this->Users_model->fetch_users();    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = 'Send email';
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
    $data['page'] = 'staff/sendemail/index';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  //Filter
  function filter()
  {
    //เก็บค่า filter
    $data['selected'] = array(
      'title' => $this->input->post('title'),
      'gender' => $this->input->post('gender'),
      'country' => $this->input->post('country'),
      'food' => $this->input->post('food'),
      'type' => $this->input->post('type'),
      'occ_id' => $this->input->post('occ_id'),
      'org_id' => $this->input->post('org_id'),
      'fieldtrip' => $this->input->post('fieldtrip'),
      'active' => $this->input->post('active')
    );
    $data['users'] = $this->Users_model->fetch_users_filter($_POST);    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = 'Send email-group';
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
    $data['page'] = 'staff/sendemail/index';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  //Filter
  function clear_filter()
  {
    //เก็บค่า filter
    $data['selected'] = array(
      'title' => '',
      'gender' => '',
      'country' => '',
      'food' => '',
      'type' => '',
      'occ_id' => '',
      'org_id' => '',
      'fieldtrip' => '',
      'active' => ''
    );
    $data['users'] = $this->Users_model->fetch_users();    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = 'Send email-group';
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
    $data['page'] = 'staff/sendemail/index';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  function send()
  {
    //Email save content log
    $before = $this->Email_model->count_email();    //นับจำนวนก่อน
    $this->Email_model->add_email_content($_POST);  //เพิ่ม
    $after = $this->Email_model->count_email();    //นับจำนวนหลัง
    $content = $this->input->post('content');
    $count_success = 0;
    if(($after - $before) == 1){  //ถ้าเพิ่ม log email สำเร็จ
      //Save email Sended log
      for ($i=1; $i <= $this->input->post('users_amout'); $i++) {
        $data_send = array(
          'user_id' => $this->input->post('users_id['.$i.']'),
          'user_email' => $this->Users_model->fetch_user_email($this->input->post('users_id['.$i.']')),
          'email_id' => $after,
          'update_ip' => $this->input->post('update_ip'),
          'update_time' => $this->input->post('update_time'),
          'sender' => $this->input->post('update_name')
        );

        if($this->send_email($data_send['user_email'],$this->input->post('email_title'),$content)){
          $this->Email_model->add_email_sended($data_send);   //บันทึกการส่งอีเมล์
          $count_success++; //นับจำนวนที่ส่งสำเร็จ
        }
      }
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="fas fa-info-circle"></i> Result -> </strong> '.$count_success.' emails were sent successfully from a total of '.$this->input->post('users_amout').' emails.</div>',
        )
      );
      redirect('staff/sendemail');
    }
    //แสดงผลลัพท์จากระบบ
    $this->session->set_flashdata(
      array(
        'msg_info' => '<div class="alert alert-warning alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="fas fa-info-circle"></i> Result -> </strong> '.$count_success.' emails were sent successfully from a total of '.$this->input->post('users_amout').' emails.</div>',
      )
    );
    redirect('staff/sendemail');
  }

  function send_email($email_addr,$title,$content)
  {
    //การตั่งค่า congig สำหรับการส่ง email ให้แก้ไขค่าใน application/config
    //กำหนด email address ผู้รับ
    //เช็ค REQUEST_METHOD

      //Sending email
      $to_addr = $email_addr;
      $this->email->from('noreply@pccm.ac.th', 'TJ-SIF 2019');
      $this->email->to($to_addr);
      //  $this->email->cc('another@another-example.com');  //สำเนา...ถ้าต้องการ
      //  $this->email->bcc('them@their-example.com');
      $data['form']='';

      $this->email->subject($title);  //หัวข้อ
      $this->email->message($content);  //กำหนดเนื้อหาในจดหมาย
      //Send mail
      return $this->email->send();    //ถ้าสำเร็จ return = 1
  }
}//class
