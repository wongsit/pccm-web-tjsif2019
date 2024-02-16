<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');

 /**
  * org model by khanchai 201903
  */
 class Email_model extends CI_Model
 {
   public function __construct(){
     parent::__construct();
   }

   /*--------------------------------
   Organization
   ----------------------------------*/
   //เพิ่มข้อมูล tb_email
   public function add_email_content($post = array())
   {
     $data = array(
       'id' => '',
       'title' => $post['email_title'],
       'content' => $post['content'],
       'update_ip' => $post['update_ip'],
       'update_time' => $post['update_time'],
       'update_name' => $post['update_name']
     );
     return $this->db->insert('tb_email', $data);    //insert data to tb_
   }

   //เพิ่มข้อมูล tb_email_sended
   public function add_email_sended($post = array())
   {
     $data = array(
       'id' => '',
       'user_id' => $post['user_id'],
       'email_addr' => $post['user_email'],
       'email_id' => $post['email_id'],
       'update_time' => $post['update_time'],
       'update_ip' => $post['update_ip'],
       'sender' => $post['sender']
     );
     return $this->db->insert('tb_email_sended', $data);    //insert data to tb_
   }

   //นับจำนวน record tb_email
   public function count_email(){
     return $this->db->count_all_results('tb_email');
   }


 } //class
