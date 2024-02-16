<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends Users_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('Project_model');
    $this->load->model('Org_model');
    $this->load->model('Users_model');
    $this->load->model('Site_model');
    $this->load->model('Notify_model');
    $this->load->library('email');
  }

  public function index()
  {
    $data['projects'] = $this->Project_model->fetch_projects();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['categorys'] = $this->Project_model->fetch_project_category();
    $data['styles'] = $this->Project_model->fetch_project_style();
    $data['title'] = 'Project list';
    $data['page'] = 'member/project/index';
    $this->load->view('templates/tjsif_member',$data);   //แสดง view
  }

  //หน้าแรกของ profile
  function info($id)
  {
    $project = $this->Project_model->fetch_project_data($id);  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    if($project != null){
      $data['project'] = $project;  // //ดึงข้อมูลจาก tb_project ทั้งหมด
      $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
      $data['categorys'] = $this->Project_model->fetch_project_category();
      $data['styles'] = $this->Project_model->fetch_project_style();
      $data['users'] = $this->Users_model->fetch_users_org_id($project->org_id);    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
      $data['title'] = 'Project infomation';
      $data['page'] = 'member/project/info';        //หน้าเพจที่จะแสดง
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
    }
  }

  //เพิ่มข้อมูล
  public function new()
  {
    if($this->Site_model->check_abstract_deadline($this->System_model->get_date()) > 0) {
      $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
      $data['categorys'] = $this->Project_model->fetch_project_category();
      $data['styles'] = $this->Project_model->fetch_project_style();
      $data['users'] = $this->Users_model->fetch_users_org_id($this->session->userdata('org_id'));    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      $data['title'] = 'Create Project';
      $data['page'] = 'member/project/new';
      $this->load->view('templates/tjsif_member',$data);   //แสดง view
    }else{
      redirect('members/project');
    }
  }

  //เพิ่มข้อมูล
  public function add()
  {
    //เช็ค REQUEST_METHOD
    if ($this->input->server('REQUEST_METHOD') == TRUE) {
      /*ตรวจสอบความถูกต้องของข้อมูล*/
      //ชื่อโครงการ
      $this->form_validation->set_rules('name', $this->lang->line('name'), 'required', array(
        'required' => $this->lang->line('warn_empty'),  //ห้ามค่าว่าง
      ));
      //เช็คผลการตรวจสอบข้อมูล
      if ($this->form_validation->run() == TRUE) {    //ถ้าการตรวจสอบ rule ถูกต้อง จะได้ TRUE
        if($this->Project_model->add_project($_POST) != null){
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Create project is successfully</div>',
              'reg_result' => TRUE
            )
          );
          redirect('members/project/index/');
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Create project fail ! Please check your data.</div>',
              'reg_result' => FALSE
            )
          );
          //แก้ไขใหม่
          $data['categorys'] = $this->Project_model->fetch_project_category();
          $data['styles'] = $this->Project_model->fetch_project_style();
          $data['users'] = $this->Users_model->fetch_users_org_id($this->session->userdata('org_id'));    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
          $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
          $data['title'] = 'Create Project';
          $data['page'] = 'member/project/new';
          $this->load->view('templates/tjsif_member',$data);   //แสดง view
        }
      } else {     //ถ้าการตรวจสอบ rule ไม่ถูกต้อง
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Create project fail ! Please check your data.</div>',
            'reg_result' => FALSE
          )
        );
        //แก้ไขใหม่
        $data['categorys'] = $this->Project_model->fetch_project_category();
        $data['styles'] = $this->Project_model->fetch_project_style();
        $data['users'] = $this->Users_model->fetch_users_org_id($this->session->userdata('org_id'));    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
        $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
        $data['title'] = 'Create Project';
        $data['page'] = 'member/project/new';
        $this->load->view('templates/tjsif_member',$data);   //แสดง view
      }
    }
  }

  public function edit($id)
  {
    $data['project'] = $this->Project_model->fetch_project_data($id);  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['categorys'] = $this->Project_model->fetch_project_category();
    $data['styles'] = $this->Project_model->fetch_project_style();
    $data['users'] = $this->Users_model->fetch_users_org_id($this->session->userdata('org_id'));    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
    $data['title'] = 'Edit Project';
    $data['page'] = 'member/project/edit';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }

  //อับเดรตข้อมูล
  public function update()
  {
    //เช็ค REQUEST_METHOD
    if ($this->input->server('REQUEST_METHOD') == TRUE) {
      /*ตรวจสอบความถูกต้องของข้อมูล*/
      //ชื่อโครงการ
      $this->form_validation->set_rules('name', $this->lang->line('name'), 'required', array(
        'required' => $this->lang->line('warn_empty'),  //ห้ามค่าว่าง
      ));

      //เช็คผลการตรวจสอบข้อมูล
      if ($this->form_validation->run() == TRUE) {    //ถ้าการตรวจสอบ rule ถูกต้อง จะได้ TRUE
        if($this->Project_model->update_project2($_POST) != null){
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Update data is successfully</div>',
              'reg_result' => TRUE
              )
            );
          //
          //notify
          $notify = array(
            'user_id' => $this->session->userdata('id'),
            'detail' => 'Update data project',
            'link' => 'members/project/info/'.$this->input->post('id'),
            'update_time' => $this->System_model->get_date_time() //เวลา
          );
          $this->Notify_model->add_notify($notify);
          redirect('members/project/info/'.$this->input->post('id'));
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Update data fail ! Please check your data.</div>',
              'reg_result' => FALSE
              )
            );
            $data['project'] = $this->Project_model->fetch_project_data($this->input->post('id'));  // //ดึงข้อมูลจาก tb_project ทั้งหมด
            $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
            $data['categorys'] = $this->Project_model->fetch_project_category();
            $data['styles'] = $this->Project_model->fetch_project_style();
            $data['users'] = $this->Users_model->fetch_users_org_id($this->session->userdata('org_id'));    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
            $data['title'] = 'Update Project fail';
            $data['page'] = 'member/project/edit';        //หน้าเพจที่จะแสดง
            $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
        }
      } else {     //ถ้าการตรวจสอบ rule ไม่ถูกต้อง
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Update data fail ! Please check your data.</div>',
            'reg_result' => FALSE
            )
          );
          //แก้ไขใหม่
          $data['project'] = $this->Project_model->fetch_project_data($this->input->post('id'));  // //ดึงข้อมูลจาก tb_project ทั้งหมด
          $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
          $data['categorys'] = $this->Project_model->fetch_project_category();
          $data['styles'] = $this->Project_model->fetch_project_style();
          $data['users'] = $this->Users_model->fetch_users_org_id($this->session->userdata('org_id'));    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
          $data['title'] = 'Update Project fail';
          $data['page'] = 'member/project/edit';        //หน้าเพจที่จะแสดง
          $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
          $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
          $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
    }
    }
  }

  //หน้าแรก upload picture
  function upload_picture($id)
  {
    $data['title'] = 'Upload picture project';
    $data['project'] = $this->Project_model->fetch_project_data($id);  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $data['page'] = 'member/project/upload_picture';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }

  //Upload Picture
  function do_upload()
  {
    $config['upload_path']          = './assets/images/projects/';
    $config['allowed_types']        = 'jpg';
    $config['max_size']             = 4096;
    $config['max_width']            = 4000;
    $config['max_height']           = 4000;
    $config['file_name']           = 'tjsif2019-project-'.$this->input->post('id');    //กำหนดชื่อไฟล์ที่ต้องการ
    $config['overwrite']           = TRUE;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('photo'))
    {
            $data['error'] =  $this->upload->display_errors();
            //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
            $data['project'] = $this->Project_model->fetch_project_data($this->input->post('id'));  // //ดึงข้อมูลจาก tb_org ทั้งหมด
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $data['title'] = 'Upload picture fail '.$this->lang->line('profile_title');
            $data['page'] = 'member/project/upload_picture';        //หน้าเพจที่จะแสดง
            $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
    }
    else
    {
            $data = array('upload_data' => $this->upload->data(),
                          'create_thumb' => $this->create_thumb());
            redirect('members/project/info/'.$this->input->post('id'));
    }
  }

  //สร้าง thumbnail image หลังจากเรียนใช้ฟังก์ชั่นนี้แล้ว ระบบจะลดขนาดไฟล์ภาพและสร้างใหม่ เป็นชื่อเดียวกับต้นฉบับแต่ตามหลังชื่อด้วย xxx_thumb.jpg
  function create_thumb(){
    $config['image_library'] = 'gd2';
    $config['source_image'] = './assets/images/projects/tjsif2019-project-'.$this->input->post('id').'.jpg';
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width']         = 120;
    $config['height']       = 120;

    $this->load->library('image_lib', $config);

    $this->image_lib->resize();
  }

  //upload files
  function upload_file($project_id,$file_name)
  {
    $data['title'] = 'Upload document project';
    $data['project'] = $this->Project_model->fetch_project_data($project_id);  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['file_name'] = $file_name;
    $data['page'] = 'member/project/upload_file';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }

  //Upload File
  function do_upload_file($file_name)
  {
    $config['upload_path']          = './assets/docs/projects/';
    $config['allowed_types']        = 'docx|pdf';
    $config['max_size']             = 10240;  //maximum 10 MB.
    $config['file_name']           = $file_name;    //กำหนดชื่อไฟล์ที่ต้องการ
    $config['overwrite']           = TRUE;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('document'))
    {
            $data['error'] =  $this->upload->display_errors();
            //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
            $data['title'] = 'Upload document project';
            $data['project'] = $this->Project_model->fetch_project_data($this->input->post('project_id'));  // //ดึงข้อมูลจาก tb_project ทั้งหมด
            $data['file_name'] = $file_name;
            $data['page'] = 'member/project/upload_file';        //หน้าเพจที่จะแสดง
            $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
    }
    else
    {
            $data = array('upload_data' => $this->upload->data());
            //เพิ่ม/อับเดรตข้อมูลใน tb_file
            //$file_check = file_exists('assets/docs/projects/'.$file_name);
            $file_check = $this->Project_model->check_file($file_name);
            if($file_check != null){
              $this->Project_model->update_file($_POST);
            }else{
              $this->Project_model->add_file($_POST);
            }
            redirect('members/project/info/'.$this->input->post('project_id'));
    }
  }

  //Download File
  function download($project_id,$file_name)
  {
    //บันทึกการดาวน์โหลด
    $this->Project_model->update_download($file_name);
    //ดาวน์โหลด
    $this->load->helper('download');
    $data = file_get_contents(base_url().'assets/docs/projects/'.$file_name);
    force_download($file_name, $data);
  }

  /******************************
    File Comment
  *******************************/
    //upload files Comment
    function upload_file_comment($project_id,$file_name)
    {
      $data['title'] = 'Upload file comment';
      $data['project'] = $this->Project_model->fetch_project_data($project_id);  // //ดึงข้อมูลจาก tb_project ทั้งหมด
      $data['file_name'] = $file_name;
      $data['page'] = 'member/project/upload_file_comment';        //หน้าเพจที่จะแสดง
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
    }

    //Upload File  Comment
    function do_upload_file_comment($file_name)
    {
      $config['upload_path']          = './assets/docs/comments/';
      $config['allowed_types']        = 'docx|pdf';
      $config['max_size']             = 10240;  //maximum 10 MB.
      $config['file_name']           = $file_name;    //กำหนดชื่อไฟล์ที่ต้องการ
      $config['overwrite']           = TRUE;

      $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload('document'))
      {
              $data['error'] =  $this->upload->display_errors();
              //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
              $data['title'] = 'Upload file comment';
              $project_id = $this->input->post('project_id');
              $data['project'] = $this->Project_model->fetch_project_data($project_id);  // //ดึงข้อมูลจาก tb_project ทั้งหมด
              $data['file_name'] = $file_name;
              $data['page'] = 'member/project/upload_file_comment';        //หน้าเพจที่จะแสดง
              $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
              $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
              $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
      } else {
              $data = array('upload_data' => $this->upload->data());
              //เพิ่ม/อับเดรตข้อมูลใน tb_file
              //$file_check = file_exists('assets/docs/projects/'.$file_name);
              $file_check = $this->Project_model->check_file_comment($file_name);
              if($file_check != null){
                $this->Project_model->update_file_comment($_POST);
              }else{
                $this->Project_model->add_file_comment($_POST);
              }
              redirect('members/project/info/'.$this->input->post('project_id'));
      }
    }

    //Download File comment
    function download_comment($project_id,$file_name)
    {
      //บันทึกการดาวน์โหลด
      $this->Project_model->update_download_comment($file_name);
      //ดาวน์โหลด
      $this->load->helper('download');
      $data = file_get_contents(base_url().'assets/docs/comments/'.$file_name);
      force_download($file_name, $data);
    }

    /*****************************
     ความต้องการของโครงการ
     ********************************/
    //เพิ่มข้อมูล
    public function required($id)
    {
        $data['project'] = $this->Project_model->fetch_required_project_id($id);
        if($data['project'] != null){
          $data['project_id'] = $id;
          $data['users'] = $this->Users_model->fetch_users_org_id($this->session->userdata('org_id'));    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
          $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
          $data['title'] = 'Special questionnaire.';
          $data['page'] = 'member/project/required_info';
          $this->load->view('templates/tjsif_member',$data);   //แสดง view
        }else {
          $data['project_id'] = $id;
          $data['users'] = $this->Users_model->fetch_users_org_id($this->session->userdata('org_id'));    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
          $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
          $data['title'] = 'Special questionnaire.';
          $data['page'] = 'member/project/required';
          $this->load->view('templates/tjsif_member',$data);   //แสดง view
        }
    }

    //เพิ่มข้อมูล
    public function add_required()
    {
      //เช็ค REQUEST_METHOD
      if ($this->input->server('REQUEST_METHOD') == TRUE) {
          if($this->Project_model->add_required($_POST) != null){
            //แสดงผลลัพท์จากระบบ
            $this->session->set_flashdata(
              array(
                'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Create required is successfully</div>',
                'reg_result' => TRUE
              )
            );
            redirect('members/project/required/'.$this->input->post('project_id'));
          }else{
            //แสดงผลลัพท์จากระบบ
            $this->session->set_flashdata(
              array(
                'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Create required fail ! Please check your data.</div>',
                'reg_result' => FALSE
              )
            );
            $data['project_id'] = $this->input->post('project_id');
            $data['users'] = $this->Users_model->fetch_users_org_id($this->session->userdata('org_id'));    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $data['title'] = 'Special questionnaire.';
            $data['page'] = 'member/project/required';
            $this->load->view('templates/tjsif_member',$data);   //แสดง view
          }
      }
    }

} //class
