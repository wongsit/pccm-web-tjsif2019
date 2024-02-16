<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
   public function __construct(){
     parent::__construct();
     $this->load->model('Org_model');
     $this->load->model('Occ_model');
     $this->load->model('Users_model');
     $this->load->model('Project_model');
	   $this->load->model('Site_model');
   }

 	public function index()
 	{
      $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
      $data['occ_types'] = $this->Occ_model->fetch_occ();  // //ดึงข้อมูลจาก tb_occ_type ทั้งหมด
      $data['org_types'] = $this->Org_model->fetch_org_type();  // //ดึงข้อมูลจาก tb_org_type ทั้งหมด

      //ตาราง student project
      $org_types = $this->Org_model->fetch_org_type();  // //ดึงข้อมูลจาก tb_org_type ทั้งหมด
      $student_static = array(array(1 => 0, 2 => 0,3 => 0));
      foreach ($org_types as $org_type) {
        $orgs = $this->Org_model->fetch_org_group($org_type->id);  // //ดึงข้อมูลจาก tb_org ทั้งหมด
        $student_total = 0;
        $project_total = 0;
        $school_total = 0;
        foreach ($orgs as $org) {
          $student_total += $this->Users_model->users_count_occ_org_id(1,$org->id); //1=student
          $project_total += $this->Project_model->count_project_org_id($org->id);
          if($org->type == $org_type->id)$school_total ++;
        }
        $student_static[$org_type->id][1]=$student_total;
        $student_static[$org_type->id][2]=$project_total;
        $student_static[$org_type->id][3]=$school_total;
      }
      $data['students_static'] = $student_static;

      //ตาราง สรุปโปรเจค แยกโรงเรียน
      $project_types = $this->Project_model->fetch_project_category();
      $orgs = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
      $org_project = array(array(1 => 0, 2 => 0,3 => 0,4 => 0, 5 => 0,6 => 0));
      foreach($orgs as $org) {
        foreach ($project_types as $project_type) {
          $org_project[$org->id][$project_type->id] = $this->Project_model->count_project_org_id_project_type_id($org->id,$project_type->id);
        }
      }
      $data['org_projects'] = $org_project;
      $data['project_types'] = $project_types;

      //ตารางรายละเอียดโปรเจค
      $data['projects'] = $this->Project_model->fetch_projects();

      //ตารางสรุปการลงทะเบียน
      $occ_types = $this->Occ_model->fetch_occ();  // //ดึงข้อมูลจาก tb_occ_type ทั้งหมด
      $org_occs = array(array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 99 => 0, 'sum' => 0));
      foreach($orgs as $org) {
        foreach ($occ_types as $occ_type) {
          $org_occs[$org->id][$occ_type->id] = $this->Users_model->users_count_occ_org_id($occ_type->id,$org->id);
        }
        $org_occs[$org->id]['sum'] = $this->Users_model->users_count_org_id($org->id);
      }
      $data['org_occs'] = $org_occs;

      $data['introduce_member'] = $this->Users_model->introduce_member();   //แนะนำสมาชิก
      $data['introduce_pcshs'] = $this->Users_model->introduce_org_pcshs();   //แนะนำ org
      $data['introduce_ssh'] = $this->Users_model->introduce_org_ssh();   //แนะนำ org
      $data['introduce_kosen'] = $this->Users_model->introduce_org_kosen();   //แนะนำ org
      $data['introduce_project'] = $this->Users_model->introduce_project();   //แนะนำ project

 			$data['title'] = 'Home';
 			$data['page'] = 'home/welcome';
 			$this->load->view('templates/tjsif',$data);   //แสดง view
 	}

  //รายละเอียด project
  function info($id)
  {
    $project = $this->Project_model->fetch_project_data($id);  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['project'] = $project;  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['categorys'] = $this->Project_model->fetch_project_category();
    $data['styles'] = $this->Project_model->fetch_project_style();
    $data['users'] = $this->Users_model->fetch_users_org_id($project->org_id);    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
    $data['title'] = 'Project infomation';
    $data['page'] = 'home/info';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_info',$data);  //เทมเพลต
  }

 	function switchLang($language)
 	{
 		$this->session->set_userdata('site_lang',$language);
 		redirect('welcome');
 	}

  //Download File
  function download($file_name)
  {
    //บันทึกการดาวน์โหลด
    $this->Users_model->update_download($file_name);
    //ดาวน์โหลด
    $this->load->helper('download');
    $data = file_get_contents(base_url().'assets/docs/templates/'.$file_name);
    force_download($file_name, $data);
  }
}
