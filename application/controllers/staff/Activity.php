<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends Staff_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('Project_model');
    $this->load->model('Org_model');
    $this->load->model('Occ_model');
    $this->load->model('Users_model');
    $this->load->model('Member_model');
    $this->load->model('Activity_model');
  }

  public function index()
  {
    $data['title'] = 'Activity - Checkin';
    $data['page'] = 'staff/activity/index';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /******************************
    Check in
  *******************************/
  public function check_in()
  {
    $data['title'] = 'Activity - Checkin';
    $data['page'] = 'staff/activity/checkin';
    $data['users'] = $this->Users_model->fetch_users_participant();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
    $data['checkin'] = $this->Activity_model->count_attendance(1);    //ดึงข้อมูลผู้ใช้จาก username+
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function check_in_info()
  {
    $member_id = $this->input->post('id');
    $firstname = $this->input->post('firstname');
    $lastname = $this->input->post('lastname');
    if($member_id != ''){
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['user'] = $this->Users_model->fetch_user_data_id($member_id);    //ดึงข้อมูลผู้ใช้จาก username
      $data['titles'] = $this->Users_model->fetch_title();
      $data['genders'] = $this->Users_model->fetch_gender();
      $data['countrys'] = $this->Users_model->fetch_country();
      $data['foods'] = $this->Users_model->fetch_foods();
      $data['types'] = $this->Users_model->fetch_people_type();
      $data['occ_types'] = $this->Users_model->fetch_occ_type();
      $data['orgs'] = $this->Users_model->fetch_org();
      $data['same'] = $this->Activity_model->count_attendance_same(1,$member_id);    //ดึงข้อมูลผู้ใช้จาก username+
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => ''
        )
      );
    }else if(($firstname != '') && ($lastname != '')){
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['user2'] = $this->Users_model->fetch_user_like_name($firstname,$lastname);    //ดึงข้อมูลผู้ใช้จาก username+
        $data['orgs'] = $this->Users_model->fetch_org();
    }else{
        redirect('staff/activity/check_in');
    }

    $data['title'] = 'Activity - Checkin';
    $data['page'] = 'staff/activity/checkin';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function select_info($member_id)
  {

    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['user'] = $this->Users_model->fetch_user_data_id($member_id);    //ดึงข้อมูลผู้ใช้จาก username
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
      $data['same'] = $this->Activity_model->count_attendance_same(1,$member_id);    //ดึงข้อมูลผู้ใช้จาก username+
    //แสดงผลลัพท์จากระบบ
    $this->session->set_flashdata(
      array(
        'msg_info' => ''
      )
    );

    $data['title'] = 'Activity - Checkin';
    $data['page'] = 'staff/activity/checkin';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function checkin_confirm()
  {
    $id = $this->input->post('id');
    if($id == ''){
      if($this->Activity_model->add_attendance($_POST) != null){

        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Checkin is successfully</div>',
            'reg_result' => TRUE
          )
        );
        redirect('staff/activity/check_in');
      }
    }else{
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Confirmation unsuccessful.</div>',
          'reg_result' => TRUE
        )
      );
    }

    $data['title'] = 'Activity - Checkin';
    $data['page'] = 'staff/activity/checkin';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function export_checkin()
  {
    $data['title'] = 'Activity - Export Check-in';
    $data['page'] = 'staff/activity/export_checkin';
    $data['users'] = $this->Users_model->fetch_users_participant();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
    $data['checkin'] = $this->Activity_model->count_attendance(1);    //ดึงข้อมูลผู้ใช้จาก username+
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /******************************
    Check out
  *******************************/
  public function check_souvenir()
  {
    $data['title'] = 'Activity - Check Souvenir';
    $data['page'] = 'staff/activity/souvenir';
    $data['users'] = $this->Users_model->fetch_users_participant();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
    $data['checkin'] = $this->Activity_model->count_attendance(1);    //ดึงข้อมูลผู้ใช้จาก username+
    $data['souvenir'] = $this->Activity_model->count_attendance(2);    //ดึงข้อมูลผู้ใช้จาก username+
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function check_souvenir_info()
  {
    $member_id = $this->input->post('id');
    $firstname = $this->input->post('firstname');
    $lastname = $this->input->post('lastname');
    if($member_id != ''){
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['user'] = $this->Users_model->fetch_user_data_id($member_id);    //ดึงข้อมูลผู้ใช้จาก username
      $data['titles'] = $this->Users_model->fetch_title();
      $data['genders'] = $this->Users_model->fetch_gender();
      $data['countrys'] = $this->Users_model->fetch_country();
      $data['foods'] = $this->Users_model->fetch_foods();
      $data['types'] = $this->Users_model->fetch_people_type();
      $data['occ_types'] = $this->Users_model->fetch_occ_type();
      $data['orgs'] = $this->Users_model->fetch_org();
      $data['same'] = $this->Activity_model->count_attendance_same(2,$member_id);    //ดึงข้อมูลผู้ใช้จาก username+
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => ''
        )
      );
    }else if(($firstname != '') && ($lastname != '')){
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['user2'] = $this->Users_model->fetch_user_like_name($firstname,$lastname);    //ดึงข้อมูลผู้ใช้จาก username+
        $data['orgs'] = $this->Users_model->fetch_org();
    }else{
      redirect('staff/activity/check_souvenir');
    }

    $data['title'] = 'Activity - Check souvenir';
    $data['page'] = 'staff/activity/souvenir';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function souvenir_info($member_id)
  {

    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['user'] = $this->Users_model->fetch_user_data_id($member_id);    //ดึงข้อมูลผู้ใช้จาก username
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
      $data['same'] = $this->Activity_model->count_attendance_same(1,$member_id);    //ดึงข้อมูลผู้ใช้จาก username+
    //แสดงผลลัพท์จากระบบ
    $this->session->set_flashdata(
      array(
        'msg_info' => ''
      )
    );

    $data['title'] = 'Activity - Check souvenir';
    $data['page'] = 'staff/activity/souvenir';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function souvenir_confirm()
  {
    $id = $this->input->post('id');
    if($id == ''){
      if($this->Activity_model->add_attendance($_POST) != null){

        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> souvenir is successfully</div>',
            'reg_result' => TRUE
          )
        );
        redirect('staff/activity/check_souvenir');
      }
    }else{
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Confirmation unsuccessful.</div>',
          'reg_result' => TRUE
        )
      );
    }

    $data['title'] = 'Activity - Check souvenir';
    $data['page'] = 'staff/activity/souvenir';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function export_souvenir()
  {
    $data['title'] = 'Activity - Export Check Souvenirt';
    $data['page'] = 'staff/activity/export_souvenir';
    $data['users'] = $this->Users_model->fetch_users_participant();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
    $data['checkin'] = $this->Activity_model->count_attendance(2);    //2=check-out
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /******************************
    dormitory
  *******************************/
  public function dormitory($activity_id)
  {
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $activity_type = $this->Activity_model->get_activity_type($activity->type);
    $data['title'] = 'Activity '.$activity_type.'-'.$activity->name;
    $data['page'] = 'staff/activity/dormitory';
    $data['users'] = $this->Member_model->fetch_hostel_dormitory($activity->ref);  //ดึงข้อมูลทผู้ใช้ Domitory
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['in'] = $this->Activity_model->fetch_attendance_status($activity_id,'in');  //ดึงข้อมูลทผู้ใช้ที่เข้า Domitory
    $data['out'] =  $this->Activity_model->fetch_attendance_status($activity_id,'out');  //ดึงข้อมูลทผู้ใช้ทีออก Domitory
    $data['activity_id'] = $activity_id;
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function dormitory_info()
  {
    $member_id = $this->input->post('id');
    $firstname = $this->input->post('firstname');
    $lastname = $this->input->post('lastname');
    if($member_id != ''){
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['user'] = $this->Users_model->fetch_user_data_id($member_id);    //ดึงข้อมูลผู้ใช้จาก username
      $data['titles'] = $this->Users_model->fetch_title();
      $data['genders'] = $this->Users_model->fetch_gender();
      $data['countrys'] = $this->Users_model->fetch_country();
      $data['foods'] = $this->Users_model->fetch_foods();
      $data['types'] = $this->Users_model->fetch_people_type();
      $data['occ_types'] = $this->Users_model->fetch_occ_type();
      $data['orgs'] = $this->Users_model->fetch_org();
      $data['same'] = $this->Activity_model->count_attendance_same(1,$member_id);    //ดึงข้อมูลผู้ใช้จาก username+
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => ''
        )
      );
    }else if(($firstname != '') && ($lastname != '')){
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['user2'] = $this->Users_model->fetch_user_like_name($firstname,$lastname);    //ดึงข้อมูลผู้ใช้จาก username+
      $data['orgs'] = $this->Users_model->fetch_org();
    }else{
        redirect('staff/activity/dormitory/'.$this->input->post('activity_id'));
    }
    //ข้อมูล activity
    $activity_id = $this->input->post('activity_id');
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $activity_type = $this->Activity_model->get_activity_type($activity->type);
    //ข้อมูล hostel
    $hostel = $this->Member_model->fetch_hostel_id($member_id);  //ข้อมูลผู้เข้าพัก
    if ($hostel!=null){
      $hostel_name = $hostel->hostel_name;
    }else{
      $hostel_name = 'no name';
    }
    //ตรวจสอบ ผู้เข้าหอ
    if($hostel_name == $activity->ref){
      $this->dormitory_update_status($activity_id,$member_id);
    }else{
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><h1>WRONG DORMITORY: </h1> This member cannot be found in this dormitory.</div>',
          'reg_result' => TRUE
        )
      );
    }


    $data['title'] = 'Activity '.$activity_type.'-'.$activity->name;
    $data['page'] = 'staff/activity/dormitory';
    $data['users'] = $this->Member_model->fetch_hostel_dormitory($activity->ref);  //ดึงข้อมูลทผู้ใช้ Domitory
    $data['in'] = $this->Activity_model->fetch_attendance_status($activity_id,'in');  //ดึงข้อมูลทผู้ใช้ที่เข้า Domitory
    $data['out'] =  $this->Activity_model->fetch_attendance_status($activity_id,'out');  //ดึงข้อมูลทผู้ใช้ทีออก Domitory
    $data['activity_id'] = $activity_id;
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function select_dormitory_info($member_id,$activity_id)
  {
    if($member_id != ''){
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['user'] = $this->Users_model->fetch_user_data_id($member_id);    //ดึงข้อมูลผู้ใช้จาก username
      $data['titles'] = $this->Users_model->fetch_title();
      $data['genders'] = $this->Users_model->fetch_gender();
      $data['countrys'] = $this->Users_model->fetch_country();
      $data['foods'] = $this->Users_model->fetch_foods();
      $data['types'] = $this->Users_model->fetch_people_type();
      $data['occ_types'] = $this->Users_model->fetch_occ_type();
      $data['orgs'] = $this->Users_model->fetch_org();
      $data['same'] = $this->Activity_model->count_attendance_same(1,$member_id);    //ดึงข้อมูลผู้ใช้จาก username+
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => ''
        )
      );
    }else{
        redirect('staff/activity/dormitory/'.$this->input->post('activity_id'));
    }
    //ข้อมูล activity
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $activity_type = $this->Activity_model->get_activity_type($activity->type);
    //ข้อมูล hostel
    $hostel = $this->Member_model->fetch_hostel_id($member_id);  //ข้อมูลผู้เข้าพัก
    if ($hostel!=null){
      $hostel_name = $hostel->hostel_name;
    }else{
      $hostel_name = 'no name';
    }
    //ตรวจสอบ ผู้เข้าหอ
    if($hostel_name == $activity->ref){
      $this->dormitory_update_status($activity_id,$member_id);
    }else{
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><h1>WRONG DORMITORY: </h1> This member cannot be found in this dormitory.</div>',
          'reg_result' => TRUE
        )
      );
    }
    $data['title'] = 'Activity '.$activity_type.'-'.$activity->name;
    $data['page'] = 'staff/activity/dormitory';
    $data['users'] = $this->Member_model->fetch_hostel_dormitory($activity->ref);  //ดึงข้อมูลทผู้ใช้ Domitory
    $data['in'] = $this->Activity_model->fetch_attendance_status($activity_id,'in');  //ดึงข้อมูลทผู้ใช้ที่เข้า Domitory
    $data['out'] =  $this->Activity_model->fetch_attendance_status($activity_id,'out');  //ดึงข้อมูลทผู้ใช้ทีออก Domitory
    $data['activity_id'] = $activity_id;
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /*  อับเดรตข้อมูล */
  public function dormitory_update_status($activity_id,$user_id)
  {
    if($user_id != ''){
      //วันนี้
      $in = $this->Activity_model->count_attendance_in($activity_id,$user_id);
      //ตั้งค่าตั้วแปรก่อนเก็บลงฐานข้อมูล
      $data = array(
        'activity_id' => $activity_id,
        'member_id' => $user_id,
        'status' => 'in',
        'date_check' =>  $this->System_model->get_date(), //เวลา,
        'staff_id' => $this->session->userdata('id'),
        'update_ip' => $this->System_model->get_client_ip(), //ไอพี
        'update_time' => $this->System_model->get_date_time() //เวลา
      );
      $result = '';
      if($in == 0){    //ยังไม่มีให้ เพิ่ม
          $result = $this->Activity_model->add_attendance($data);
        }else{       //ซ้ำ ให้อับเดรต
          $result = $this->Activity_model->update_attendance($data);
        }
        //แสดงผลลัพท์
        if($result){
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Update Successfuly</div>',
              'reg_result' => TRUE
            )
          );
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Update Fail</div>',
              'reg_result' => TRUE
            )
          );
        }
      }//if user_id
  }

  public function export_dormitory($activity_id,$date_check)
  {
    //ข้อมูล activity
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $data['title'] = 'Export_Data_'.$activity->ref.'_'.$date_check;
    $data['page'] = 'staff/activity/export_dormitory';
    $data['users'] = $this->Users_model->fetch_users_participant();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
    $data['check'] = $this->Activity_model->fetch_attendance_domitory($activity_id,$date_check);    //ดึงข้อมูลผู้ใช้จาก username+
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /******************************
    Present
  *******************************/
  public function present($activity_id)
  {
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $activity_type = $this->Activity_model->get_activity_type($activity->type);
    $data['title'] = 'Activity '.$activity_type.' - '.$activity->name;
    $data['page'] = 'staff/activity/present';
    $data['users'] = $this->Users_model->fetch_users_participant();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['in'] = $this->Activity_model->fetch_attendance_present($activity_id,'in');  //ดึงข้อมูลทผู้ใช้ที่เข้า Domitory
    $data['activity_id'] = $activity_id;
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function present_info()
  {
    $member_id = $this->input->post('id');
    if($member_id != ''){
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['user'] = $this->Users_model->fetch_user_data_id($member_id);    //ดึงข้อมูลผู้ใช้จาก username
      $data['titles'] = $this->Users_model->fetch_title();
      $data['genders'] = $this->Users_model->fetch_gender();
      $data['countrys'] = $this->Users_model->fetch_country();
      $data['foods'] = $this->Users_model->fetch_foods();
      $data['types'] = $this->Users_model->fetch_people_type();
      $data['occ_types'] = $this->Users_model->fetch_occ_type();
      $data['orgs'] = $this->Users_model->fetch_org();
      $data['same'] = $this->Activity_model->count_attendance_same(1,$member_id);    //ดึงข้อมูลผู้ใช้จาก username+
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => ''
        )
      );
    }else{
        redirect('staff/activity/present/'.$this->input->post('activity_id'));
    }
    //ข้อมูล activity
    $activity_id = $this->input->post('activity_id');
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $activity_type = $this->Activity_model->get_activity_type($activity->type);

    //ตรวจสอบ ผู้เข้าหอ
    $this->present_update_status($activity_id,$member_id);

    $data['title'] = 'Activity '.$activity_type.'-'.$activity->name;
    $data['page'] = 'staff/activity/present';
    $data['users'] = $this->Users_model->fetch_users_participant();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
    $data['in'] = $this->Activity_model->fetch_attendance_present($activity_id,'in');  //ดึงข้อมูลทผู้ใช้ที่เข้า Domitory
    $data['activity_id'] = $activity_id;
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /*  อับเดรตข้อมูล */
  public function present_update_status($activity_id,$user_id)
  {
    if($user_id != ''){
      //วันนี้
      $in = $this->Activity_model->count_attendance_in($activity_id,$user_id);
      //ตั้งค่าตั้วแปรก่อนเก็บลงฐานข้อมูล
      $data = array(
        'activity_id' => $activity_id,
        'member_id' => $user_id,
        'status' => 'in',
        'date_check' =>  $this->System_model->get_date(), //เวลา,
        'staff_id' => $this->session->userdata('id'),
        'update_ip' => $this->System_model->get_client_ip(), //ไอพี
        'update_time' => $this->System_model->get_date_time() //เวลา
      );
      $result = '';
      if($in == 0){    //ยังไม่มีให้ เพิ่ม
          $result = $this->Activity_model->add_attendance($data);
        }else{       //ซ้ำ ให้อับเดรต
          $result = $this->Activity_model->update_attendance($data);
        }
        //แสดงผลลัพท์
        if($result){
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Update Successfuly</div>',
              'reg_result' => TRUE
            )
          );
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Update Fail</div>',
              'reg_result' => TRUE
            )
          );
        }
      }//if user_id
  }

  public function export_present($activity_id)
  {
    //ข้อมูล activity
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $data['title'] = 'Export_Data_'.$activity->ref;
    $data['page'] = 'staff/activity/export_present';
    $data['users'] = $this->Users_model->fetch_users_participant();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
    $data['check'] = $this->Activity_model->count_attendance($activity_id);    //ดึงข้อมูลผู้ใช้จาก username+
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /******************************
    Field trip
  *******************************/
  public function fieldtrip($activity_id)
  {
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $activity_type = $this->Activity_model->get_activity_type($activity->type);
    $data['title'] = 'Activity '.$activity_type.'-'.$activity->name;
    $data['page'] = 'staff/activity/fieldtrip';
    $data['users'] = $this->Users_model->fetch_fieldtrip_chose($activity->ref);  //ดึงข้อมูลทผู้ใช้ Domitory
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['go'] = $this->Activity_model->fetch_attendance_status($activity_id,'go');  //ดึงข้อมูลทผู้ใช้ที่เข้า Domitory
    $data['back'] =  $this->Activity_model->fetch_attendance_status($activity_id,'back');  //ดึงข้อมูลทผู้ใช้ทีออก Domitory
    $data['activity_id'] = $activity_id;
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function fieldtrip_info()
  {
    $member_id = $this->input->post('id');
    if($member_id != ''){
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['user'] = $this->Users_model->fetch_user_data_id($member_id);    //ดึงข้อมูลผู้ใช้จาก username
      $data['titles'] = $this->Users_model->fetch_title();
      $data['genders'] = $this->Users_model->fetch_gender();
      $data['countrys'] = $this->Users_model->fetch_country();
      $data['foods'] = $this->Users_model->fetch_foods();
      $data['types'] = $this->Users_model->fetch_people_type();
      $data['occ_types'] = $this->Users_model->fetch_occ_type();
      $data['orgs'] = $this->Users_model->fetch_org();
      $data['same'] = $this->Activity_model->count_attendance_same(1,$member_id);    //ดึงข้อมูลผู้ใช้จาก username+
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => ''
        )
      );
    }else{
        redirect('staff/activity/fieldtrip/'.$this->input->post('activity_id'));
    }
    //ข้อมูล activity
    $activity_id = $this->input->post('activity_id');
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $activity_type = $this->Activity_model->get_activity_type($activity->type);
    //ข้อมูล hostel
    $fieldtrip = $this->Users_model->fetch_fieldtrip_chose_id($member_id);  //ข้อมูลผู้เข้าพัก
    if ($fieldtrip != null){
      $fieldtrip_id = $fieldtrip->fieldtrip_id;
    }else{
      $hostel_name = 'no name';
    }
    //ตรวจสอบ ผู้เข้าหอ
    if($fieldtrip_id == $activity->ref){
      $this->fieldtrip_update_status($activity_id,$member_id);
    }else{
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><h1>WRONG FIELD TRIP ROUNT: </h1> This member cannot be found in this fieldtrip.</div>',
          'reg_result' => TRUE
        )
      );
    }
    $data['title'] = 'Activity '.$activity_type.'-'.$activity->name;
    $data['page'] = 'staff/activity/fieldtrip';
    $data['users'] = $this->Users_model->fetch_fieldtrip_chose($activity->ref);  //ดึงข้อมูลทผู้ใช้ Domitory
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['go'] = $this->Activity_model->fetch_attendance_status($activity_id,'go');  //ดึงข้อมูลทผู้ใช้ที่เข้า Domitory
    $data['back'] =  $this->Activity_model->fetch_attendance_status($activity_id,'back');  //ดึงข้อมูลทผู้ใช้ทีออก Domitory
    $data['activity_id'] = $activity_id;
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /*  อับเดรตข้อมูล */
  public function fieldtrip_update_status($activity_id,$user_id)
  {
    if($user_id != ''){
      //วันนี้
      $go = $this->Activity_model->count_attendance_go($activity_id,$user_id);
      $back = $this->Activity_model->count_attendance_back($activity_id,$user_id);

      $result = '';
      if($go == 0 && $back == 0){    //ยังไม่มีให้ เพิ่ม
          //ตั้งค่าตั้วแปรก่อนเก็บลงฐานข้อมูล
          $data = array(
            'activity_id' => $activity_id,
            'member_id' => $user_id,
            'status' => 'go',
            'date_check' =>  $this->System_model->get_date(), //เวลา,
            'staff_id' => $this->session->userdata('id'),
            'update_ip' => $this->System_model->get_client_ip(), //ไอพี
            'update_time' => $this->System_model->get_date_time() //เวลา
          );
          $result = $this->Activity_model->add_attendance($data);
        }else if($go == 1 && $back == 0){    //ยังไม่มีให้ เพิ่ม
          //ตั้งค่าตั้วแปรก่อนเก็บลงฐานข้อมูล
          $data = array(
            'activity_id' => $activity_id,
            'member_id' => $user_id,
            'status' => 'back',
            'date_check' =>  $this->System_model->get_date(), //เวลา,
            'staff_id' => $this->session->userdata('id'),
            'update_ip' => $this->System_model->get_client_ip(), //ไอพี
            'update_time' => $this->System_model->get_date_time() //เวลา
          );
          $result = $this->Activity_model->add_attendance($data);
        }else{       //ซ้ำ ให้อับเดรต
          //ตั้งค่าตั้วแปรก่อนเก็บลงฐานข้อมูล
          $data = array(
            'activity_id' => $activity_id,
            'member_id' => $user_id,
            'status' => 'back',
            'date_check' =>  $this->System_model->get_date(), //เวลา,
            'staff_id' => $this->session->userdata('id'),
            'update_ip' => $this->System_model->get_client_ip(), //ไอพี
            'update_time' => $this->System_model->get_date_time() //เวลา
          );
          $result = $this->Activity_model->update_attendance($data);
          $result = $this->Activity_model->delete_activity_back($data);
        }
        //แสดงผลลัพท์
        if($result){
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Update Successfuly</div>',
              'reg_result' => TRUE
            )
          );
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Update Fail</div>',
              'reg_result' => TRUE
            )
          );
        }
      }//if user_id
  }

  public function export_fieldtrip_go($activity_id)
  {
    //ข้อมูล activity
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $data['title'] = 'Export_Data_'.$activity->name.'_Go';
    $data['page'] = 'staff/activity/export_fieldtrip';
    $data['users'] = $this->Users_model->fetch_fieldtrip_chose($activity->ref);  //ดึงข้อมูลทผู้ใช้ Domitory
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['check'] = $this->Activity_model->fetch_attendance_fieldtrip_go($activity_id);  //ดึงข้อมูลทผู้ใช้ที่เข้า Domitory
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function export_fieldtrip_back($activity_id)
  {
    //ข้อมูล activity
    $activity = $this->Activity_model->fetch_activity_row($activity_id);
    $data['title'] = 'Export_Data_'.$activity->name.'_Back';
    $data['page'] = 'staff/activity/export_fieldtrip';
    $data['users'] = $this->Users_model->fetch_fieldtrip_chose($activity->ref);  //ดึงข้อมูลทผู้ใช้ Domitory
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['check'] = $this->Activity_model->fetch_attendance_fieldtrip_back($activity_id);  //ดึงข้อมูลทผู้ใช้ที่เข้า Domitory
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }




} //class
