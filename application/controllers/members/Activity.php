<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity
 extends Users_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('Project_model');
    $this->load->model('Org_model');
     $this->load->model('Occ_model');
    $this->load->model('Users_model');
    $this->load->model('Activity_model');
    $this->load->library('email');
  }

  public function index()
  {
    $data['registers'] = $this->Activity_model->fetch_activity(1);  //
    $data['dormitorys'] = $this->Activity_model->fetch_activity(2);  //
    $data['presents'] = $this->Activity_model->fetch_activity(4);  //
    $data['fieldtrips'] = $this->Activity_model->fetch_activity(3);  //
    $data['shares'] = $this->Activity_model->fetch_activity(5);  //
    $data['workshops'] = $this->Activity_model->fetch_activity(6);  //
    $data['title'] = 'Activity';
    $data['page'] = 'member/activity/index';
    $this->load->view('templates/tjsif_member',$data);   //แสดง view
  }


  public function attendance()
  {
    $data['attendances'] = $this->Activity_model->fetch_attendance_user($this->session->userdata('id'));  //

    $data['title'] = 'Attendance';
    $data['page'] = 'member/activity/attendance';
    $this->load->view('templates/tjsif_member',$data);   //แสดง view
  }

} //class
