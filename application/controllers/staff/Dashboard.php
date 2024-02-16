<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Staff_Controller
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
    $data['title'] = 'Dashboard';
    $data['page'] = 'staff/index';
    $data['projects'] = $this->Project_model->fetch_projects();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['users'] = $this->Users_model->fetch_users();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
    $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
    $data['checkins'] = $this->Activity_model->count_attendance(1);    //ดึงข้อมูลผู้ใช้จาก username+
    $data['souvenirs'] = $this->Activity_model->count_attendance(2);    //ดึงข้อมูลผู้ใช้จาก username+
    
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }


} //class
