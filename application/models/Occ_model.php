<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');

 /**
  * org model by khanchai 201903
  */
 class Occ_model extends CI_Model
 {
   public function __construct(){
     parent::__construct();
   }

   //ดึงข้อมูล tb_org ทั้งหมด
   public function fetch_occ()
   {
     return $this->db->get('tb_occ_type')->result();
   }

   //ดึงข้อมูล tb_org ทุกแถวจากคอลัมน์ id
   public function fetch_occ_id()
   {
     $this->db->select('id');
     $query = $this->db->get('tb_occ_type');
      return $query->row();
   }

   //ดึงข้อมูล org
   public function fetch_occ_type_name($id)
   {
    $this->db->where('id',$id);
     $query = $this->db->get('tb_occ_type');
     return $query->row('name');
   }


 }
