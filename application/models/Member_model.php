<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');

 /**
  * org model by khanchai 201903
  */
 class Member_model extends CI_Model
 {
   public function __construct(){
     parent::__construct();
   }

   //สร้าง Token
   public function create_token($make,$email)
   {
     $token = $this->generateRandomString(rand(40,60));   //generate token code
     $data = array(
        'id' => '',
        'make' => $make,
        'email' => $email,
        'token' => $token,
        'used' => '0'
    );
    $this->db->insert('tb_invite', $data);    //insert data to tb_invite
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

   /**********************************
     tb_hostel
   **********************************/
   //ดึงข้อมูล project present
   public function fetch_hostel()
   {
     $query = $this->db->get('tb_hostel');
     return $query->result();
   }

   //ดึงข้อมูล project present
   public function fetch_hostel_dormitory($ref)
   {
     $this->db->where('hostel_name',$ref);
     $query = $this->db->get('tb_hostel');
     return $query->result();
   }
      
   //ดึงข้อมูล project present
   public function fetch_hostel_id($user_id)
   {
     $this->db->where('user_id',$user_id);
     $query = $this->db->get('tb_hostel');
     return $query->row();
   }

   //นับจำนวน
   public function count_hostel_id($user_id)
   {
     $this->db->where('user_id',$user_id);
     return $this->db->count_all_results('tb_hostel');
   }

   //เพิ่มข้อมูล
  	function add_hostel($data)
  	{
  		$this->db->insert('tb_hostel', $data);
  	}

   //อับเดรตข้อมูล
   public function update_hostel($data)
   {
     $this->db->where('user_id',$data['user_id']);
     $this->db->update('tb_hostel',$data);
   }

   //ค้นข้อมูล ผลสอบ ประถม
   public function search_hostel($key)
   {
     $this->db->like('user_id',$key);
     $this->db->or_like('hostel_name',$key);
     $this->db->or_like('room',$key);
     $this->db->order_by('user_id', 'ASC');
     return $this->db->get('tb_hostel')->result();
   }


 }
