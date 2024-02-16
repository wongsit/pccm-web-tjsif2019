<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');

 /**
  * profile model by khanchai 2018122101
  */
 class Activity_model extends CI_Model
 {
   public function __construct(){
     parent::__construct();

   }
   /********************************
   activity_type
   ***********************************/
   public function get_activity_type($id){
     if($id == 1){
       return 'Register';
     }else if($id == 2){
       return 'Domitory';
     }else if($id == 3){
       return 'Field trip';
     }else if($id == 4){
       return 'Presentation';
     }else if($id == 5){
       return 'Teacher show and share';
     }else if($id == 6){
       return 'ICT Workshop';
     }else{
       return 'None';
     }
   }

   //ดึงข้อมูล
   public function fetch_activity($id)
   {
     $this->db->where('type',$id);
     $query = $this->db->get('tb_activity');
     return $query->result();
   }

   //ดึงข้อมูล
   public function fetch_activity_row($id)
   {
    $this->db->where('id',$id);
     $query = $this->db->get('tb_activity');
     return $query->row();
   }

   //ดึงข้อมูล
   public function fetch_activity_name($id)
   {
    $this->db->where('id',$id);
     $query = $this->db->get('tb_activity');
     return $query->row('name');
   }

   /*********************************
          Attendance
   *******************************/
   //ดึงข้อมูล
   public function fetch_attendance_user($member_id)   {

     $this->db->where('member_id',$member_id);
     $query = $this->db->get('tb_attendance');
     return $query->result();
   }

   //ดึงข้อมูล
   public function fetch_attendance_status($activity_id,$status)
   {
     $date_now = $this->System_model->get_date(); //วันที่ต้องการให้เห็นโพส
     $this->db->where('date_check = ',$date_now); //article ที่กำหนด post date ไว้ล่วงหน้า
     $this->db->where('activity_id',$activity_id);
     $this->db->where('status',$status);
     $query = $this->db->get('tb_attendance');
     return $query->result();
   }

   //ดึงข้อมูล
   public function fetch_attendance_present($activity_id,$status)
   {
     $this->db->where('activity_id',$activity_id);
     $this->db->where('status',$status);
     $query = $this->db->get('tb_attendance');
     return $query->result();
   }

   //count user/activity
   public function fetch_attendance_domitory($activity_id,$date_check){
     $this->db->select('*');
     $this->db->from('tb_users');
     $this->db->join('tb_attendance', 'tb_users.id = tb_attendance.member_id');
     $this->db->where('activity_id',$activity_id);
     $this->db->where('date_check',$date_check);
     $this->db->where('status','in');
     return $this->db->get()->result();
   }

   //count user/activity
   public function fetch_attendance_fieldtrip_go($activity_id){
     $this->db->select('*');
     $this->db->from('tb_users');
     $this->db->join('tb_attendance', 'tb_users.id = tb_attendance.member_id');
     $this->db->where('activity_id',$activity_id);
     $this->db->where('status','go');
     return $this->db->get()->result();
   }

   //count user/activity
   public function fetch_attendance_fieldtrip_back($activity_id){
     $this->db->select('*');
     $this->db->from('tb_users');
     $this->db->join('tb_attendance', 'tb_users.id = tb_attendance.member_id');
     $this->db->where('activity_id',$activity_id);
     $this->db->where('status','back');
     return $this->db->get()->result();
   }

   // create ข้อมูล check-in
   public function add_attendance($data = array())
   {
     return $this->db->insert('tb_attendance', $data);    //insert data to tb_invite
   }

   //user check-in
   public function count_attendance_same($activity_id,$member_id){
     $this->db->where('activity_id',$activity_id);
     $this->db->where('member_id',$member_id);
     return $this->db->count_all_results('tb_attendance');
   }

   //count user/activity
   public function count_attendance($activity_id){
     $this->db->select('*');
     $this->db->from('tb_users');
     $this->db->join('tb_attendance', 'tb_users.id = tb_attendance.member_id');
      $this->db->where('activity_id',$activity_id);
     return $this->db->get()->result();
   }

   //นับ in
   public function count_attendance_in($activity_id,$member_id){
     $date_now = $this->System_model->get_date(); //วันที่ต้องการให้เห็นโพส
     $this->db->where('date_check = ',$date_now); //article ที่กำหนด post date ไว้ล่วงหน้า
     $this->db->where('activity_id',$activity_id);
     $this->db->where('member_id',$member_id);
     $this->db->where('status','in');
     return $this->db->count_all_results('tb_attendance');
   }

   //นับ in
   public function count_attendance_go($activity_id,$member_id){
     $this->db->where('activity_id',$activity_id);
     $this->db->where('member_id',$member_id);
     $this->db->where('status','go');
     return $this->db->count_all_results('tb_attendance');
   }

   //นับ in
   public function count_attendance_back($activity_id,$member_id){
     $this->db->where('activity_id',$activity_id);
     $this->db->where('member_id',$member_id);
     $this->db->where('status','back');
     return $this->db->count_all_results('tb_attendance');
   }

   //อับเดรตข้อมูล tb_users
   public function update_attendance($data = array())
   {
     $data_update = array('update_time' => $data['update_time'] );
     $this->db->where('activity_id',$data['activity_id']);
     $this->db->where('member_id',$data['member_id']);
     $this->db->where('status',$data['status']);
     $this->db->where('date_check',$data['date_check']);
     return $this->db->update('tb_attendance',$data_update);
   }

   //ลบข้อมูล activity
   public function delete_activity_back($data = array())
   {
     $this->db->where('activity_id',$data['activity_id']);
     $this->db->where('member_id',$data['member_id']);
     $this->db->where('status','back');
     $this->db->delete('tb_attendance');
   }

   //ลบข้อมูล activity
   public function delete_activity_row($member_id)
   {
     $this->db->where('member_id', $member_id);
     $this->db->delete('tb_attendance');
   }

 }
