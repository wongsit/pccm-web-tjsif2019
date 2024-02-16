<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  account by khanchai 20181221
 */
class Account extends CI_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('Users_model');
    $this->load->model('Site_model');
    $this->load->model('Notify_model');
    $this->load->library('email');
  }

  public function index()
  {
    //เช็คการอนุญาต (premission) ของ user
    if($this->session->userdata('username') == null){
      redirect('users/account/login');
    }else{
      $data['user'] = $this->Users_model->fetch_user_data($this->session->userdata('username'));    //ดึงข้อมูลผู้ใช้จาก username
      $data['introduce_member'] = $this->Users_model->introduce_member();   //แนะนำสมาชิก
      $data['introduce_org'] = $this->Users_model->introduce_org();   //แนะนำสมาชิก
      $data['introduce_project'] = $this->Users_model->introduce_project();   //แนะนำสมาชิก
      $data['notifys'] = $this->Notify_model->fetch_notify();  //notify
      $data['title'] = $this->lang->line('site_name');
      $data['page'] = 'users/account/index';
      $this->load->view('templates/tjsif_member',$data);
    }
  }

  public function login()
  {
    if($this->input->server('REQUEST_METHOD')==TRUE){
      //ลงชื่อเข้าใช้งาน
        if($this->Users_model->login($this->input->post('username'), $this->input->post('password')) == TRUE)   //เช็คชื่อผู้ใช้-รหัสผ่านกับฐานข้อมุูล
        {
          $result = $this->Users_model->fetch_user_data($this->input->post('username'));    //ดึงข้อมูลผู้ใช้
          $this->session->set_userdata(array(
            'id' => $result->id,          //id
            'gender' => $result->gender,     //เพศ
            'title' => $result->title,     //เพศ
            'username' => $result->email,       //ชื่อผู้ใช้
            'firstname' => $result->firstname,        //ชื่อ
            'lastname' => $result->lastname,        //นามสกุล
            'occ_id' => $result->occ_id,       //อาชีพ
            'org_id' => $result->org_id,       //โรงเรียน
            'trip' => $result->trip,       //โรงเรียน
            'type' => $result->type       //ประเภทผู้ใช้
          ));

          if($this->session->userdata('url_req') != null){
            $url_req = $this->session->userdata('url_req');
            $this->session->unset_userdata('url_req');
            redirect($url_req);
          }else{
            redirect('users/account/index');
          }

          //redirect($_SESSION['url']);

        }else{
          if($this->input->post('username') != ''){
            $data['error'] = $this->lang->line('login_warn');
            $data['title'] = $this->lang->line('login');
            $this->load->view('users/account/login',$data);
          }else{
            $data['error'] = "";
            $data['title'] = $this->lang->line('login');
            $this->load->view('users/account/login',$data);
          }
        }
    }
  }

  public function Register($token)
  {
      //ลงทะเบียน users
      $email = $this->Users_model->fetch_email_invite($token);
      //เช็คกับกำหนดการลงทะเบียน
      /*
      if($this->Site_model->check_register_date($this->System_model->get_date()) == 0){   //ถ้าเกินกำหนด หรือไม่เปิดลงทะเบียน
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Registeration closed</strong><p>You are not currently in the registration schedule or the system is not yet registered.</p></div>',
            'reg_result' => FALSE
            )
          );
          $data['title'] = 'Register';
          $data['my_ip'] = $this->System_model->get_client_ip();
          $this->load->view('users/account/close_register',$data);
      }else{  */
      //สามารถลงทะเบียนได้
      if(($email != null) && ($this->Users_model->record_count_user($email) == 0)){
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-info alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Welcome to TJ-SIF2019 website for Register.</div>',
            'reg_result' => FALSE
            )
          );
        $data['title'] = 'Register';
        $data['token'] = $token;
        $data['email'] = $email;
        $data['titles'] = $this->Users_model->fetch_title();
        $data['genders'] = $this->Users_model->fetch_gender();
        $data['countrys'] = $this->Users_model->fetch_country();
        $data['foods'] = $this->Users_model->fetch_foods();
        $data['types'] = $this->Users_model->fetch_people_type();
        $data['occ_types'] = $this->Users_model->fetch_occ_type();
        $data['orgs'] = $this->Users_model->fetch_org();
        $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $data['my_ip'] = $this->System_model->get_client_ip();
        $this->load->view('users/account/register',$data);
      }else{
        redirect('users/account/login');
      }
    //}
  }

  public function add_user($token){
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
        if($this->Users_model->record_count_user($this->input->post('email')) == 0){
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
  					array(
  						'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong> Register is successfully</div>',
              'reg_result' => TRUE
              )
  					);

  				$this->Users_model->add_user($_POST); //เพิ่มข้อมูล user
          $this->Users_model->update_used_invite($this->input->post('email'),$token); //อับเดรตข้อมูล used tb_invite
          $data['title'] = 'Register is successfully';
          $data['token'] = $token;
          $this->load->view('users/account/register',$data);
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
  						'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Register fail ! Please check your data.</div>',
              'reg_result' => FALSE
              )
  					);
          $data['title'] = 'Register is fail.';
          $data['email'] = $this->Users_model->fetch_email_invite($token);
          $data['token'] = $token;
          $data['titles'] = $this->Users_model->fetch_title();
          $data['genders'] = $this->Users_model->fetch_gender();
          $data['countrys'] = $this->Users_model->fetch_country();
          $data['foods'] = $this->Users_model->fetch_foods();
          $data['types'] = $this->Users_model->fetch_people_type();
          $data['occ_types'] = $this->Users_model->fetch_occ_type();
          $data['orgs'] = $this->Users_model->fetch_org();
          $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
          $this->load->view('users/account/register',$data);
        }
			} else {     //ถ้าการตรวจสอบ rule ไม่ถูกต้อง
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
					array(
						'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Register fail ! Please check your data.</div>',
            'reg_result' => FALSE
            )
					);

      //  $this->form_validation->set_message('rule', 'Error Message');*/

        $data['title'] = 'Register fail';
        $data['token'] = $token;
        $data['email'] = $this->Users_model->fetch_email_invite($token);
        $data['titles'] = $this->Users_model->fetch_title();
        $data['genders'] = $this->Users_model->fetch_gender();
        $data['countrys'] = $this->Users_model->fetch_country();
        $data['foods'] = $this->Users_model->fetch_foods();
        $data['types'] = $this->Users_model->fetch_people_type();
        $data['occ_types'] = $this->Users_model->fetch_occ_type();
        $data['orgs'] = $this->Users_model->fetch_org();
        $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $data['my_ip'] = $this->System_model->get_client_ip();
        $this->load->view('users/account/register',$data);
    }
    }
  }

  public function forgot()
  {
    $data['error'] = 'none';
    $data['title'] = 'Forgot Password';
    $this->load->view('users/account/forgot_pass',$data);   //แสดง view
  }

  public function send_email_forgot()
  {
    //การตั่งค่า congig สำหรับการส่ง email ให้แก้ไขค่าใน application/config
    //กำหนด email address ผู้รับ
    //เช็ค REQUEST_METHOD
    if ($this->input->server('REQUEST_METHOD') == TRUE) {
      //อีเมล์
      $this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email', array(
        'valid_email' => $this->lang->line('warn_email'), //ตัวอักตัวอักษรเท่านั้น
      ));

      //เช็คผลการตรวจสอบข้อมูล
      if (($this->form_validation->run() == TRUE) && ($this->Users_model->record_count_user($this->input->post('email')) == 1)) {    //ถ้าการตรวจสอบ rule ถูกต้อง จะได้ TRUE และมี email ใน tb_users
          $to_addr = $this->input->post('email');
          $this->email->from('noreply@pccm.ac.th', 'tjsif2019');
          $this->email->to($to_addr);
        //  $this->email->cc('another@another-example.com');  //สำเนา...ถ้าต้องการ
        //  $this->email->bcc('them@their-example.com');
          $data['form']='';
          $body = $this->load->view('member/emails/forgot_template.php',$data,TRUE);        //โหลด Template email
          //กำหนด Token
          $invite_token = "";
          $invite_token = $this->Users_model->create_forgot_token($to_addr);
          $message = str_replace("%%token%%", $invite_token, $body);

          $this->email->subject('Forgot Password - TJ-SIF2019 Official Website');  //หัวข้อ
          $this->email->message($message);  //กำหนดเนื้อหาในจดหมาย

          //Send mail
           if($this->email->send()){
             //แสดงผลลัพท์จากระบบ
             $this->session->set_flashdata(
     					array(
     						'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Resetting Result -> </strong>Email sent to '.$to_addr.' is successfully.<br>Please check inbox of your email.</div>',
                 'reg_result' => TRUE
                 )
     					);
              $data['error'] = '';
           }else{
             //แสดงผลลัพท์จากระบบ
            $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Resetting Result -> </strong>Error in sending Email..</div>',
               'reg_result' => TRUE
               )
            );
            $data['error'] = 'none';
           }
           $data['title'] = 'Forgot Password';
           $this->load->view('users/account/forgot_pass',$data);   //แสดง view
      } else {
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Resetting Result -> Email  '.$to_addr.' is not available in this site.</strong></div>',
            'reg_result' => FALSE
            )
          );
          $data['error'] = 'none';
          $data['title'] = 'Forgot Password';
          $this->load->view('users/account/forgot_pass',$data);   //แสดง view
      }
    }
  }

  public function new_password($token)
  {
      //ลงทะเบียน users
      $email = $this->Users_model->fetch_email_forgot($token);
      if(($email != null) && ($this->Users_model->record_count_user($email) == 1)){   //ตรวจสอบ token และ email
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-info alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Note -> </strong>Please press new password.</div>',
            'reg_result' => FALSE
            )
          );
        $data['title'] = 'New Password';
        $data['email'] = $email;
        $data['token'] = $token;
        $data['my_ip'] = $this->System_model->get_client_ip();
        $this->load->view('users/account/new_password',$data);  //เทมเพลต
      }else{
        redirect('users/account/login');  //login
      }
  }

  public function do_change_password(){
      //เช็ครหัสผ่าน
      if($this->input->post('password') == $this->input->post('c_password')){   //ถ้ารหัสผ่านตรงกัน ทั้ง 2 ช่อง
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
            'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Result -> </strong> Your Password Change is successfully</div>',
            'reg_result' => TRUE
            )
          );
        $this->Users_model->update_email_password($this->input->post('email'),$this->input->post('password'),$this->input->post('update_ip')); //เปลี่ยนรหัสผ่าน
        $this->Users_model->update_used_forgot($this->input->post('email'),$this->input->post('token')); //อับเดรตข้อมูล used tb_invite
        redirect('users/account/login');  //login
      }else{
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Result -> </strong>New password or Confirm Fail.</div>',
            'reg_result' => FALSE
            )
          );
        //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
        $data['title'] = 'New Password';
        $data['email'] = $this->input->post('email');
        $data['token'] = $this->input->post('token');
        $data['my_ip'] = $this->System_model->get_client_ip();
        $this->load->view('users/account/new_password',$data);  //เทมเพลต
      }
  }

  public function logout()
  {
    $this->session->unset_userdata('username');
    return redirect('welcome');
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
