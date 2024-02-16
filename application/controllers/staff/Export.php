<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends Staff_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('Project_model');
    $this->load->model('Org_model');
    $this->load->model('Occ_model');
    $this->load->model('Users_model');
    $this->load->library('email');
  }

  public function index()
  {
    $data['title'] = 'Export Files';
    $data['page'] = 'staff/export/index';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /************************************
    ส่งออกข้อมูล users Excel
  **********************************/
  public function export_all_members()
   {
    //เช็ค REQUEST_METHOD
    if ($this->Users_model->users_count() > 0) {
      $data['title'] = 'Export data list of all member';
      $data['users'] = $this->Users_model->fetch_users();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      //
      $this->load->view('staff/export/export_all_members',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data users</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'staff/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
  }

  //ผู้ร่วมงานทั้งหมด ยกเว้น not attendee
  public function export_members_participant()
   {
    //เช็ค REQUEST_METHOD
    if ($this->Users_model->users_count() > 0) {
      $data['title'] = 'Export data list member participant';
      $data['users'] = $this->Users_model->fetch_users_participant();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      //
      $this->load->view('staff/export/export_all_members',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data users</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'staff/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
  }

  //ผู้ร่วมงานทั้งหมด ยกเว้น not attendee และ observer
  public function export_members_participant_not_observer()
   {
    //เช็ค REQUEST_METHOD
    if ($this->Users_model->users_count() > 0) {
      $data['title'] = 'Export data list member participant not observer';
      $data['users'] = $this->Users_model->fetch_users_participant_not_observer();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      //
      $this->load->view('staff/export/export_all_members',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data users</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'staff/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
  }

  public function export_all_students()
   {
    //เช็ค REQUEST_METHOD
    if ($this->Users_model->users_count() > 0) {
      $data['title'] = 'Export data list of all member student only';
      $data['users'] = $this->Users_model->fetch_users_students();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      //
      $this->load->view('staff/export/export_all_members',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data users</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'staff/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
  }

  public function export_all_member_not_students()
   {
    //เช็ค REQUEST_METHOD
    if ($this->Users_model->users_count() > 0) {
      $data['title'] = 'Export data of all member';
      $data['users'] = $this->Users_model->fetch_users_not_students();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      //
      $this->load->view('staff/export/export_all_members',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data users</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'staff/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
  }

  //ผู้ร่วมงานทั้งหมด Hackathon
  public function export_all_member_hackathon()
   {
    //เช็ค REQUEST_METHOD
    if ($this->Users_model->users_count() > 0) {
      $data['title'] = 'Export data member list fo Hackathon';
      $data['users'] = $this->Users_model->fetch_users_hackathon();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน hackathon
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      //
      $this->load->view('staff/export/export_all_members',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data users</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'staff/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
  }

  //Filter
  function filter_members()
  {
    if( $this->input->server('REQUEST_METHOD') === 'POST'){
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
    }else{
      $data['users'] = $this->Users_model->fetch_users();    //ดึงข้อมูลผู้ใช้จาก username
    }
    $data['title'] = 'Export by filter';
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
    $data['page'] = 'staff/export/filter_members';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  //Filter
  function clear_filter_members()
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
    $data['title'] = 'Export by filter';
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
    $data['page'] = 'staff/export/filter_members';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  //ส่งออกข้อมูล users Excel
  public function export_filter_members()
   {
     //เช็ค REQUEST_METHOD
     if( $this->input->server('REQUEST_METHOD') === 'POST'){
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
       if (count($data['users']) > 0) {
         $data['title'] = 'Export filter member';
         $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
         $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
         //
         $this->load->view('staff/export/export_filter_members',$data);
       }
     }else{
       //reset แสดงผลลัพท์จากระบบ
       $this->session->set_flashdata(
         array(
           'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data users</p></div>',
           'reg_result' => FALSE
           )
         );
       $data['users'] = $this->Users_model->fetch_users();    //ดึงข้อมูลผู้ใช้จาก username
     }
     $data['title'] = 'Export by filter';
     $data['titles'] = $this->Users_model->fetch_title();
     $data['genders'] = $this->Users_model->fetch_gender();
     $data['countrys'] = $this->Users_model->fetch_country();
     $data['foods'] = $this->Users_model->fetch_foods();
     $data['types'] = $this->Users_model->fetch_people_type();
     $data['occ_types'] = $this->Users_model->fetch_occ_type();
     $data['orgs'] = $this->Users_model->fetch_org();
     $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
     $data['page'] = 'staff/export/filter_members';        //หน้าเพจที่จะแสดง
     $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
     $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
     $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  /****************************************
    Export Project
    **************************************/
  //ส่งออกข้อมูล projects Excel
  public function export_all_projects()
   {
    //เช็ค REQUEST_METHOD
    if ($this->Project_model->projects_count() > 0) {
      $data['title'] = 'Export The list of all projects';
      $data['projects'] = $this->Project_model->fetch_projects_sort_id();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      //
      $this->load->view('staff/export/export_all_projects',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data projects</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'staff/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
  }

  public function export_project_required()
   {
    //เช็ค REQUEST_METHOD
    if ($this->Project_model->projects_count() > 0) {
      $data['title'] = 'Export project required';
      $data['projects'] = $this->Project_model->fetch_project_required();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      //
      $this->load->view('staff/export/export_project_required',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data projects</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'staff/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
  }

  /*************************************
      Filter Project
  **************************************/
  //Filter
  function filter_projects()
  {
    if( $this->input->server('REQUEST_METHOD') === 'POST'){
          //เก็บค่า filter
      $data['selected'] = array(
        'category_id' => $this->input->post('category_id'),
        'style_id' => $this->input->post('style_id'),
        'org_id' => $this->input->post('org_id'),
        'files' => $this->input->post('files'),
        'active' => $this->input->post('active')
      );
      $data['projects'] = $this->Project_model->fetch_projects_filter($_POST);    //ดึงข้อมูลผู้ใช้จาก username
    }else{
      $data['projects'] = $this->Project_model->fetch_projects_sort_id();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    }
    $data['title'] = 'Export Project by filter';
    $data['categorys'] = $this->Project_model->fetch_project_category();
    $data['styles'] =$this->Project_model->fetch_project_style();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['page'] = 'staff/export/filter_projects';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  //Filter
  function clear_filter_projects()
  {
    //เก็บค่า filter
    $data['selected'] = array(
      'category_id' => '',
      'style_id' => '',
      'org_id' => '',
      'files' => '',
      'active' => ''
    );
    $data['projects'] = $this->Project_model->fetch_projects_sort_id();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['title'] = 'Export Project by filter';
    $data['categorys'] = $this->Project_model->fetch_project_category();
    $data['styles'] =$this->Project_model->fetch_project_style();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['page'] = 'staff/export/filter_projects';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  //ส่งออกข้อมูล users Excel
  public function export_filter_projects()
   {
     //เช็ค REQUEST_METHOD
     if( $this->input->server('REQUEST_METHOD') === 'POST'){
       //เก็บค่า filter
       $data['selected'] = array(
         'category_id' => $this->input->post('category_id'),
         'style_id' => $this->input->post('style_id'),
         'org_id' => $this->input->post('org_id'),
         'files' => $this->input->post('files'),
         'active' => $this->input->post('active')
       );
       $data['projects'] = $this->Project_model->fetch_projects_filter($_POST);    //ดึงข้อมูลผู้ใช้จาก username
       if (count($data['projects']) > 0) {
         $data['title'] = 'Export Project filter member';
         $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
         $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
         //
         $this->load->view('staff/export/export_filter_projects',$data);
       }
     }else{
       //reset แสดงผลลัพท์จากระบบ
       $this->session->set_flashdata(
         array(
           'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data projects</p></div>',
           'reg_result' => FALSE
           )
         );
       $data['projects'] = $this->Project_model->fetch_projects_sort_id();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
     }
     $data['title'] = 'Export Project by filter';
     $data['categorys'] = $this->Project_model->fetch_project_category();
     $data['styles'] =$this->Project_model->fetch_project_style();
     $data['orgs'] = $this->Users_model->fetch_org();
     $data['page'] = 'staff/export/filter_projects';        //หน้าเพจที่จะแสดง
     $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
     $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
     $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  /************************************
    ส่งออกข้อมูล Organization Excel
  **********************************/
  public function export_all_Organizations()
   {
    //เช็ค REQUEST_METHOD
    if (count($this->Org_model->fetch_org()) > 0) {
      $data['title'] = 'Export The list of all Organizations';
      $data['orgs'] = $this->Users_model->fetch_org();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      //
      $this->load->view('staff/export/export_all_orgs',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data Organizations</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'staff/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
  }



} //class
