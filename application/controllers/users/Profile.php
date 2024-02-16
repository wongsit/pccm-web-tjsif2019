<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * profile by khanchai 20181221
 */
class Profile extends Users_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('Notify_model');
    $this->load->library('ciqrcode');
  }
  //หน้าแรกของ profile
  function index()
  {
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller

    $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = $this->lang->line('profile_title');
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['page'] = 'users/profile/index';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }

  function qrcode(){
    $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = 'My QR-code';
    $data['page'] = 'users/profile/myqrcode';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }
  /******************************
    Print card
  *******************************/
  public function print_card($id)
  {
    $data['title'] = 'Profile - Print member card';
    $data['page'] = 'staff/member/print_card';
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['user'] = $this->Users_model->fetch_user_data_id($id);    //ดึงข้อมูลผู้ใช้จาก username
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('staff/member/print_card',$data);   //แสดง view
  }

  //หน้าแรก edit profile
  function edit()
  {
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = 'Edit '.$this->lang->line('profile_title');
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['page'] = 'users/profile/edit';        //หน้าเพจที่จะแสดง
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
      //อีเมล์
      $this->form_validation->set_rules('e_mail', $this->lang->line('e_mail'), 'valid_email', array(
        'valid_email' => $this->lang->line('warn_email'),//ตัวอักตัวอักษรเท่านั้น
      ));
      //เช็ครหัสผ่าน
      if($this->input->post('password') == $this->input->post('c_password')){
        $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|min_length[8]|max_length[15]', array(
  					'trim' => $this->lang->line('warn_empty'), //ห้ามค่าว่าง
  					'min_length' => $this->lang->line('warn_max_length').'7', //ตัวอักษรต้ตัวอักษรต้องมากกว่า
  					'max_length' => $this->lang->line('warn_min_length').'16'  //ตัวอักษรต้องน้อยกว่า
  					));
      }else{
        $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|max_length[1]', array(
            'trim' => $this->lang->line('warn_empty'), //ห้ามค่าว่าง
            'max_length' => $this->lang->line('warn_password_valid')  //ตัวอักษรต้องน้อยกว่า
            ));
      }
      //เช็คชื่อ
      $this->form_validation->set_rules('firstname', $this->lang->line('fname'), 'required', array(
          'required' => $this->lang->line('warn_empty'),  //ห้ามค่าว่าง
        ));
      //เช็คนามสกุล
      $this->form_validation->set_rules('lastname', $this->lang->line('lname'), 'required', array(
          'required' => $this->lang->line('warn_empty'),  //ห้ามค่าว่าง
        ));

      //เช็คผลการตรวจสอบข้อมูล
      if ($this->form_validation->run() == TRUE) {    //ถ้าการตรวจสอบ rule ถูกต้อง จะได้ TRUE
        if($this->Users_model->update_profile($_POST) != null){
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
  					array(
  						'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Update data is successfully</div>',
              'reg_result' => TRUE
              )
  					);
  				//อับเดรต sesion userdata
          $result = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้
          $this->session->set_userdata(array(
            'id' => $result->id,          //id
            'gender' => $result->gender,     //เพศ
            'username' => $result->email,       //ชื่อผู้ใช้
            'firstname' => $result->firstname,        //ชื่อ
            'lastname' => $result->lastname,        //นามสกุล
            'occ_id' => $result->occ_id,       //อาชีพ
            'org_id' => $result->org_id,       //โรงเรียน
            'type' => $result->type       //ประเภทผู้ใช้
          ));
          //notify
          $notify = array(
            'user_id' => $result->id,
            'detail' => 'Update data profile',
            'link' => 'members/member/info/'.$result->id,
            'update_time' => $this->System_model->get_date_time() //เวลา
          );
          $this->Notify_model->add_notify($notify);
          redirect('users/profile/index');    //กลับไปหน้า profile
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
  						'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Update data fail ! Please check your data.</div>',
              'reg_result' => FALSE
              )
  					);
          $data['title'] = 'Update data is fail.';
          $data['email'] = $this->Users_model->fetch_email_invite($token);
          $data['token'] = $token;
          $this->load->view('users/account/register',$data);
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
        $data['title'] = 'Update data fail';
        $data['titles'] = $this->Users_model->fetch_title();
        $data['genders'] = $this->Users_model->fetch_gender();
        $data['countrys'] = $this->Users_model->fetch_country();
        $data['foods'] = $this->Users_model->fetch_foods();
        $data['types'] = $this->Users_model->fetch_people_type();
        $data['occ_types'] = $this->Users_model->fetch_occ_type();
        $data['orgs'] = $this->Users_model->fetch_org();
        $data['page'] = 'users/profile/edit';        //หน้าเพจที่จะแสดง
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
        $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
    }
    }
  }

  //หน้าแรก edit profile
  function upload_picture()
  {
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = 'Upload picture '.$this->lang->line('profile_title');
    $data['page'] = 'users/profile/upload_picture';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }

  //Upload Picture
  function do_upload()
  {
    $config['upload_path']          = './assets/images/users/';
    $config['allowed_types']        = 'jpg';
    $config['max_size']             = 1024;
    $config['max_width']            = 1024;
    $config['max_height']           = 1024;
    $config['file_name']           = 'tjsif2019-profile-'.$this->session->userdata('id');    //กำหนดชื่อไฟล์ที่ต้องการ
    $config['overwrite']           = TRUE;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('photo'))
    {
            $data['error'] =  $this->upload->display_errors();
            //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
            $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
            $data['title'] = 'Upload picture '.$this->lang->line('profile_title');
            $data['page'] = 'users/profile/upload_picture';        //หน้าเพจที่จะแสดง
            $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
            $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
            $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
    }
    else
    {
            $data = array('upload_data' => $this->upload->data(),
                          'create_thumb' => $this->create_thumb());
            redirect('users/profile/index');
    }
  }

  //สร้าง thumbnail image หลังจากเรียนใช้ฟังก์ชั่นนี้แล้ว ระบบจะลดขนาดไฟล์ภาพและสร้างใหม่ เป็นชื่อเดียวกับต้นฉบับแต่ตามหลังชื่อด้วย xxx_thumb.jpg
  function create_thumb(){
    $config['image_library'] = 'gd2';
    $config['source_image'] = './assets/images/users/tjsif2019-profile-'.$this->session->userdata('id').'.jpg';
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width']         = 120;
    $config['height']       = 120;

    $this->load->library('image_lib', $config);

    $this->image_lib->resize();
  }

  public function change_password(){
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = 'Change Password '.$this->lang->line('profile_title');
    $data['page'] = 'users/profile/change_password';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }

  public function do_change_password(){
    /*ตรวจสอบความถูกต้องของข้อมูล*/
    if($this->Users_model->login($this->session->userdata('username'),$this->input->post('o_password')) == TRUE){
      //เช็ครหัสผ่าน
      if($this->input->post('password') == $this->input->post('c_password')){
        $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|min_length[8]|max_length[15]', array(
  					'trim' => $this->lang->line('warn_empty'), //ห้ามค่าว่าง
  					'min_length' => $this->lang->line('warn_max_length').'7', //ตัวอักษรต้ตัวอักษรต้องมากกว่า
  					'max_length' => $this->lang->line('warn_min_length').'16'  //ตัวอักษรต้องน้อยกว่า
  					));
      }else{
        $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|max_length[1]', array(
            'trim' => $this->lang->line('warn_empty'), //ห้ามค่าว่าง
            'max_length' => $this->lang->line('warn_password_valid')  //ตัวอักษรต้องน้อยกว่า
            ));
      }

      //เช็คผลการตรวจสอบข้อมูล
      if ($this->form_validation->run() == TRUE) {    //ถ้าการตรวจสอบ rule ถูกต้อง จะได้ TRUE
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Your Password Change is successfully</div>',
            'reg_result' => TRUE
            )
          );
        $this->Users_model->update_password($this->session->userdata('id'),$this->input->post('password')); //เปลี่ยนรหัสผ่าน
        //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
        $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
        $data['title'] = 'Change Password '.$this->lang->line('profile_title');
        $data['page'] = 'users/profile/change_password';        //หน้าเพจที่จะแสดง
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
        $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
        $this->session->unset_userdata('username');  //ออกจากระบบ
      }else{
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>New password or Confirm Fail.</div>',
            'reg_result' => FALSE
            )
          );
        //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
        $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
        $data['title'] = 'Change Password '.$this->lang->line('profile_title');
        $data['page'] = 'users/profile/change_password';        //หน้าเพจที่จะแสดง
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
        $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
      }
    }else{
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Wrong current password ! Please check.</div>',
          'reg_result' => FALSE
          )
        );
      //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
      $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
      $data['title'] = 'Change Password '.$this->lang->line('profile_title');
      $data['page'] = 'users/profile/change_password';        //หน้าเพจที่จะแสดง
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
    }
  }

  //Field trip select
  function fieldtrip()
  {
    //-----
    if($this->Site_model->check_fieldtrip_date($this->System_model->get_date()) == 0){   //ถ้าไม่เกินกำหนด
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><h3><strong>Field trip closed for registration</strong></h3><p>Currently not enrolled in the field of enrollment. Or the system has been closed for registration</p></div>',
          'reg_result' => FALSE
          )
        );
      }

    $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));
    $data['title'] = 'Choose a field trip';
    $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
    $data['page'] = 'users/profile/fieldtrip';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }

  //Field trip select
  function chose_fieldtrip()
  {
    $fieldtrip_id = $this->input->post('fieldtrip');
    $occ_id = $this->input->post('occ_id');
    $country = $this->input->post('country');
    $user_id = $this->input->post('id');
    $update_time = $this->input->post('update_time');
    if($fieldtrip_id != 0){ //ถ้ามีข้อมูล
      if($this->Users_model->fetch_fieldtrip_chose_id($user_id) == null){   //ถ้ายังไม่เลือก
        if($this->Users_model->fieldtrip_check($fieldtrip_id,$occ_id,$country) == true){ //ถ้าทริปยังไม่เต็ม
          $this->Users_model->update_user_trip($user_id,$fieldtrip_id); //อับเดรตข้อมูลทริปใน tb_users
          $this->Users_model->add_fieldtrip($user_id,$fieldtrip_id,$occ_id,$country,$update_time); //เพิ่มข้อมูลทริป
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> You have successfully selected a field trip.</div>',
              'reg_result' => TRUE
              )
            );
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> This field trip is full Please select other excursions.</div>',
              'reg_result' => false
              )
            );
        }
      }else{
        if($this->Users_model->fieldtrip_check($fieldtrip_id,$occ_id,$country) == true){ //ถ้าทริปยังไม่เต็ม
          $this->Users_model->update_user_trip($user_id,$fieldtrip_id); //อับเดรตข้อมูลทริปใน tb_users
          //$user_trip = $this->Users_model->fetch_fieldtrip_chose_id($user_id);
          $this->Users_model->update_fieldtrip($user_id,$fieldtrip_id,$update_time); //เพิ่มข้อมูลทริป
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> You have successfully updated a field trip.</div>',
              'reg_result' => TRUE
              )
            );
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> This field trip is full Please select other excursions.</div>',
              'reg_result' => false
              )
            );
        }
      }

    }else{
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-warning alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Error, data selection failed.</div>',
          'reg_result' => FALSE
          )
        );
    }

    $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));
    $data['title'] = 'Choose a field trip';
    $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
    $data['page'] = 'users/profile/fieldtrip';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }

  //Confirm
  function confirm()
  {
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller

    $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = $this->lang->line('profile_title');
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['page'] = 'users/profile/confirm';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
  }

  //Active
  function active()
  {
    if($this->Users_model->active_profile($this->session->userdata('id')) != null){
      //แสดงผลลัพท์จากระบบ
      $this->session->set_flashdata(
        array(
          'msg_info' => '<div class="alert alert-primary alert-dismissible fade show">
          <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Result -> </strong> Confirm data profirm is successfully
          <br/><br/><a href="'. base_url() .'users/profile/qrcode" class="btn btn-lg btn-primary align-right"><i class="fas fa-qrcode"></i> Check QR-CODE</a>
          </div>',
          'reg_result' => TRUE
        )
        );

    $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = $this->lang->line('profile_title');
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['page'] = 'users/profile/confirm';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_member',$data);  //เทมเพลต
    }
  }


}//class
