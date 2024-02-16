<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');

 /**
  * profile model by khanchai 2018122101
  */
 class Users_model extends CI_Model
 {
   public function __construct(){
     parent::__construct();

   }
   //====== TB_USERS=========
   //Login check
   public function login($username,$password){
     return $this->has_pass_ckeck($username,$password);    //true | false
   }

   //ดึงข้อมูลทผู้ใช้ทั้งหมด
   public function fetch_users()
   {
     return $this->db->get('tb_users')->result();
   }

   //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
   public function fetch_users_participant()
   {
     /*$this->db->where('type',1);    // participant
     $this->db->or_where('type',2);    // contact person
     $this->db->or_where('type',4);    // Operation Staff
     $this->db->or_where('type',5);    // Observer
     $this->db->or_where('type',50);    // Hackathon */

     $this->db->where('type != ',3);  // contactperson(not attendance)
     $this->db->where('type != ',29); //participant(not attendance)
     $this->db->where('type != ',51); //Hackathon (Not Attendee)
     return $this->db->get('tb_users')->result();
   }

   //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน ยกเว้น not attendee และ observer
   public function fetch_users_participant_not_observer()
   {
     $this->db->where('type != ',3);  // contactperson(not attendance)
      $this->db->where('type != ',5);  // contactperson(not attendance)
     $this->db->where('type != ',29); //participant(not attendance)
     $this->db->where('type != ',51); //Hackathon (Not Attendee)
     return $this->db->get('tb_users')->result();
   }

   //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
   public function fetch_users_students()
   {
     $this->db->where('occ_id',1);    // student
     $this->db->where('type != ',3);  // contactperson(not attendance)
     $this->db->where('type != ',29); //participant(not attendance)
     $this->db->where('type != ',51); //Hackathon (Not Attendee)
     return $this->db->get('tb_users')->result();
   }

   //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน
   public function fetch_users_not_students()
   {
     $this->db->where('occ_id >',1);    // not student
     $this->db->where('type != ',3);  // contactperson(not attendance)
     $this->db->where('type != ',29); //participant(not attendance)
     $this->db->where('type != ',51); //Hackathon (Not Attendee)
     return $this->db->get('tb_users')->result();
   }

   //ดึงข้อมูลทผู้ใช้ที่เข้าร่วมงาน hackathon
   public function fetch_users_hackathon()
   {
     $this->db->or_where('type',50);    // Hackathon
     return $this->db->get('tb_users')->result();
   }

   //ดึงข้อมูลทผู้ใช้ทั้งหมด
   public function fetch_users_filter($data = array())
   {
     if($data['title'] != ''){
       $this->db->where('title',$data['title']);    // title
     }
     if ($data['gender'] != '') {
       $this->db->where('gender',$data['gender']);    // title
     }
     if ($data['country'] != '') {
        $this->db->where('country',$data['country']);    // title
      }
    if ($data['food'] != '') {
        $this->db->where('food',$data['food']);    // title
      }
    if ($data['type'] != '') {
        $this->db->where('type',$data['type']);    // title
      }
    if ($data['occ_id'] != '') {
        $this->db->where('occ_id',$data['occ_id']);    // title
      }
    if ($data['org_id'] != '') {
        $this->db->where('org_id',$data['org_id']);    // title
      }
    if ($data['fieldtrip'] != '') {
        $this->db->where('trip',$data['fieldtrip']);    // title
      }
    if ($data['active'] != '') {
        $this->db->where('active',$data['active']);    // title
      }

     return $this->db->get('tb_users')->result();
   }

   //นับจำนวนผู้ลงทำเบียนนับตาม org_id และ occ_id
   public function users_count_occ_org_id($occ_id,$org_id)
	{
		$this->db->where('occ_id',$occ_id);
		$this->db->where('org_id',$org_id);
		return $this->db->count_all_results('tb_users');
	}

  //นับจำนวนผู้ลงทำเบียนนับตาม org_id และ occ_id_participant
  public function users_count_occ_org_id_participant($occ_id,$org_id)
 {
   $this->db->where('occ_id',$occ_id);
   $this->db->where('org_id',$org_id);
   $this->db->where('type != ',3);  // contactperson(not attendance)
   $this->db->where('type != ',5);  //observer
   $this->db->where('type != ',29); //participant(not attendance)
   $this->db->where('type != ',51); //Hackathon (Not Attendee)
   return $this->db->count_all_results('tb_users');
 }

 //นับจำนวนผู้ลงทำเบียนนับตาม org_id และ occ_id_participant Male
 public function users_count_occ_male_org_id_participant($occ_id,$org_id)
{
  $this->db->where('gender',2);   //2=Male
  $this->db->where('occ_id',$occ_id);
  $this->db->where('org_id',$org_id);
  $this->db->where('type != ',3);  // contactperson(not attendance)
  $this->db->where('type != ',5);  //observer
  $this->db->where('type != ',29); //participant(not attendance)
  $this->db->where('type != ',51); //Hackathon (Not Attendee)
  return $this->db->count_all_results('tb_users');
}

//นับจำนวนผู้ลงทำเบียนนับตาม org_id และ occ_id_participant FeMale
public function users_count_occ_female_org_id_participant($occ_id,$org_id)
{
 $this->db->where('gender',3);   //3=feMale
 $this->db->where('occ_id',$occ_id);
 $this->db->where('org_id',$org_id);
 $this->db->where('type != ',3);  // contactperson(not attendance)
 $this->db->where('type != ',5);  //observer
 $this->db->where('type != ',29); //participant(not attendance)
 $this->db->where('type != ',51); //Hackathon (Not Attendee)
 return $this->db->count_all_results('tb_users');
}

 //นับจำนวนผู้ลงทำเบียนนับตาม org_id และ occ_id_participant และ observer
 public function users_count_occ_org_id_participant_observer($occ_id,$org_id)
{
  $this->db->where('occ_id',$occ_id);
  $this->db->where('org_id',$org_id);
  $this->db->where('type != ',3);  // contactperson(not attendance)
  $this->db->where('type != ',29); //participant(not attendance)
  $this->db->where('type != ',51); //Hackathon (Not Attendee)
  return $this->db->count_all_results('tb_users');
}

//นับจำนวนผู้ลงทำเบียนนับตาม org_id และ occ_id_participant Male
public function users_count_occ_male_org_id_participant_observer($occ_id,$org_id)
{
 $this->db->where('gender',2);   //2=Male
 $this->db->where('occ_id',$occ_id);
 $this->db->where('org_id',$org_id);
 $this->db->where('type != ',3);  // contactperson(not attendance)
 $this->db->where('type != ',29); //participant(not attendance)
 $this->db->where('type != ',51); //Hackathon (Not Attendee)
 return $this->db->count_all_results('tb_users');
}

//นับจำนวนผู้ลงทำเบียนนับตาม org_id และ occ_id_participant FeMale
public function users_count_occ_female_org_id_participant_observer($occ_id,$org_id)
{
$this->db->where('gender',3);   //3=feMale
$this->db->where('occ_id',$occ_id);
$this->db->where('org_id',$org_id);
$this->db->where('type != ',3);  // contactperson(not attendance)
$this->db->where('type != ',29); //participant(not attendance)
$this->db->where('type != ',51); //Hackathon (Not Attendee)
return $this->db->count_all_results('tb_users');
}

  //นับจำนวนผู้ลงทะเบียนนับตาม org_id
  public function users_count_org_id($org_id)
 {
   $this->db->where('org_id',$org_id);
   return $this->db->count_all_results('tb_users');
 }

 //นับจำนวนผู้ลงทะเบียนนับตาม org_id
 public function users_count_org_id_participant($org_id)
{
  $this->db->where('org_id',$org_id);
  $this->db->where('type != ',3);  // contactperson(not attendance)
  $this->db->where('type != ',5);  //observer
  $this->db->where('type != ',29); //participant(not attendance)
  $this->db->where('type != ',51); //Hackathon (Not Attendee)
  return $this->db->count_all_results('tb_users');
}

//นับจำนวนผู้ลงทะเบียนนับตาม org_id
public function users_count_org_id_participant_observer($org_id)
{
 $this->db->where('org_id',$org_id);
 $this->db->where('type != ',3);  // contactperson(not attendance)
 $this->db->where('type != ',29); //participant(not attendance)
 $this->db->where('type != ',51); //Hackathon (Not Attendee)
 return $this->db->count_all_results('tb_users');
}

 //นับจำนวนผู้ลงทะเบียน
 public function users_count()
{
  return $this->db->count_all_results('tb_users');
}

 //นับจำนวนผู้ลงทะเบียนนับตาม org_id
 public function users_count_trip($trip_id)
{
  $this->db->where('trip',$trip_id);
  return $this->db->count_all_results('tb_users');
}

 //ดึงข้อมูลผู้ใช้
 public function fetch_user($username,$password)
 {
   $this->db->where('email',$username);
   $query = $this->db->get('tb_users');
   return $query->row();
 }

 //user check
 public function record_count_user($email){
   $this->db->where('email',$email);
   return $this->db->count_all_results('tb_users');
 }

 //ดึงข้อมูลผู้ใช้ขณะ จาก username
 public function fetch_user_data($email)
 {
  $this->db->where('email',$email);
   $query = $this->db->get('tb_users');
   return $query->row();
 }

 //ดึงข้อมูลผู้ใช้ขณะ tb_users จาก id
 public function fetch_user_data_id($id)
 {
  $this->db->where('id',$id);
   $query = $this->db->get('tb_users');
   return $query->row();
 }

 //ดึงชื่อ้ใช้ขณะ tb_users จาก id
 public function fetch_user_name($id)
 {
  $this->db->where('id',$id);
   $query = $this->db->get('tb_users');
   return $query->row('firstname');
 }

 //ดึงชื่อ้ใช้ขณะ tb_users จาก firstname
 public function fetch_user_like_name($firstname,$lastname)
 {
   $this->db->like('firstname', $firstname);
   $this->db->or_like('lastname', $lastname);
   return $this->db->get('tb_users')->result();
 }

 //ดึงชื่อ้ใช้ขณะ tb_users จาก id
 public function fetch_user_email($id)
 {
  $this->db->where('id',$id);
   $query = $this->db->get('tb_users');
   return $query->row('email');
 }

 //ดึงข้อมูลผู้ใช้ขณะ tb_users จาก org_id
 public function fetch_users_org_id($org_id)
 {
  $this->db->where('org_id',$org_id);
   $query = $this->db->get('tb_users');
   return $query->result();
 }

 //ดึงข้อมูลผู้ใช้ขณะ tb_users จาก org_id เฉพาะเข้าร่วมงาน
 public function fetch_users_participant_org_id($org_id)
 {
   $this->db->where('org_id',$org_id);
   $this->db->where('type !=',3);    // participant
   $this->db->where('type !=',5);    // contact person
   $this->db->where('type !=',29);    // Operation Staff
   $query = $this->db->get('tb_users');
   return $query->result();
 }

 //เพิ่ม user
 public function add_user($post = array())
 {
  $password = $this->has_pass($post['password']);
  $user = array(
    'id' => '',
    'email' => $post['email'],
    'password' => $password,
    'title' => $post['title'],
    'firstname' => $post['firstname'],
    'middlename' => $post['middlename'],
    'lastname' => $post['lastname'],
    'nickname' => $post['nickname'],
    'gender' => $post['gender'],
    'tel' => $post['tel'],
    'address1' => $post['address1'],
    'address2' => $post['address2'],
    'city' => $post['city'],
    'province' => $post['province'],
    'country' => $post['country'],
    'zip' => $post['zip'],
    'chronic' => $post['chronic'],
    'allergies' => $post['allergies'],
    'food' => $post['food'],
    'food_other' => $post['food_other'],
    'type' => $post['type'],
    'occ_id' => $post['occ_id'],
    'org_id' => $post['org_id'],
    //'trip' => $post['trip'],    //ตัดออกเนื่องจากมีปัญหา สถานที่ field ยังไม่แน่นอน  20190419
    'position' => $post['position'],
    'update_ip' => $post['update_ip'],
    'update_time' => $post['update_time']
  );
  return $this->db->insert('tb_users', $user);    //insert data to tb_invite
 }

 //อับเดรตข้อมูล tb_users
 public function update_profile($user = array())
 {
   $this->db->where('id',$user['id']);

   return $this->db->update('tb_users',$user);
 }

 //อับเดรตข้อมูล Active
 public function active_profile($user_id)
 {
   $data  = array(
     'active' => 1
   );
   $this->db->where('id',$user_id);
   return $this->db->update('tb_users',$data);
 }

 //ดึงค่า password จาก username
 public function fetch_active($user_id)
 {
  $this->db->where('id',$user_id);
   $query = $this->db->get('tb_users');
   return $query->row('active');    //return password value 60 digit
 }

 //ดึงค่า password จาก username
 public function fetch_password($username)
 {
  $this->db->select('password');
  $this->db->where('email',$username);
   $query = $this->db->get('tb_users');
   return $query->row('password');    //return password value 60 digit
 }

 //อับเดรต password ด้วย id
 public function update_password($id,$password)
 {
   $data = array(
     'password' => $this->has_pass($password)
   );
   $this->db->where('id', $id);
   $this->db->update('tb_users', $data);
 }

 //อับเดรต password ด้วย email
 public function update_email_password($email,$password,$ip)
 {
   $data = array(
     'password' => $this->has_pass($password),
     'update_ip' => $ip
   );
   $this->db->where('email', $email);
   $this->db->update('tb_users', $data);
 }

 //======= Crypt  has ===========

 //เข้ารหัสให้กับ $Password แบบ has ขนาด default 60 บิต
 public function has_pass($password){
    return password_hash($password, PASSWORD_DEFAULT);
 }

 //check รหัสให้กับ $Password แบบ has ขนาด default 60 บิต
 public function has_pass_ckeck($username,$password){
    return password_verify($password, $this->fetch_password($username));   //true | false
 }

 //ลบข้อมูล member
 public function delete_member_row($id)
 {
   $this->db->where('id', $id);
   $this->db->delete('tb_users');
 }

 //========= tb_invite =============
 //ดึงค่า email จาก tb_invit
 public function fetch_email_invite($token)
 {
  $this->db->select('email');
  $this->db->where('token',$token);
  $this->db->where('used','0');
   $query = $this->db->get('tb_invite');
   return $query->row('email');    //return password value 60 digit
 }

 //อับเดรต tb_invite
 public function update_used_invite($email,$token)
 {
   $data = array(
           'used' => '1'
   );
   $this->db->where('email', $email);
   $this->db->where('token', $token);
   $this->db->update('tb_invite', $data);
 }

 //=== tb_ of all type ======
 //ดึงข้อมูล  tb_title ทั้งหมด
 public function fetch_title()
 {
   return $this->db->get('tb_title')->result();
 }

 //ดึงข้อมูล  tb_title name
 public function fetch_title_name($id)
 {
   $this->db->where('id',$id);
    $query = $this->db->get('tb_title');
    return $query->row('name');
 }

 //ดึงข้อมูล  tb_gender ทั้งหมด
 public function fetch_gender()
 {
   return $this->db->get('tb_gender')->result();
 }

 //ดึงข้อมูล tb_gander name
 public function fetch_gender_name($id)
 {
  $this->db->where('id',$id);
   $query = $this->db->get('tb_gender');
   return $query->row('name');
 }

 //ดึงข้อมูล  tb_country ทั้งหมด
 public function fetch_country()
 {
   return $this->db->get('tb_country')->result();
 }

 //ดึงข้อมูล  tb_foods ทั้งหมด
 public function fetch_foods()
 {
   return $this->db->get('tb_foods')->result();
 }
 public function fetch_foods_name($id)
 {
   $this->db->where('id',$id);
    $query = $this->db->get('tb_foods');
    return $query->row('name');
 }

 //ดึงข้อมูล  tb_occ_type ทั้งหมด
 public function fetch_occ_type()
 {
   return $this->db->get('tb_occ_type')->result();
 }

 //ดึงข้อมูล tb_occ_type name
 public function fetch_occ_type_name($id)
 {
  $this->db->where('id',$id);
   $query = $this->db->get('tb_occ_type');
   return $query->row('name');
 }

 //ดึงข้อมูล  tb_org_type ทั้งหมด
 public function fetch_org_type()
 {
   return $this->db->get('tb_org_type')->result();
 }

 //ดึงข้อมูล  tb_org ทั้งหมด
 public function fetch_org()
 {
   $this->db->order_by('name', 'ASC');
   return $this->db->get('tb_org')->result();
 }

 //ดึงข้อมูล tb_org name
 public function fetch_org_name($id)
 {
  $this->db->where('id',$id);
   $query = $this->db->get('tb_org');
   return $query->row('name');
 }

 //ดึงข้อมูล  tb_people_type ทั้งหมด
 public function fetch_people_type()
 {
   return $this->db->get('tb_people_type')->result();
 }

 //ดึงข้อมูล tb_occ_type name
 public function fetch_people_type_name($id)
 {
  $this->db->where('id',$id);
   $query = $this->db->get('tb_people_type');
   return $query->row('name');
 }

 //ดึงข้อมูล tb_occ_type name
 public function fetch_category_name($id)
 {
  $this->db->where('id',$id);
   $query = $this->db->get('tb_project_type');
   return $query->row('name');
 }

/******************************
******    Fied trip ***********
******************************/
 //ดึงข้อมูล  tb_fieldtrip ทั้งหมด
 public function fetch_fieldtrip()
 {
   return $this->db->get('tb_fieldtrip')->result();
 }
 //ดึงข้อมูล  tb_fieldtrip ทั้งหมด
 public function fetch_fieldtrip_row($id)
 {
   $this->db->where('id',$id);
   return $this->db->get('tb_fieldtrip')->row();
 }
 //ดึงข้อมูล  tb_fieldtrip ทั้งหมด
 public function fetch_fieldtrip_name($id)
 {
   $this->db->where('id',$id);
   return $this->db->get('tb_fieldtrip')->row('name');
 }

 //อับเดรตข้อมูล fiesdtrip
 public function update_fieldtrip($user_id,$fieldtrip_id,$update_time)
 {
   //คำนวนการจัดรถ
  $count = $this->count_fieldtrip_status($fieldtrip_id); //นับจำนวนการเลือกทริป
  $bus_no = 0;
  if($this->count_fieldtrip_status_bus(($fieldtrip_id*10)+1) < 46){ //bus capacity == 45
    $bus_no = ($fieldtrip_id*10)+1;
  }else{
    $bus_no = ($fieldtrip_id*10)+2;
  }
   $data = array(
           'fieldtrip_id' => $fieldtrip_id,
           'bus_no' => $bus_no,
           'update_time' => $update_time
   );
   $this->db->where('user_id',$user_id);
   return $this->db->update('tb_fieldtrip_chose',$data);
 }

 //อับเดรตข้อมูล fiesdtrip
 public function update_user_trip($user_id,$fieldtrip_id)
 {
   $data = array(
           'trip' => $fieldtrip_id
   );
   $this->db->where('id',$user_id);
   return $this->db->update('tb_users',$data);
 }

 //อับเดรตข้อมูล fiesdtrip
 public function add_fieldtrip($user_id,$fieldtrip_id,$occ_id,$country,$update_time)
 {
   //คำนวนการจัดรถ
  $count = $this->count_fieldtrip_status($fieldtrip_id); //นับจำนวนการเลือกทริป
  $bus_no = 0;
  if($this->count_fieldtrip_status_bus(($fieldtrip_id*10)+1) < 46){ //bus capacity == 45
    $bus_no = ($fieldtrip_id*10)+1;
  }else{
    $bus_no = ($fieldtrip_id*10)+2;
  }
  $data = array(
          'id' => '',
           'user_id' => $user_id,
           'country' => $country,
           'fieldtrip_id' => $fieldtrip_id,
           'occ_id' => $occ_id,
           'bus_no' => $bus_no,
           'update_time' => $update_time
   );
   return $this->db->insert('tb_fieldtrip_chose', $data);    //insert data to tb_invite
 }

 //ดึงข้อมูล  tb_fieldtrip ทั้งหมด
 public function fetch_fieldtrip_chose($id)
 {
   $this->db->where('fieldtrip_id',$id);
   return $this->db->get('tb_fieldtrip_chose')->result();
 }

 //ดึงข้อมูล  tb_fieldtrip ทั้งหมด
 public function fetch_fieldtrip_chose_id($id)
 {
   $this->db->where('user_id',$id);
   return $this->db->get('tb_fieldtrip_chose')->row();
 }

 //ดึงข้อมูล  tb_fieldtrip ทั้งหมด
 public function count_fieldtrip_status($fieldtrip_id)
 {
   $this->db->where('fieldtrip_id',$fieldtrip_id);
   return $this->db->count_all_results('tb_fieldtrip_chose');
 }

 //ดึงข้อมูล  tb_fieldtrip ทั้งหมด
 public function count_fieldtrip_status_bus($bus_no)
 {
   $this->db->where('bus_no',$bus_no);
   return $this->db->count_all_results('tb_fieldtrip_chose');
 }

 //ดึงข้อมูล  tb_fieldtrip ทั้งหมด
 public function count_fieldtrip_chose($fieldtrip_id,$occ_id)
 {
   $this->db->where('fieldtrip_id',$fieldtrip_id);
   $this->db->where('occ_id',$occ_id);
   return $this->db->count_all_results('tb_fieldtrip_chose');
 }

 //ดึงข้อมูล  tb_fieldtrip ทั้งหมด
 public function count_fieldtrip_teacher_chose($fieldtrip_id)
 {
   $this->db->where('fieldtrip_id',$fieldtrip_id);
   $this->db->where('occ_id >',1);
   return $this->db->count_all_results('tb_fieldtrip_chose');
 }

 //ดึงข้อมูล  tb_fieldtrip ทั้งหมด
 public function count_fieldtrip_student_chose($fieldtrip_id,$occ_id,$country)
 {
   $this->db->where('fieldtrip_id',$fieldtrip_id);
   $this->db->where('occ_id',$occ_id);
   $this->db->where('country',$country);
   return $this->db->count_all_results('tb_fieldtrip_chose');
 }

 //ตรวจสอบจำนวน field trip ว่างหรือไม่ เต็มหรือยัง
 public function fieldtrip_check($fieldtrip_id,$occ_id,$country)
 {
   $this->db->where('id',$fieldtrip_id);
   $query = $this->db->get('tb_fieldtrip')->row();

  if($occ_id == 1){ //1=student
    $count = $this->count_fieldtrip_student_chose($fieldtrip_id,$occ_id,$country); //นับจำนวนการเลือกทริป
    if($country == 'TH'){
      if($count < $query->st_max){    //ถ้าจำนวนที่ลงน้อยกว่า ค่าสูงสุด
        return true;
      }else{
        return false;
      }
    }else{
      if($count < $query->sj_max){    //ถ้าจำนวนที่ลงน้อยกว่า ค่าสูงสุด
        return true;
      }else{
        return false;
      }
    }
  }else if($occ_id > 1){ //2=teacher 3,4,5,6
    $count = $this->count_fieldtrip_teacher_chose($fieldtrip_id); //นับจำนวนการเลือกทริป
    if($count < $query->t_max){
      return true;
    }else{
      return false;
    }
  }else{
    return false;
  }
 }

 //ลบข้อมูล field trip
 public function delete_fieldtrip_row($member_id)
 {
   $this->db->where('user_id', $member_id);
   $this->db->delete('tb_fieldtrip_chose');
 }

/*******************************
  Field trip sub group
******************************/
//ดึงข้อมูล  tb_fieldtrip ทั้งหมด
public function fetch_fieldtrip_sub_group()
{
  return $this->db->get('tb_fieldtrip_sub_group')->result();
}

//ดึงข้อมูล  tb_fieldtrip sub group
public function fetch_fieldtrip_sub_group_id($id)
{
  $this->db->where('member_id',$id);
  return $this->db->get('tb_fieldtrip_sub_group')->row('sub_group');
}

//ค้นข้อมูล
public function search_fieldtrip_sub_group($key)
{
  $this->db->like('id',$key);
  return $this->db->get('tb_fieldtrip_sub_group')->row();
}

//นับจำนวน
public function count_fieldtrip_sub_group_id($id)
{
  $this->db->where('member_id',$id);
  return $this->db->count_all_results('tb_fieldtrip_sub_group');
}

//เพิ่มข้อมูล
function add_fieldtrip_sub_group($data)
{
  $this->db->insert('tb_fieldtrip_sub_group', $data);
}

//อับเดรตข้อมูล
public function update_fieldtrip_sub_group($data)
{
  $this->db->where('member_id',$data['member_id']);
  $this->db->update('tb_fieldtrip_sub_group',$data);
}

/********************************
  PASSWORD
********************************/
 //สร้าง Token for forgot password
 public function create_forgot_token($email)
 {
   $token = $this->generateRandomString(rand(40,60));   //generate token code
   $data = array(
      'id' => '',
      'email' => $email,
      'token' => $token,
      'used' => '0'
  );
  $this->db->insert('tb_forgot', $data);    //insert data to tb_invite
  return $token;
 }

 //thank https://stackoverflow.com/a/4356295
 public function generateRandomString($length = 10)
 {
     $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
     $charactersLength = strlen($characters);
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
         $randomString .= $characters[rand(0, $charactersLength - 1)];
     }
     return $randomString;
 }

 //ดึงค่า email จาก tb_forgot
 public function fetch_email_forgot($token)
 {
  $this->db->select('email');
  $this->db->where('token',$token);
  $this->db->where('used','0');
   $query = $this->db->get('tb_forgot');
   return $query->row('email');    //return password value 60 digit
 }

 //อับเดรต inused in tb_forgot
 public function update_used_forgot($email,$token)
 {
   $data = array(
           'used' => '1'
   );
   $this->db->where('email', $email);
   $this->db->where('token', $token);
   $this->db->update('tb_forgot', $data);
 }

 //แนะนำสมาชิก
 public function introduce_member()
 {
   $min = 1;
   $max =  $this->db->count_all_results('tb_users');
   $id = rand($min,$max);

  $this->db->where('id',$id);
  $query = $this->db->get('tb_users');
  return $query->row();
 }

 //แนะนำโรงเรียน
 public function introduce_org()
 {
   $min = 1;
   $max =  $this->db->count_all_results('tb_org');
   $id = rand($min,$max);

  $this->db->where('id',$id);
  $query = $this->db->get('tb_org');
  return $query->row();
 }

 //แนะนำโรงเรียน
 public function introduce_org_pcshs()
 {
   $type = 1;
   $orgs = $this->Org_model->fetch_org_group($type);
   $org_id = array();
   $i=0;
   foreach ($orgs as $org) {
     $org_id[$i] = $org->id;
     $i++;
   }
   $id = array_rand($org_id,1);

  $this->db->where('id',$id);
  $query = $this->db->get('tb_org');
  return $query->row();
 }

 //แนะนำโรงเรียน
 public function introduce_org_ssh()
 {
   $type = 2;
   $orgs = $this->Org_model->fetch_org_group($type);
   $org_id2 = array();
   $i=0;
   foreach ($orgs as $org) {
     $org_id2[$i] = $org->id;
     $i++;
   }
   $id = array_rand($org_id2,1);

  $this->db->where('id',$id);
  $query = $this->db->get('tb_org');
  return $query->row();
 }

 //แนะนำโรงเรียน
 public function introduce_org_kosen()
 {
   $type = 5;
   $orgs = $this->Org_model->fetch_org_group($type);
   $org_id2 = array();
   $i=0;
   foreach ($orgs as $org) {
     $org_id2[$i] = $org->id;
     $i++;
   }
   $id = array_rand($org_id2,1);

  $this->db->where('id',$id);
  $query = $this->db->get('tb_org');
  return $query->row();
 }


 //แนะนำโครงงาน
 public function introduce_project()
 {
   $min = 1;
   $max =  $this->db->count_all_results('tb_project');
   $id = rand($min,$max);

  $this->db->where('id',$id);
  $query = $this->db->get('tb_project');
  return $query->row();
 }

 //อับเดรตข้อมูล tb_files download
 public function update_download($file_name)
 {
   $this->db->set('download', 'download+1',FALSE); //set download = download+1
   $this->db->where('name',$file_name);
   $this->db->update('tb_files');
 }

 //เรียกดูค่าการดาวน์โหลด
 public function fetch_file_download($file_name)
 {
  $this->db->where('name',$file_name);
   $query = $this->db->get('tb_files');
   return $query->row('download');
 }









   //ค้นข้อมูลผู้ใช้
   public function find($pid)
   {
     return $this->db->where('pid',$pid)
                    ->get('tb_users')
                    ->row();
   }


   //ตรวจสอบ password จาก username
   public function check_password($username)
   {
    $this->db->select('password');
    $this->db->where('username',$username);
     $query = $this->db->get('tb_users');
     return $query->row('password');
   }


 }
