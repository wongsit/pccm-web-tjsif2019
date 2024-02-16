<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');

 /**
  * org model by khanchai 201903
  */
 class Notify_model extends CI_Model
 {
   public function __construct(){
     parent::__construct();
   }

   /*--------------------------------
   Organization
   ----------------------------------*/
   //ดึงข้อมูล tb_notify ทั้งหมด
   public function fetch_notify()
   {
     $this->db->limit(20);  // Produces: LIMIT 10
      $this->db->order_by('update_time', 'DESC');
     return $this->db->get('tb_notify')->result();
   }

   //ดึงข้อมูล tb_notify ทุกแถวจากคอลัมน์ id
   public function fetch_notify_id($id)
   {
     $this->db->where('id',$id);
      $query = $this->db->get('tb_notify');
      return $query->row();
   }

   //อับเดรตข้อมูล tb_org
   public function add_notify($post = array())
   {
     $data = array(
       'id' => '',
       'user_id' => $post['user_id'],
       'detail' => $post['detail'],
       'link' => $post['link'],
       'update_time' => $post['update_time']
     );
     return $this->db->insert('tb_notify', $data);    //insert data to tb_invite
   }

   //นับจำนวน org_type
   public function count_notify(){
     return $this->db->count_all_results('tb_notify');
   }

   //ลบข้อมูล field trip
   public function delete_notify_row($member_id)
   {
     $this->db->where('user_id', $member_id);
     $this->db->delete('tb_notify');
   }

 } //class
