<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');

 /**
  * org model by khanchai 201903
  */
 class Site_model extends CI_Model
 {
   public function __construct(){
     parent::__construct();
   }


   //เช็คกำหนดลงทะเบียน
   public function check_register_date($date_now)
   {
     $this->db->where('open_register <= ',$date_now); //เปิดรับสมัคร
     $this->db->where('close_register >= ',$date_now); //ปิดรับสมัคร
     return $this->db->count_all_results('tb_site');
   }

   //เช็คกำหนดวันสุดท้ายอับโหลด abstract
   public function check_abstract_deadline($date_now)
   {
     $this->db->where('close_abstract >= ',$date_now); //ปิดรับสมัคร
     return $this->db->count_all_results('tb_site');
   }

   //เช็คกำหนดวันสุดท้ายอับโหลด fullpaper
   public function check_fullpaper_deadline($date_now)
   {
     $this->db->where('close_fullpaper >= ',$date_now); //ปิดรับสมัคร
     return $this->db->count_all_results('tb_site');
   }

   //เช็คกำหนดวันสุดท้ายอับโหลด fullpaper
   public function check_fieldtrip_date($date_now)
   {
     $this->db->where('open_fieldtrip <= ',$date_now); //เปิดรับสมัคร
     $this->db->where('close_fieldtrip >= ',$date_now); //ปิดรับสมัคร
     return $this->db->count_all_results('tb_site');
   }

   //ดึงข้อมูล close register
   public function fetch_close_register($id)
   {
    $this->db->where('id',$id);
     $query = $this->db->get('tb_site');
     return $query->row('close_register');
   }

   //ดึงข้อมูล close fullpaper
   public function fetch_fullpaper_deadline($id)
   {
    $this->db->where('id',$id);
     $query = $this->db->get('tb_site');
     return $query->row('close_fullpaper');
   }

   //ดึงข้อมูล close abstract
   public function fetch_abstract_deadline($id)
   {
    $this->db->where('id',$id);
     $query = $this->db->get('tb_site');
     return $query->row('close_abstract');
   }


 }
