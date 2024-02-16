<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends Users_Controller
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
    $data['page'] = 'member/export/index';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_member',$data);   //แสดง view
  }

  //ส่งออกข้อมูล users Excel
  public function export_all_members()
   {
    //เช็ค REQUEST_METHOD
    if ($this->Users_model->users_count() > 0) {
      $data['title'] = 'Export The list of all member';
      $data['users'] = $this->Users_model->fetch_users_participant();  //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      //
      $this->load->view('member/export/export_all_members',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data users</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'member/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_member',$data);   //แสดง view
    }
  }

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
      $this->load->view('member/export/export_all_projects',$data);
    }else{
      //reset แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="w3-panel w3-red"><h3>Find not found</h3><p>Do not have data projects</p></div>',
          'reg_result' => FALSE
          )
        );
        $data['title'] = 'Export Files';
        $data['page'] = 'member/export/index';
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $this->load->view('templates/tjsif_member',$data);   //แสดง view
    }
  }




} //class
