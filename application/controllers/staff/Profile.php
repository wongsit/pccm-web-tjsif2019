<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * profile by khanchai 20181221
 */
class Profile extends Staff_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('Users_model');
    $this->load->model('Activity_model');
    $this->load->model('Notify_model');
    $this->load->model('Project_model');
      $this->load->model('Member_model');
  }
  //หน้าแรกของ profile
  function index($id)
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
    $data['page'] = 'staff/profile/index';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
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
  function edit($id)
  {
    //เช็คการอนุญาต (premission) ของ user อัตโนมัติจาก Users_Controller
    $data['user'] = $this->Users_model->fetch_user_data_id($id);    //ดึงข้อมูลผู้ใช้จาก username
    $data['title'] = 'Edit '.$this->lang->line('profile_title');
    $data['titles'] = $this->Users_model->fetch_title();
    $data['genders'] = $this->Users_model->fetch_gender();
    $data['countrys'] = $this->Users_model->fetch_country();
    $data['foods'] = $this->Users_model->fetch_foods();
    $data['types'] = $this->Users_model->fetch_people_type();
    $data['occ_types'] = $this->Users_model->fetch_occ_type();
    $data['orgs'] = $this->Users_model->fetch_org();
    $data['page'] = 'staff/profile/edit';        //หน้าเพจที่จะแสดง
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
          $result = $this->Users_model->fetch_user_data($this->input->post('email'));    //ดึงข้อมูลผู้ใช้

          //notify
          $notify = array(
            'user_id' => $result->id,
            'detail' => 'Update data profile by Staff('.$this->session->userdata('firstname').')',
            'link' => 'members/member/info/'.$result->id,
            'update_time' => $this->System_model->get_date_time() //เวลา
          );
          $this->Notify_model->add_notify($notify);
          redirect('staff/profile/index/'.$result->id);    //กลับไปหน้า profile
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
          redirect('staff/profile/index/'.$this->input->post('id'));    //กลับไปหน้า profile
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
        $data['page'] = 'staff/profile/edit/'.$this->input->post('id');        //หน้าเพจที่จะแสดง
        $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
        $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
        $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
    }
    }
  }

  //Delete member
  function delete($member_id)
  {
    //บันทึกการดาวน์โหลด
    $this->Activity_model->delete_activity_row($member_id);
    $this->Users_model->delete_fieldtrip_row($member_id);
    $this->Notify_model->delete_notify_row($member_id);
    $this->Users_model->delete_member_row($member_id);
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
      'detail' => 'Delete member id '.$member_id,
      'link' => 'members/member/',
      'update_time' => $this->System_model->get_date_time() //เวลา
    );
    $this->Notify_model->add_notify($notify);
    //กลับไปหน้าโปรเจค
    redirect('staff/member/');
  }

  //Field trip select
  function fieldtrip($member_id)
  {
    $data['user'] = $this->Users_model->fetch_user_data_id($member_id);
    $data['title'] = 'Choose a field trip by Staff';
    $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
    $data['page'] = 'staff/profile/fieldtrip';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
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

    $data['user'] = $this->Users_model->fetch_user_data_id($user_id);
    $data['title'] = 'Choose a field trip by Staff';
    $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip();
    $data['page'] = 'staff/profile/fieldtrip';        //หน้าเพจที่จะแสดง
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);  //เทมเพลต
  }

  public function import_fieldtrip()
  {
    $data['title'] = 'Import Field trip group';
    $data['page'] = 'staff/profile/import_fieldtrip';
    $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip_sub_group();
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  public function fieldtrip_search()
  {
    if($this->input->post('key') != ''){
		    $data['fieldtrips']= $this->Users_model->search_fieldtrip_sub_group($this->input->post('key'));
	   }else{
       $data['fieldtrips'] = $this->Users_model->fetch_fieldtrip_sub_group();
     }
    $data['title'] = 'Import Field trip group';
    $data['page'] = 'staff/profile/import_fieldtrip';
    $data['date_time_stamp'] = $this->System_model->get_date_time(); //เวลา
    $data['my_ip'] = $this->System_model->get_client_ip(); //ไอพี
    $this->load->view('templates/tjsif_staff',$data);   //แสดง view
  }

  /********************************
    Import Excel
  *********************************/
  function import_file_fieldtrip()
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
  					$member_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
  					$sub_group = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
  					$data = array(
  						'member_id'		=>	$member_id,
              'sub_group'		=>	$sub_group
  					);
            if($this->Users_model->count_fieldtrip_sub_group_id($member_id) > 0){
              $this->Users_model->update_fieldtrip_sub_group($data);    //อับเดรต
              $count_update_data++;
            }else{
              $this->Users_model->add_fieldtrip_sub_group($data);      //เพิ่ม
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
      redirect('staff/profile/import_fieldtrip');
    }//if m1

  }


}
