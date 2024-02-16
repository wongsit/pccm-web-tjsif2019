<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends Staff_Controller
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
    $data['page'] = 'staff/project/index';
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  //หน้าแรกของ profile
  function info($id)
  {
    $project = $this->Project_model->fetch_project_data($id);  // //ดึงข้อมูลจาก tb_project
    $data['project'] = $project;  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['categorys'] = $this->Project_model->fetch_project_category();
    $data['styles'] = $this->Project_model->fetch_project_style();
    $data['users'] = $this->Users_model->fetch_users_org_id($project->org_id);    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
    $data['title'] = 'Project infomation';
    $data['page'] = 'staff/project/info';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  //เพิ่มข้อมูล
  public function new()
  {
      $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
      $data['categorys'] = $this->Project_model->fetch_project_category();
      $data['styles'] = $this->Project_model->fetch_project_style();
      $data['users'] = $this->Users_model->fetch_users_org_id($this->session->userdata('org_id'));    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      $data['title'] = 'Create Project';
      $data['page'] = 'staff/project/new';
      $this->load->view('templates/tjsif_staff',$data);   //แสดง view
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
          redirect('staff/projects/index/');
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
          $data['page'] = 'staff/project/new';
          $this->load->view('templates/tjsif_staff',$data);   //แสดง view
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
        $data['page'] = 'staff/project/new';
        $this->load->view('templates/tjsif_staff',$data);   //แสดง view
      }
    }
  }

  public function edit($id)
  {
    $data['project'] = $this->Project_model->fetch_project_data($id);  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['categorys'] = $this->Project_model->fetch_project_category();
    $data['styles'] = $this->Project_model->fetch_project_style();
    $data['users'] = $this->Users_model->fetch_users_org_id($data['project']->org_id);    //ดึงผู้ใช้เฉพาะในโรงเรียนเดียวกัน
    $data['title'] = 'Edit Project';
    $data['page'] = 'staff/project/edit';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
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
          redirect('staff/projects/info/'.$this->input->post('id'));
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
            $data['page'] = 'staff/project/edit';        //หน้าเพจที่จะแสดง
            $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
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
          $data['page'] = 'staff/project/edit';        //หน้าเพจที่จะแสดง
          $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
          $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
          $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
    }
    }
  }

  //หน้าแรก upload picture
  function upload_picture($id)
  {
    $data['title'] = 'Upload picture project';
    $data['project'] = $this->Project_model->fetch_project_data($id);  // //ดึงข้อมูลจาก tb_project ทั้งหมด
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $data['page'] = 'staff/project/upload_picture';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
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
            $data['page'] = 'staff/projects/upload_picture';        //หน้าเพจที่จะแสดง
            $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
    }
    else
    {
            $data = array('upload_data' => $this->upload->data(),
                          'create_thumb' => $this->create_thumb());
            redirect('staff/projects/info/'.$this->input->post('id'));
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
    $data['page'] = 'staff/project/upload_file';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
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
            $data['page'] = 'staff/project/upload_file';        //หน้าเพจที่จะแสดง
            $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
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
            redirect('staff/projects/info/'.$this->input->post('project_id'));
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

  //Delete Project
  function delete($project_id)
  {
    //บันทึกการดาวน์โหลด
    $this->Project_model->delete_project_row($project_id);
    //แสดงผลลัพท์จากระบบ
    $this->session->set_flashdata(
      array(
        'msg_info' => '<div class="alert alert-warning alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Delete data is successfully</div>',
        'reg_result' => TRUE
        )
      );
    //notify
    $notify = array(
      'user_id' => $this->session->userdata('id'),
      'detail' => 'Delete project id '.$project_id,
      'link' => 'members/project/',
      'update_time' => $this->System_model->get_date_time() //เวลา
    );
    $this->Notify_model->add_notify($notify);
    //กลับไปหน้าโปรเจค
    redirect('staff/projects/');
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
    $data['page'] = 'staff/project/upload_file_comment';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
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
            $this->send_email_comment($project_id); //Send email to project of them.
            $data['project'] = $this->Project_model->fetch_project_data($project_id);  // //ดึงข้อมูลจาก tb_project ทั้งหมด
            $data['file_name'] = $file_name;
            $data['page'] = 'staff/project/upload_file_comment';        //หน้าเพจที่จะแสดง
            $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
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
            $project_id = $this->input->post('project_id');
            $this->send_email_comment($project_id); //Send email to project of them.
            redirect('staff/projects/info/'.$this->input->post('project_id'));
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

  public function send_email_comment($project_id)
  {
    //การตั่งค่า congig สำหรับการส่ง email ให้แก้ไขค่าใน application/config
    //กำหนด email address ผู้รับ
    //เช็ค REQUEST_METHOD

      $project = $this->Project_model->fetch_project_data($project_id);  // //ดึงข้อมูลจาก tb_project
      //อีเมล์
      $email = array();
      $j=0;
      $div = explode(",",$project->students); //แยก student id ออกมา แช่น 2,5,12 => 2 5 12
      for($i=0;$i<count($div);$i++){
        $email[$j] = $this->Users_model->fetch_user_email($div[$i]);
        $j++;
      }
      $div = explode(",",$project->teachers); //แยก teachers id ออกมา แช่น 2,5,12 => 2 5 12
      for($i=0;$i<count($div);$i++){
        $email[$j] = $this->Users_model->fetch_user_email($div[$i]);
        $j++;
      }

      //Sending email
      $count_send_mail=0;
      for($i=0;$i<count($email);$i++){
        $to_addr = $email[$i];
        $this->email->from('noreply@pccm.ac.th', 'tjsif2019');
        $this->email->to($to_addr);
        //  $this->email->cc('another@another-example.com');  //สำเนา...ถ้าต้องการ
        //  $this->email->bcc('them@their-example.com');
        $data['form']='';
        $body = $this->load->view('staff/emails/comment_template.php',$data,TRUE);        //โหลด Template email
        //กำหนด project_id
        $message = str_replace("%%project_id%%", $project_id, $body);

        $this->email->subject('Professor comments about your project - TJ-SIF2019 Official Website');  //หัวข้อ
        $this->email->message($message);  //กำหนดเนื้อหาในจดหมาย
        //Send mail
        if($this->email->send()){
          $count_send_mail++;
        }
    }
      //Result
       if($count_send_mail > 0){
         //แสดงผลลัพท์จากระบบ
         $this->session->set_flashdata(
  					array(
  						'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Send email result -> </strong>The email system has been sent to them successfully. Number of email addresses: '.$count_send_mail.' people </div>',
             'reg_result' => TRUE
             )
  					);
          $data['error'] = '';
       }else{
         //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Send email result -> </strong>Error in sending Email..</div>',
           'reg_result' => TRUE
           )
        );
        $data['error'] = 'none';
       }
  }//

  public function import_present()
  {
    $data['title'] = 'Import Presentation room';
    $data['page'] = 'staff/project/import_present_room';
    $data['projects'] = $this->Project_model->fetch_project_present();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function project_present_search()
  {
    if($this->input->post('key') != ''){
		    $data['projects']= $this->Project_model->search_project_present($this->input->post('key'));
	   }else{
       $data['projects'] = $this->Project_model->fetch_project_present();
     }
    $data['title'] = 'Import Presentation room';
    $data['page'] = 'staff/project/import_present_room';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /********************************
    Import Excel
  *********************************/
  function import_present_file()
	{
    if($this->input->post('import') == 'Import'){

      //เพิ่มและอับเดรตข้อมูล
  		if(isset($_FILES["file"]["name"]))
  		{
        $count_add_data = 0;
        $count_update_data = 0;
        //load our new PHPExcel library
        $this->load->library('excel');
        //$data[] = array();
  			$path = $_FILES["file"]["tmp_name"];
        //อินสแตนซ์คลาส PHPExcel
        //$object = new PHPExcel();
  			$object = PHPExcel_IOFactory::load($path);
  			foreach($object->getWorksheetIterator() as $worksheet)
  			{
  				$highestRow = $worksheet->getHighestRow();
  				$highestColumn = $worksheet->getHighestColumn();
  				for($row=2; $row<=$highestRow; $row++)
  				{
  					$new_category = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
  					$new_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
  					$poster_id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
  					$room_id = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
  					$project_id = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $project_name = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $country = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
            $present_time = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
            $room_name = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

  					$data = array(
  						'project_id'		=>	$project_id,
              'project_name'		=>	$project_name,
  						'new_id'			=>	$new_id,
  						'new_category'	=>	$new_category,
  						'poster_id'		=>	$poster_id,
  						'room_id'		=>	$room_id,
              'room_name'		=>	$room_name,
              'country' => $country,
              'present_time' => $present_time
  					);
            if($this->Project_model->count_project_present_id($project_id) > 0){
              $this->Project_model->update_project_present($data);    //อับเดรต
              $count_update_data++;
            }else{
              $this->Project_model->add_project_present($data);      //เพิ่ม
              $count_add_data++;
            }
  				}
  			}
        //แสดงผลลัพท์จากระบบ
        if($count_add_data >0){
          $this->session->set_flashdata(array('msg_add' => '')); //clear
          $this->session->set_flashdata(
            array('msg_add' => '<div class="alert alert-success">Add data '.$count_add_data.' Record </div>')
          );
        }
        //แสดงผลลัพท์จากระบบ
        if($count_update_data >0){
            $this->session->set_flashdata(array('msg_update' => '')); //clear
          $this->session->set_flashdata(
            array('msg_update' => '<div class="alert alert-success">Update data '.$count_update_data.' Record </div>')
          );
        }
  		}else{
        //แสดงผลลัพท์จากระบบ
    		$this->session->set_flashdata(
    			array(
    				'msg_info' => 'ไม่พบไฟล์ข้อมูล'
    			)
    		);
      }
      //กลับไปหน้าโปรเจค import
      redirect('staff/projects/import_present');
    }//if m1

  }

}//class
