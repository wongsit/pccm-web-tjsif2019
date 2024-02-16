<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistic extends Users_Controller
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
    $data['pcshs'] = $this->Org_model->fetch_org_group(1);  // //ดึงข้อมูลจาก tb_org 1=pcshs
    $data['occ_types'] = $this->Occ_model->fetch_occ();  // //ดึงข้อมูลจาก tb_occ_type ทั้งหมด
    $data['categorys'] = $this->Project_model->fetch_project_category();
    $data['styles'] = $this->Project_model->fetch_project_style();
    $data['title'] = 'Statistic';
    $data['page'] = 'member/statistic/index';
    $this->load->view('templates/tjsif_member',$data);   //แสดง view
  }

  public function participant()
  {
    $data['pcshs'] = $this->Org_model->fetch_org_group(1);  // //ดึงข้อมูลจาก tb_org 1=pcshs
    $data['occ_types'] = $this->Occ_model->fetch_occ();  // //ดึงข้อมูลจาก tb_occ_type ทั้งหมด
    $data['categorys'] = $this->Project_model->fetch_project_category();
    $data['styles'] = $this->Project_model->fetch_project_style();
    $data['title'] = 'Statistic';
    $data['page'] = 'member/statistic/participant';
    $this->load->view('templates/tjsif_member',$data);   //แสดง view
  }

  public function participant_observer()
  {
    $data['pcshs'] = $this->Org_model->fetch_org_group(1);  // //ดึงข้อมูลจาก tb_org 1=pcshs
    $data['occ_types'] = $this->Occ_model->fetch_occ();  // //ดึงข้อมูลจาก tb_occ_type ทั้งหมด
    $data['categorys'] = $this->Project_model->fetch_project_category();
    $data['styles'] = $this->Project_model->fetch_project_style();
    $data['title'] = 'Statistic';
    $data['page'] = 'member/statistic/participant_observer';
    $this->load->view('templates/tjsif_member',$data);   //แสดง view
  }

  public function project()
 	{
    //$data['projects'] = $this->Project_model->fetch_projects();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    //$data['pcshs'] = $this->Org_model->fetch_org_group(1);  // //ดึงข้อมูลจาก tb_org 1=pcshs
    $data['occ_types'] = $this->Occ_model->fetch_occ();  // //ดึงข้อมูลจาก tb_occ_type ทั้งหมด
    //$data['categorys'] = $this->Project_model->fetch_project_category();
    //$data['styles'] = $this->Project_model->fetch_project_style();
    $data['title'] = 'Statistic';
    $data['page'] = 'member/statistic/project';
    $this->load->view('templates/tjsif_member',$data);   //แสดง view
 	}

} //class
