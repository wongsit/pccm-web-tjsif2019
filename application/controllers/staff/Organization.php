<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organization extends Staff_Controller
{
   public function __construct(){
     parent::__construct();
     $this->load->model('Org_model');
     $this->load->model('Notify_model');
   }

 	public function index()
 	{
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
 			$data['title'] = 'Organization';
 			$data['page'] = 'staff/organization/index';
 			$this->load->view('templates/tjsif_staff',$data);   //แสดง view
 	}

  public function info($org_id)
  {
     //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
     $data['org'] = $this->Org_model-> fetch_org_data($org_id);  // //ดึงข้อมูลจาก tb_org ทั้งหมด
     $data['org_types'] = $this->Org_model->fetch_org_type(); //ดึงข้อมูลจาก tb_org_type ทั้งหมด
     $data['countrys'] = $this->Org_model->fetch_country();
      $data['title'] = 'Organization infomation';
      $data['page'] = 'staff/organization/info';
      $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function new()
  {
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['org_types'] = $this->Org_model->fetch_org_type(); //ดึงข้อมูลจาก tb_org_type ทั้งหมด
      $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
      $data['countrys'] = $this->Org_model->fetch_country();
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
       $data['title'] = 'Add organization';
       $data['page'] = 'staff/organization/new';
       $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  //เพิ่มข้อมูล
  public function add()
  {
    //เช็ค REQUEST_METHOD
    if ($this->input->server('REQUEST_METHOD') == TRUE) {
      /*ตรวจสอบความถูกต้องของข้อมูล*/
      //อีเมล์
      $this->form_validation->set_rules('e_mail', $this->lang->line('e_mail'), 'valid_email', array(
        'valid_email' => $this->lang->line('warn_email'),//ตัวอักตัวอักษรเท่านั้น
      ));

      //เช็คผลการตรวจสอบข้อมูล
      if ($this->form_validation->run() == TRUE) {    //ถ้าการตรวจสอบ rule ถูกต้อง จะได้ TRUE
        if($this->Org_model->add_org($_POST) != null){
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Update data is successfully</div>',
              'reg_result' => TRUE
              )
            );
          //$this->Users_model->update_profile($_POST); //เพิ่มข้อมูล user
          redirect('staff/organization/index/');
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Update data fail ! Please check your data.</div>',
              'reg_result' => FALSE
              )
            );
            //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
            $data['org'] = $this->Org_model-> fetch_org_data($org_id);  // //ดึงข้อมูลจาก tb_org ทั้งหมด
            $data['org_types'] = $this->Org_model->fetch_org_type(); //ดึงข้อมูลจาก tb_org_type ทั้งหมด
            $data['countrys'] = $this->Org_model->fetch_country();
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
             $data['title'] = 'Update date fail';
             $data['page'] = 'staff/organization/new';
             $this->load->view('templates/tjsif_staff',$data);   //แสดง view
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
          //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
          $data['org'] = $this->Org_model-> fetch_org_data($org_id);  // //ดึงข้อมูลจาก tb_org ทั้งหมด
          $data['org_types'] = $this->Org_model->fetch_org_type(); //ดึงข้อมูลจาก tb_org_type ทั้งหมด
          $data['countrys'] = $this->Org_model->fetch_country();
          $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
           $data['title'] = 'Update date fail';
           $data['page'] = 'staff/organization/new';
           $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
    }
  }

  public function edit($org_id)
  {
     //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
     $data['org'] = $this->Org_model->fetch_org_data($org_id);  // //ดึงข้อมูลจาก tb_org ทั้งหมด
     $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
     $data['org_types'] = $this->Org_model->fetch_org_type(); //ดึงข้อมูลจาก tb_org_type ทั้งหมด
     $data['countrys'] = $this->Org_model->fetch_country();
     $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      $data['title'] = 'Organization';
      $data['page'] = 'staff/organization/edit';
      $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  //อับเดรตข้อมูล
  public function update()
  {
    //เช็ค REQUEST_METHOD
    if ($this->input->server('REQUEST_METHOD') == TRUE) {
      /*ตรวจสอบความถูกต้องของข้อมูล*/
      //อีเมล์
      $this->form_validation->set_rules('e_mail', $this->lang->line('e_mail'), 'valid_email', array(
        'valid_email' => $this->lang->line('warn_email'),//ตัวอักตัวอักษรเท่านั้น
      ));

      //เช็คผลการตรวจสอบข้อมูล
      if ($this->form_validation->run() == TRUE) {    //ถ้าการตรวจสอบ rule ถูกต้อง จะได้ TRUE
        if($this->Org_model->update_org2($_POST) != null){
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
            'detail' => 'Update data organization',
            'link' => 'members/organization/info/'.$this->input->post('id'),
            'update_time' => $this->System_model->get_date_time() //เวลา
          );
          $this->Notify_model->add_notify($notify);
          redirect('staff/organization/info/'.$this->input->post('id'));
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Update data fail ! Please check your data.</div>',
              'reg_result' => FALSE
              )
            );
            //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
            $data['org'] = $this->Org_model-> fetch_org_data($this->input->post('id'));  // //ดึงข้อมูลจาก tb_org ทั้งหมด
            $data['org_types'] = $this->Org_model->fetch_org_type(); //ดึงข้อมูลจาก tb_org_type ทั้งหมด
            $data['countrys'] = $this->Org_model->fetch_country();
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
             $data['title'] = 'Update date fail';
             $data['page'] = 'staff/organization/edit';
             $this->load->view('templates/tjsif_staff',$data);   //แสดง view
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
          //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
          $data['org'] = $this->Org_model-> fetch_org_data($this->input->post('id'));  // //ดึงข้อมูลจาก tb_org ทั้งหมด
          $data['org_types'] = $this->Org_model->fetch_org_type(); //ดึงข้อมูลจาก tb_org_type ทั้งหมด
          $data['countrys'] = $this->Org_model->fetch_country();
          $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
           $data['title'] = 'Update date fail';
           $data['page'] = 'staff/organization/edit';
           $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }
    }
  }

  //หน้าแรก edit organization
  function upload_picture($org_id)
  {
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['title'] = 'Upload picture '.$this->lang->line('profile_title');
    $data['org'] = $this->Org_model-> fetch_org_data($org_id);  // //ดึงข้อมูลจาก tb_org ทั้งหมด
    $data['org_types'] = $this->Org_model->fetch_org_type(); //ดึงข้อมูลจาก tb_org_type ทั้งหมด
    $data['countrys'] = $this->Org_model->fetch_country();
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $data['page'] = 'staff/organization/upload_picture';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  //Upload Picture
  function do_upload()
  {
    $config['upload_path']          = './assets/images/orgs/';
    $config['allowed_types']        = 'jpg';
    $config['max_size']             = 10240;
    $config['max_width']            = 4096;
    $config['max_height']           = 4096;
    $config['file_name']           = 'tjsif2019-org-'.$this->input->post('org_id');    //กำหนดชื่อไฟล์ที่ต้องการ
    $config['overwrite']           = TRUE;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('photo'))
    {
            $data['error'] =  $this->upload->display_errors();
            //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
            $data['org'] = $this->Org_model-> fetch_org_data($this->input->post('org_id'));  // //ดึงข้อมูลจาก tb_org ทั้งหมด
            $data['org_types'] = $this->Org_model->fetch_org_type(); //ดึงข้อมูลจาก tb_org_type ทั้งหมด
            $data['countrys'] = $this->Org_model->fetch_country();
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $data['title'] = 'Upload picture fail '.$this->lang->line('profile_title');
            $data['page'] = 'staff/organization/upload_picture';        //หน้าเพจที่จะแสดง
            $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
    }
    else
    {
            $data = array('upload_data' => $this->upload->data(),
                        'create_thumb' => $this->create_thumb());
            redirect('staff/organization/info/'.$this->input->post('org_id'));
    }
  }

  //สร้าง thumbnail image หลังจากเรียนใช้ฟังก์ชั่นนี้แล้ว ระบบจะลดขนาดไฟล์ภาพและสร้างใหม่ เป็นชื่อเดียวกับต้นฉบับแต่ตามหลังชื่อด้วย xxx_thumb.jpg
  function create_thumb(){
    $config['image_library'] = 'gd2';
    $config['source_image'] = './assets/images/orgs/tjsif2019-org-'.$this->input->post('org_id').'.jpg';
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width']         = 120;
    $config['height']       = 120;

    $this->load->library('image_lib', $config);

    $this->image_lib->resize();
  }

  //Delete Project
  function delete($org_id)
  {
    //บันทึกการดาวน์โหลด
    $this->Org_model->delete_org_row($org_id);
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
        'detail' => 'Delete organization id '.$org_id,
        'link' => 'members/organization/info/#',
        'update_time' => $this->System_model->get_date_time() //เวลา
      );
      $this->Notify_model->add_notify($notify);
    //กลับไปหน้าโปรเจค
    redirect('staff/organization/');
  }



}
