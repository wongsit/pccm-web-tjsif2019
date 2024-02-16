<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Staff_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('Project_model');
    $this->load->model('Org_model');
    $this->load->model('Occ_model');
    $this->load->model('Users_model');
    $this->load->model('Member_model');
    $this->load->model('Member_model');
    $this->load->library('email');
  }

  public function index()
  {
    $data['title'] = 'Member list';
    $data['page'] = 'staff/member/index';
    $data['users'] = $this->Users_model->fetch_users();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
    $data['orgs'] = $this->Org_model->fetch_org();  // //ดึงข้อมูลจาก tb_org ทั้งหมด
    $data['occs'] = $this->Users_model->fetch_occ_type();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['date_time_stamp'] = $this->System_model->get_date_time();    //เวลา
    $this->load->view('templates/tjsif_staff',$data);    //แสดง view
  }

  //หน้าแรกของ profile
  function info($id)
  {
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['user'] = $this->Users_model->fetch_user_data_id($id);    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = $this->lang->line('profile_title');
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['page'] = 'staff/member/info';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);    //แสดง view
  }

  /******************************
    Print card
  *******************************/
  public function print_card_org($org_id)
  {
    $data['title'] = 'Member - Print member card';
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['users'] = $this->Users_model->fetch_users_participant_org_id($org_id);    //ดึงข้อมูลผู้ใช้จาก username
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('staff/member/print_card_org',$data);   //แสดง view
    //$this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /******************************
    Print card
  *******************************/
  public function print_card_all()
  {
    $data['title'] = 'Member - Print member card';
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['users'] = $this->Users_model->fetch_users_participant();    //ดึงข้อมูลผู้ใช้จาก username
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $this->load->view('staff/member/print_card_org',$data);   //แสดง view
    //$this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function Register()
  {
        $data['title'] = 'Register Member';
        $data['page'] = 'staff/member/register';
        $data['email'] = '';
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
        $this->load->view('templates/tjsif_staff',$data);    //แสดง view
  }

  public function add_member(){
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
          $data['title'] = 'Register is successfully';
          $data['page'] = 'staff/member/register';
          $this->load->view('templates/tjsif_staff',$data);    //แสดง view
        }else{
          //แสดงผลลัพท์จากระบบ
          $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Register fail ! This email already exists.</div>',
              'reg_result' => FALSE
              )
            );
            $data['title'] = 'Register Member';
            $data['page'] = 'staff/member/register';
            $data['email'] = '';
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
            $this->load->view('templates/tjsif_staff',$data);    //แสดง view
        }
      } else {     //ถ้าการตรวจสอบ rule ไม่ถูกต้อง
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Infomation Result -> </strong>Register fail ! Please check your data.</div>',
            'reg_result' => FALSE
            )
          );
      $data['title'] = 'Register Member';
      $data['page'] = 'staff/member/register';
      $data['email'] = '';
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
      $this->load->view('templates/tjsif_staff',$data);    //แสดง view
    }
    }
  }

  public function invite()
  {
      $data['title'] = 'Invite by Staff';
      $data['page'] = 'staff/member/invite';
      $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function send_email()
  {
    //การตั่งค่า congig สำหรับการส่ง email ให้แก้ไขค่าใน application/config
    //กำหนด email address ผู้รับ
    //เช็ค REQUEST_METHOD
    if ($this->input->server('REQUEST_METHOD') == TRUE) {
      $to_addr = $this->input->post('email');
      //อีเมล์
      $this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email', array(
        'valid_email' => $this->lang->line('warn_email'), //ตัวอักตัวอักษรเท่านั้น
      ));

      //เช็คผลการตรวจสอบข้อมูล
      if (($this->form_validation->run() == TRUE) && ($this->Users_model->record_count_user($this->input->post('email')) == 0)) {    //ถ้าการตรวจสอบ rule ถูกต้อง จะได้ TRUE และ email ยังไม่ถูกใช้ใน tb_users
          $to_addr = $this->input->post('email');
          $this->email->from('noreply@pccm.ac.th', 'tjsif2019');
          $this->email->to($to_addr);
        //  $this->email->cc('another@another-example.com');  //สำเนา...ถ้าต้องการ
        //  $this->email->bcc('them@their-example.com');

          //กำหนดตัวแปรชื่อผู้ส่ง และเนื้อหาในจดหมาย
          $invite_form = '';
          switch($this->session->userdata('title')) {      //เพศ
              case 1: $invite_form .= 'Mr.'; break;
              case 2: $invite_form .= 'Ms.'; break;
              case 3: $invite_form .= 'Mrs.'; break;
              case 4: $invite_form .= 'Miss.'; break;
              case 5: $invite_form .= 'Dr.'; break;
          }
          $invite_form .= $this->session->userdata('firstname').' '.$this->session->userdata('lastname').' (Operation Staff of TJ-SIF 2019)';   //ชื่่อผู้ส่ง
          $data['invite_form'] = $invite_form;
          $body = $this->load->view('member/emails/invite_template.php',$data,TRUE);        //โหลด Template email
          $message = str_replace("%%from%%", $invite_form, $body);      //ใส่ชื่อผู้ส่งลงในไฟล์ template

          //กำหนด Token
          $invite_token = "";
          $invite_token = $this->Member_model->create_token($this->session->userdata('id'), $to_addr);
          $message = str_replace("%%token%%", $invite_token, $message);

          $this->email->subject('The invitation to TJ-SIF2019 Official Website');  //หัวข้อ
          $this->email->message($message);  //กำหนดเนื้อหาในจดหมาย

          //Send mail
           if($this->email->send()){
             //แสดงผลลัพท์จากระบบ
             $this->session->set_flashdata(
     					array(
     						'msg_info' => '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Invite Result -> </strong>Email  sent to '.$to_addr.' is successfully.</div>',
                 'reg_result' => TRUE
                 )
     					);
           }else{
             //แสดงผลลัพท์จากระบบ
            $this->session->set_flashdata(
            array(
              'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Invite Result -> </strong>Error in sending Email..</div>',
               'reg_result' => TRUE
               )
            );
           }
           $data['title'] = 'Invite by Staff';
           $data['page'] = 'staff/member/invite';
           $this->load->view('templates/tjsif_staff',$data);   //แสดง view
      } else {
        //แสดงผลลัพท์จากระบบ
        $this->session->set_flashdata(
          array(
            'msg_info' => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Invite Result -> Email  '.$to_addr.' is already exists.</strong></div>',
            'reg_result' => FALSE
            )
          );

          $data['title'] = 'Invite by Staff';
          $data['page'] = 'staff/member/invite';
          $this->load->view('templates/tjsif_staff',$data);   //แสดง view
      }
    }
  }

    /******************************
      Import Hostel
    *******************************/
    public function import_hostel()
    {
      $data['title'] = 'Import Hostel data';
      $data['page'] = 'staff/member/import_hostel';
      $data['members'] = $this->Member_model->fetch_hostel();
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }

    public function hostel_search()
    {
      if($this->input->post('key') != ''){
          $data['members'] = $this->Member_model->search_hostel($this->input->post('key'));
  	   }else{
         $data['members'] = $this->Member_model->fetch_hostel();
       }
      $data['title'] = 'Import Presentation room';
      $data['page'] = 'staff/member/import_hostel';
      $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
      $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
      $this->load->view('templates/tjsif_staff',$data);   //แสดง view
    }

    /********************************
      Import Excel
    *********************************/
    function import_hostel_file()
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
    					$hostel_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
    					$room = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
    					$user_id = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

    					$data = array(
    						'user_id'		=>	$user_id,
                'hostel_name'		=>	$hostel_name,
    						'room'			=>	$room
    					);
              if($this->Member_model->count_hostel_id($user_id) > 0){
                $this->Member_model->update_hostel($data);    //อับเดรต
                $count_update_data++;
              }else{
                $this->Member_model->add_hostel($data);      //เพิ่ม
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
        redirect('staff/member/import_hostel');
      }//if m1

    }

} //class
